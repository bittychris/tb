<?php

namespace App\Livewire\AdminPanel;

use App\Models\AgeGroup;
use App\Models\Attribute;
use App\Models\District;
use App\Models\FormAttribute;
use App\Models\FormData as ModelsFormData;
use App\Models\Region;
use App\Models\Ward;
use Livewire\Component;

class FormData extends Component
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

    public $ageGroups = [];
    public $attributeList = [];

    public $formData = [];

    public function mount($form)
    {
        $this->form = $form;

    }

    protected $rules = [
        'scanning_name' => ['required'],
        'region_id' => ['required'],
        'district_id' => ['required'],
        'ward_id' => ['required'],
        'address' => ['required'],
    ];

    public function saveForm()
    {
        dd($this->formData);
    }

    public function updatedFormId(){
        $formsAttributes = FormAttribute::where('id', $this->form_id)->first();

        $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->get();
        $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->get();
    }
    public function updatedRegionId()
    {
        $this->districts = District::where('region_id', $this->region_id)->get();
    }
    public function updatedDistrictId()
    {
        $this->wards = Ward::where('district_id', $this->district_id)->get();
    }

    public function render()
    {
        $formsAttributes = FormAttribute::all();
        $regions = Region::all();
        return view('livewire.admin-panel.form-data', [
            'formsAttributes' => $formsAttributes,
            'regions' => $regions
        ]);
    }
}
