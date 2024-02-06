<?php

namespace App\Exports;

use App\Models\Form;
use App\Models\Ward;
use App\Models\AgeGroup;
use App\Models\District;
use App\Models\Attribute;
use App\Models\FormAttribute;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SingleFormDataExport implements FromView, ShouldAutoSize
{
    public $form_id;

    public $form;

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

    public $editMode = false;

    public function view() : view
    {
        $this->form_id = request()->form_id;

        if(!empty($this->form_id)) {
            $this->form = Form::findOrFail($this->form_id);
            $formsAttributes = FormAttribute::where('id', $this->form->form_attribute_id)->first();
            $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->orderBy('created_at', 'asc')->get();
            $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->orderBy('attribute_no', 'asc')->get();

            $this->scanning_name = $this->form->scanning_name;
            $this->address = $this->form->address;
            $this->ward_id = $this->form->ward_id;

            $formData = \App\Models\FormData::select('form_data.*', 'age_groups.min as age_group_min', 'attributes.attribute_no')
                    ->join('age_groups', 'form_data.age_group_id', '=', 'age_groups.id')
                    ->join('attributes', 'form_data.attribute_id', '=', 'attributes.id')
                    ->where('form_data.form_id', $this->form->id)
                    ->get();

            foreach ($formData as $data) {
                if (!isset($this->formData[$data->age_group_id][$data->attribute_id])) {

                        $this->formData[$data->age_group_id][$data->attribute_id] = [

                            'F' => [],

                            'M' => [],

                    ];

                }

                $this->formData[$data->age_group_id][$data->attribute_id]['F'] = $data->female;
                $this->formData[$data->age_group_id][$data->attribute_id]['M'] = $data->male;
            }

        }

        $formsAttributes = FormAttribute::orderBy('created_at','asc')->get();

        return view('exports.single_form', [
            'formsAttributes' => $formsAttributes,
            'form' => $this->form,
            'address' => $this->address,
            'scanning_name' => $this->scanning_name,
            'attributeList' => $this->attributeList,
            'ageGroups' => $this->ageGroups,
            'formData' => $this->formData,
            'total_female' => 0,
            'total_male' => 0,
        ]);
    }
}