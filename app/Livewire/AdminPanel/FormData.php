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
    
    public $form;
    public $form_id;
    public $scanning_name;
    public $region_id;
    public $districts = [];
    public $district_id;
    public $wards = [];
    public $ward_id;
    public $address;

    public $ageGroups = [];
    public $attributeList = [];

    public $formData = [];
    public $formData2 = [];


    public function mount($form)
    {
        if ($this->form) {
            $this->form = $form;
            $this->scanning_name = $form->scanning_name;
            $this->form_id = $form->form_attribute_id;
            $this->address = $form->address;
            $this->ward_id = $form->ward_id;

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
//        'district_id' => ['required'],
        'ward_id' => ['required'],
        'address' => ['required'],
    ];

    public function saveForm()
    {
        $this->validate();

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
                $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated field data', 'admin'));
                
                redirect(route('admin.report'));

                $this->dispatch('success_alert', 'Data update successfully.');
                
            } else {
                $acting_user = User::find(auth()->user()->id);
                $$acting_user->notify(new UserActionNotification(auth()->user(), 'Added new field data', 'admin'));
                
                redirect(route('admin.report'));
                
                $this->dispatch('success_alert', 'Data saved successfully.');
                
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            
            $this->dispatch('failure_alert', 'An error occurred. Try again later.');
        }
    }

    public function updatedFormId()
    {
        $formsAttributes = FormAttribute::where('id', $this->form_id)->first();

        $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->orderBy('min', 'asc')->get();
        $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->orderBy('attribute_no', 'asc')->get();
    }

    // public function updatedRegionId()
    // {
    //     $this->region_id = auth()->user()->region_id;

    //     $this->districts = District::where('region_id', $this->region_id)->get();
    // }

    public function updatedDistrictId()
    {        
        $this->wards = Ward::where('district_id', $this->district_id)->get();
    }

    public function calculateTotal($attributeId, $gender)
    {
        return collect($this->formData)->sum(function ($ageGroup) use ($attributeId, $gender) {
            return $ageGroup[$attributeId][$gender] ?? 0;
        });
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

    public function render()
    {
        $formsAttributes = FormAttribute::all();
        // $regions = Region::all();
        
        $this->region_id = auth()->user()->region_id;
        $this->districts = District::where('region_id', $this->region_id)->get();
        
        return view('livewire.admin-panel.form-data', [
            'formsAttributes' => $formsAttributes,
            // 'regions' => $regions
            'districts' => $this->districts
        ]);
    }
}