<?php

namespace App\Exports;

use App\Models\Form;
use App\Models\User;
use App\Models\Ward;
use App\Models\AgeGroup;
use App\Models\District;
use App\Models\Attribute;
use App\Models\FormAttribute;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RegionalReportExport implements FromView, ShouldAutoSize
{
    public $region_id, $startDate, $endDate, $scanning_name, $rc;

    public $form_ids = [];

    public $form = [];

    public $ageGroups = [];

    public $attributeList = [];

    public $formData = [];


    public function view() : view
    {
        $this->region_id = request()->region_id;
        $this->startDate = request()->startDate;
        $this->endDate = request()->endDate;

        if($this->region_id == 0) {
            $this->region_id = '';
        }

        if($this->endDate == 0) {
            $this->endDate = '';
        }

        if($this->startDate == 0) {
            $this->startDate = '';
        }

        if($this->region_id) {
            $this->rc = User::where('region_id', $this->region_id)->get();
            $districts = District::select('id')->where('region_id', $this->region_id)->get();
            $district_ids = [];
            $ward_ids = [];
            foreach($districts as $district) {
                array_push($district_ids, $district->id);

            }

            $wards = Ward::whereIn('district_id', $district_ids)->get();

            foreach($wards as $ward) {
                array_push($ward_ids, $ward->id);

            }

            $forms = Form::whereIn('ward_id', $ward_ids)
            ->whereBetween('updated_at', [$this->startDate, $this->endDate])
            ->where('status', true)
            ->get();

            foreach($forms as $form) {
                array_push($this->form_ids, $form->id);
            }

            // dd($this->form_ids);
        }

        // $this->form_id = request()->form_id;

        $j = 0;

        foreach($this->form_ids as $form_id) {
            $j++;

            if(!empty($form_id)) {
                $this->form[$j] = Form::findOrFail($form_id);
                $formsAttributes = FormAttribute::where('id', $this->form[$j]->form_attribute_id)->first();
                $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->orderBy('created_at', 'asc')->get();
                $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->orderBy('attribute_no', 'asc')->get();

                // $this->scanning_name = $this->form->scanning_name;
                // $this->address = $this->form->address;
                // $this->ward_id = $this->form->ward_id;

                // $formData = \App\Models\FormData::where('form_id', $this->form->id)->orderBy('created_at','asc')
                // ->get();

                $formData = \App\Models\FormData::select('form_data.*', 'age_groups.min as age_group_min', 'attributes.attribute_no')
                        ->join('age_groups', 'form_data.age_group_id', '=', 'age_groups.id')
                        ->join('attributes', 'form_data.attribute_id', '=', 'attributes.id')
                        ->where('form_data.form_id', $this->form[$j]->id)
                        ->get();

                foreach ($formData as $data) {
                    if (!isset($this->formData[$j][$data->age_group_id][$data->attribute_id])) {

                            $this->formData[$j][$data->age_group_id][$data->attribute_id] = [

                                'F' => [],

                                'M' => [],

                        ];

                    }

                    $this->formData[$j][$data->age_group_id][$data->attribute_id]['F'] = $data->female;
                    $this->formData[$j][$data->age_group_id][$data->attribute_id]['M'] = $data->male;
                }

            }

            // dd($this->formData);

        }

        // dd($this->total_male);

        // $this->calculateTotal();

        // $formsAttributes = FormAttribute::orderBy('created_at','asc')->get();

        // $this->region_id = auth()->user()->region_id;
        // $this->districts = District::where('region_id', $this->region_id)->get();

        return view('exports.regional_report', [
            // 'formsAttributes' => $formsAttributes,
            'form_ids' => $this->form_ids,
            'rc' => $this->rc,
            'form' => $this->form,
            // 'districts' => $this->districts,
            // 'address' => $this->address,
            'attributeList' => $this->attributeList,
            'ageGroups' => $this->ageGroups,
            'formData' => $this->formData,
            // 'total_female' => 0,
            // 'total_male' => 0,
            // 'color' => '',
        ]);
    }
}