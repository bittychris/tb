<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use App\Models\User;
use App\Models\Ward;
use App\Models\Region;
use Livewire\Component;
use App\Models\AgeGroup;
use App\Models\District;
use App\Models\Attribute;
use Livewire\WithPagination;
use App\Models\FormAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserActionNotification;

class FormData extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $previousValue;
    
    public $form;
    public $created_at;
    public $form_id;
    public $scanning_name;
    public $region_id;
    public $districts = [];
    public $district_id;
    public $wards = [];
    public $ward_id;
    public $address;
    public $value = 0;
    public $sum = 0;
    

    public $main_attr;

    public $color = '';

    public $ageGroups = [];
    public $attributeList = [];

    public $formData = [];
    public $formData2 = [];

    public $total_one_male = 0;

    public $total_two_male = 0;

    public $total_one_female = 0;

    public $total_two_female = 0;

    public $excel_file;

    public $editMode = false;

    public function mount($form)
    {
        $this->created_at = now()->format('Y-m-d');

        if ($this->form) {
            $this->editMode = true;

            $this->form = $form;
            $this->scanning_name = $form->scanning_name;
            $this->form_id = $form->form_attribute_id;
            $this->address = $form->address;
            $this->ward_id = $form->ward_id;
            $this->district_id = $form->ward->district->id;
            $this->created_at = $form->created_at->format('d/m/Y');

            $this->wards = Ward::all();
            $this->updatedFormId();

            $formData = \App\Models\FormData::where('form_id', $form->id)
                ->get();

            foreach ($formData as $data) {
                $this->formData[$data->age_group_id][$data->attribute_id]['M'] = $data->male;
                $this->formData[$data->age_group_id][$data->attribute_id]['F'] = $data->female;
            }
        }
    }

    protected $rules = [
        'scanning_name' => ['required'],
//        'region_id' => ['required'],
        'district_id' => ['required'],
        'ward_id' => ['required'],
        'address' => ['required'],
    ];


    // public function openUploadModal() {
    //     $this->dispatch('openForm');

    // }
    
    // public function clearForm() {
    //     $this->reset(
    //         'excel_file'
    //     );
    // }

    public function saveForm()
    {
        $this->validate();

        $this->total_one_male = 0;
        $this->total_two_male = 0;
        $this->total_one_female = 0;
        $this->total_two_female = 0;
        $first_male_value = 0;
        $first_female_value = 0;
        $mainAttribute = '';

        foreach($this->attributeList as $attribute) {
            
            if($attribute->attribute_no == 1.0) {
                $mainAttribute = $attribute;

            } elseif($attribute->attribute_no == 0.1) {
                $mainAttribute = $attribute;

            } elseif($attribute->attribute_no == 0.2) {
                $mainAttribute = $attribute;

            }
        }

        $totalMale = [];
        $totalFemale = [];
        $first_ageGroup_id = '';
        $second_ageGroup_id = '';
        $third_ageGroup_id = '';

        foreach($this->ageGroups as $key => $data) {
            
            if($key == 0) {
                $first_ageGroup_id = $data->id;
            }

            if($key == 1) {
                $second_ageGroup_id = $data->id;
            }

            if($key == 2) {
                $third_ageGroup_id = $data->id;
            }

        }
        
        foreach($this->formData as $age_groupId => $data) {
            if($age_groupId != $first_ageGroup_id) {
                foreach($this->attributeList as $attribute) {
                    $first_female_value = '';

                    if($attribute->attribute_no == 1.0 && $data[$mainAttribute->id]) {

                        $first_female_value = $data[$mainAttribute->id]['F'];
                        $first_male_value = $data[$mainAttribute->id]['M']; 
                    }

                    // dd($first_female_value);
                    if($attribute->attribute_no == 2.0) {
                        // if(!empty($data[$attribute->id]['F']) && $data[$mainAttribute->id]['F'] != 0) {
                            if($data[$attribute->id]['F'] <= $first_female_value) {
                                $this->dispatch('success_alert', 'Please Enter Correct value on Number of Females in "'.$attribute->name.'" column');
                                
                            } else {
                                $this->dispatch('message_alert', 'Please Enter Correct value on Number of Females in "'.$attribute->name.'" column');

                            }
                        // }
                    }


                    
                }

            }
        }

        // dd($mainAttribute);

        // $mainAttribute = Attribute::where('attribute_no', 1.0)->first();
        

        foreach ($this->formData as $groupId => $age_group) {

            if(!empty($this->formData[$groupId][$mainAttribute->id]['M'])) {
                $totalMale[$groupId] = $this->formData[$groupId][$mainAttribute->id]['M'];
            }

            if(!empty($this->formData[$groupId][$mainAttribute->id]['F'])) {
                $totalFemale[$groupId] = $this->formData[$groupId][$mainAttribute->id]['F'];
            }            

            if($groupId == $first_ageGroup_id || $groupId == $second_ageGroup_id) {
                foreach ($age_group as $attributeId => $value) {
                    if($mainAttribute->id != $attributeId) {
                        if(!empty($value['M'])) {

                            $this->total_one_male += $value['M'];

                        }

                        if(!empty($value['F'])) {

                            $this->total_one_female += $value['F'];

                        }
                    }
                }
            }

            if($groupId == $third_ageGroup_id) {
                foreach ($age_group as $attributeId => $value) {
                    if($mainAttribute->id != $attributeId) {
                        if(!empty($value['M'])) {

                            $this->total_two_male += $value['M'];

                        }

                        if(!empty($value['F'])) {

                            $this->total_two_female += $value['F'];

                        }
                    }
                }
            }

        }

        if(count($totalMale) < 2 || count($totalFemale) < 2) {
            $this->dispatch('message_alert', 'Please Enter Number of Females or Males in "'.$mainAttribute->name.'" column');

        } elseif(count($totalMale) >= 2 || count($totalFemale) >= 2) {

            if($this->total_one_male > $totalMale[$first_ageGroup_id] || $this->total_two_male > $totalMale[$third_ageGroup_id] || $this->total_one_female > $totalFemale[$first_ageGroup_id] || $this->total_two_female > $totalFemale[$third_ageGroup_id]) {
               $this->color = 'danger';

               $this->dispatch('message_alert', 'Number of Females or Males in "'.$mainAttribute->name.'" column are not Correct');

            } else {
                $this->color = 'success';
                
                try {
                    DB::beginTransaction();

                    if ($this->form) {
                        $formTb = $this->form;
                    } else {
                        $formTb = new Form();
                    }

                    
                    $formTb->form_attribute_id = $this->form_id;
                    $formTb->created_by = Auth::id();
                    $formTb->completed_by = Auth::id();
                    $formTb->scanning_name = $this->scanning_name;
                    $formTb->ward_id = $this->ward_id;
                    $formTb->address = $this->address;
                    
                    if($this->editMode == false) {
                        $formTb->created_at = date('Y-m-d H:m:s', strtotime($this->created_at));
                        $formTb->updated_at = date('Y-m-d H:m:s', strtotime($this->created_at));
                        
                    }

                    $formTb->save();

                    if ($this->form) {
                        foreach ($this->formData as $groupId => $age_group) {
                            foreach ($age_group as $attributeId => $value) {
                                $existingRecord = \App\Models\FormData::where([
                                    'form_id' => $formTb->id,
                                    'age_group_id' => $groupId,
                                    'attribute_id' => $attributeId,
                                ])->first();

                                if ($existingRecord) {

                                    $existingRecord->update([
                                        'male' => array_key_exists('M', $value) ? $value['M'] : null,
                                        'female' => array_key_exists('F', $value) ? $value['F'] : null,
                                    ]);
                                } else {
                                    \App\Models\FormData::create([
                                        'form_id' => $formTb->id,
                                        'age_group_id' => $groupId,
                                        'attribute_id' => $attributeId,
                                        'male' => array_key_exists('M', $value) ? $value['M'] : null,
                                        'female' => array_key_exists('F', $value) ? $value['F'] : null,
                                    ]);
                                }
                            }
                        }

                    } else {
                        foreach ($this->formData as $groupId => $age_group) {
                            foreach ($age_group as $attributeId => $value) {
                                \App\Models\FormData::create([
                                    'form_id' => $formTb->id,
                                    'age_group_id' => $groupId,
                                    'attribute_id' => $attributeId,
                                    'male' => array_key_exists('M', $value) ? $value['M'] : null,
                                    'female' => array_key_exists('F', $value) ? $value['F'] : null,
                                ]);
                            }
                        }
                    }

                    DB::commit();
                    if ($this->form) {
                        $acting_user = User::find(auth()->user()->id);
                        $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated field data', 'Admin'));

                        // redirect(route('admin.report'));

                        $this->dispatch('field_data_success_alert', 'Data update successfully.');

                    } else {
                        $acting_user = User::find(auth()->user()->id);
                        $acting_user->notify(new UserActionNotification(auth()->user(), 'Added new field data', 'Admin'));

                        // redirect(route('admin.report'));

                        $this->dispatch('field_data_success_alert', 'Data saved successfully.');

                    }

                } catch (\Throwable $th) {
                    DB::rollBack();
                    report($th);
                    // $this->dispatch('failure_alert', $th->getMessage());

                    $this->dispatch('failure_alert', 'An error occurred. Try again later or Check fill the empty fields.');
                }
            }

        }    
        
    }

    public function updatedFormId()
    {
        $formsAttributes = FormAttribute::where('id', $this->form_id)->first();
        $this->scanning_name = $formsAttributes->name;
        $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->get();
        $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->get();
    }

    // public function updatedRegionId()
    // {
    //     $this->region_id = auth()->user()->region_id;

    //     $this->districts = District::where('region_id', $this->region_id)->get();
    // }Attribute::

    public function updatedDistrictId()
    {
        $this->wards = Ward::where('district_id', $this->district_id)->get();
    }

    public function calculateTotal($attributeId, $gender)
    {
        return collect($this->formData)->sum(function ($ageGroup) use ($attributeId, $gender) {
            return intval($ageGroup[$attributeId][$gender] ?? 0);
        });
    }

    public function validateInput($ageGroup_id, $attribute_id, $gender)

    {

        $previousValue = $this->formData[$ageGroup_id][$attribute_id][$gender] ?? null;

        dd($previousValue);

        // if ($id > 1 && $this->values[$id]['value'] > $previousValue) {

        //     $this->addError('values.' . $id, 'The value should be less than or equal to the previous value.');

        // } else {

        //     $this->previousValue = $this->values[$id]['value'];

        // }

    }

    // public function updatedFormData($value, $ageGroupId, $attributeId, $gender) {

    //     $this->formData2[$ageGroupId][$attributeId][$gender] = $value;


    //     // For the first age group, get the total sum for all inputs

    //     if ($ageGroupId == 1) {

    //         $totalSum = array_sum(array_map(function ($data) use ($gender) {

    //             return $data[$gender];

    //         }, $this->formData2[1]));

    //     }


    //     // For all age groups except the first one, calculate the remaining sum

    //     foreach ($this->formData2 as $ageGroupId => $attributes) {

    //         if ($ageGroupId != 1) {

    //             $remainingSum = $totalSum;

    //             foreach ($attributes as $attributeId => $genders) {

    //                 $remainingSum -= $genders['F'] + $genders['M'];

    //             }


    //             // Distribute the remaining sum across all attributes and genders

    //             foreach ($attributes as $attributeId => $genders) {

    //                 $this->formData2[$ageGroupId][$attributeId]['F'] = max(0, $remainingSum / 2);

    //                 $this->formData2[$ageGroupId][$attributeId]['M'] = max(0, $remainingSum / 2);

    //             }

    //         }

    //     }

    // }
    public function testedSum( $x)
    {
       return $this->sum += $x;
    }

    public function render()
    {
        $this->sum += $this->value;
        if(!empty($this->form_id)) {
            $formsAttributes = FormAttribute::where('id', $this->form_id)->first();

            $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->orderBy('created_at', 'asc')->get();
            $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->orderBy('attribute_no', 'asc')->get();

        }

        // $this->calculateTotalConfirmed();

        // else {
        //     $formsAttributes = FormAttribute::all();
        // }

        // $this->main_attr = Attribute::where('attribute_no', 1)->get();

        // dd($this->main_attr);
        $formsAttributes = FormAttribute::orderBy('created_at','asc')->get();
        // $regions = Region::all();

        $this->region_id = auth()->user()->region_id;

        $this->districts = District::where('region_id', $this->region_id)->get();

        if($this->editMode == true) {
            $this->districts = District::orderBy('name', 'asc')->get();
        }


        return view('livewire.admin-panel.form-data', [
            'formsAttributes' => $formsAttributes,
            // 'regions' => $regions
            'districts' => $this->districts
        ]);
    }
}