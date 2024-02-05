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
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     //
    // }

    public $form_id;

    public $form;

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
    public $total_female = [];

    public $total_male = [];

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

    public function view() : view
    {
        $this->form_id = request()->form_id;

        if(!empty($this->form_id)) {
            // dd($this->form_id);
            $this->form = Form::findOrFail($this->form_id);
            $formsAttributes = FormAttribute::where('id', $this->form->form_attribute_id)->first();
            // dd($formsAttributes);
            // $this->scanning_name = $formsAttributes->name;
            $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->orderBy('created_at', 'asc')->get();
            $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->orderBy('attribute_no', 'asc')->get();

            $this->scanning_name = $this->form->scanning_name;
            $this->address = $this->form->address;
            $this->ward_id = $this->form->ward_id;

            // $formData = \App\Models\FormData::where('form_id', $this->form->id)->orderBy('created_at','asc')
            // ->get();

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

                if (!isset($this->total_male[$data->age_group_id][$data->attribute_id])) {

                    $this->formData[$data->age_group_id][$data->attribute_id] = [

                        'M' => [],

                    ];

                }

                $this->total_male[$data->age_group_id][$data->attribute_id] = $data->male;
                $this->formData[$data->age_group_id][$data->attribute_id]['F'] = $data->female;
                $this->formData[$data->age_group_id][$data->attribute_id]['M'] = $data->male;
            }

        }

        // dd($this->total_male);

        // $this->calculateTotal();

        $formsAttributes = FormAttribute::orderBy('created_at','asc')->get();

        $this->region_id = auth()->user()->region_id;
        $this->districts = District::where('region_id', $this->region_id)->get();

        return view('exports.single_form', [
            'formsAttributes' => $formsAttributes,
            'form' => $this->form,
            'districts' => $this->districts,
            'address' => $this->address,
            'scanning_name' => $this->scanning_name,
            'attributeList' => $this->attributeList,
            'ageGroups' => $this->ageGroups,
            'formData' => $this->formData,
            'total_female' => 0,
            'total_male' => 0,
            'color' => '',
        ]);
    }
}