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

    public $main_attr;

    public $color = '';

    public $ageGroups = [];
    public $attributeList = [];

    public $formData = [];
    
    // public $excel_file;

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

    public function calculateTotalTested($attribute, $ageGroup, $gender)
    {
        $total = 0;
        foreach ($this->attributeList as $attribute) {
            if ($attribute->attribute_no == 6.0 || $attribute->attribute_no == 7.0 || $attribute->attribute_no == 8.0 || $attribute->attribute_no == 9.0 || $attribute->attribute_no == 10.0 || $attribute->attribute_no == 11.0)
            if (isset($this->formData[$ageGroup][$attribute->id][$gender])) {
                $total += $this->formData[$ageGroup][$attribute->id][$gender];
            }
            
            if ($attribute->attribute_no == 12.0) {
                $this->formData[$ageGroup][$attribute->id][$gender] = $total;
            }
        }
        return $total;
    }
    

    public function calculateTotal($attributeId, $gender)
    {
        return collect($this->formData)->sum(function ($ageGroup) use ($attributeId, $gender) {
            return intval($ageGroup[$attributeId][$gender] ?? 0);
        });
    }
    
    public function render()
    {
        if(!empty($this->form_id)) {
            $formsAttributes = FormAttribute::where('id', $this->form_id)->first();

            $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->orderBy('created_at', 'asc')->get();
            $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->orderBy('attribute_no', 'asc')->get();

        }

       
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