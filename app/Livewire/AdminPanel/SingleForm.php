<?php

namespace App\Livewire\AdminPanel;

use App\Models\Ward;
use Livewire\Component;
use App\Models\AgeGroup;
use App\Models\District;
use App\Models\Attribute;
use App\Models\FormAttribute;

class SingleForm extends Component
{
    public $form;
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
    // public $color = 'red';

    public $ageGroups = [];
    public $attributeList = [];

    public $formData = [];
    public $formData2 = [];

    public $editMode = false;

    public function mount($form)
    {
        if ($this->form) {
            $this->editMode = true;

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

    public function updatedFormId()
    {
        $formsAttributes = FormAttribute::where('id', $this->form_id)->first();
        $this->scanning_name = $formsAttributes->name;
        $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->get();
        $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->get();
    }

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


        return view('livewire.admin-panel.single-form', [
            'formsAttributes' => $formsAttributes,
            // 'regions' => $regions
            'districts' => $this->districts
        ]);
    }
}