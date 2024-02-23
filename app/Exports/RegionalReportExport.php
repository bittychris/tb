<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Form;
use App\Models\User;
use App\Models\Ward;
use App\Models\AgeGroup;
use App\Models\District;
use App\Models\FormData;
use App\Models\Attribute;
use App\Models\FormAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RegionalReportExport implements FromView, ShouldAutoSize
{
    public $region_id, $startDate, $endDate, $scanning_name, $rc, $quartile;

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

        if((Carbon::parse($this->startDate)->startOfDay() >= date('Y', strtotime($this->startDate)).'-01-01 00:00:00') && (Carbon::parse($this->endDate)->startOfDay() <= date('Y', strtotime($this->endDate)).'-03-01 23:59:59')) {
            $this->quartile = '1st Quartile';
            
        } elseif((Carbon::parse($this->startDate)->startOfDay() >= date('Y', strtotime($this->startDate)).'-03-01 00:00:00') && (Carbon::parse($this->endDate)->startOfDay() <= date('Y', strtotime($this->endDate)).'-06-01 23:59:59')) {
            $this->quartile = '2nd Quartile';
            
        } elseif((Carbon::parse($this->startDate)->startOfDay() >= date('Y', strtotime($this->startDate)).'-06-01 00:00:00') && (Carbon::parse($this->endDate)->startOfDay() <= date('Y', strtotime($this->endDate)).'-09-01 23:59:59')) {
            $this->quartile = '3rd Quartile';
            
        } elseif((Carbon::parse($this->startDate)->startOfDay() >= date('Y', strtotime($this->startDate)).'-09-01 00:00:00') && (Carbon::parse($this->endDate)->startOfDay() <= date('Y', strtotime($this->endDate)).'-12-01 23:59:59')) {
            $this->quartile = '4th Quartile';
            
        } else {
            $this->quartile = '---';
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

            $forms = Form::select('forms.*', 'form_attributes.updated_at as upt_at', 'form_attributes.created_at as crt_at')
                ->join('form_attributes', 'forms.form_attribute_id', '=', 'form_attributes.id')
                ->whereIn('ward_id', $ward_ids)
                ->whereBetween('forms.updated_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()])
                ->where('forms.status', true)
                ->orderBy('crt_at', 'asc')
                ->get();

            $firstForm = Form::whereIn('ward_id', $ward_ids)
                ->whereBetween('updated_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()])
                ->where('status', true)
                ->orderBy('updated_at', 'asc')
                ->first();

            $lastForm = Form::whereIn('ward_id', $ward_ids)
                ->whereBetween('updated_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()])
                ->where('status', true)
                ->latest()
                ->first();

            $form_attribute_ids = [];

            foreach($forms as $form) {
                array_push($form_attribute_ids, $form->form_attribute_id);
            }

            foreach(array_unique($form_attribute_ids) as $form_id) {
                array_push($this->form_ids, $form_id);
            }

        }

        $j = 0;

        foreach($this->form_ids as $form_id) {
            $j++;
            
            if(!empty($form_id)) {
                $this->form[$j] = Form::where('form_attribute_id', $form_id)->first();
                $formsAttributes = FormAttribute::where('id', $this->form[$j]->form_attribute_id)->first();
                $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->orderBy('created_at', 'asc')->get();
                $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->orderBy('attribute_no', 'asc')->get();

                // $formData = \App\Models\FormData::select('form_data.*', 'age_groups.min as age_group_min', 'attributes.attribute_no')
                //         ->join('age_groups', 'form_data.age_group_id', '=', 'age_groups.id')
                //         ->join('attributes', 'form_data.attribute_id', '=', 'attributes.id')
                //         ->where('form_data.form_id', $this->form[$j]->id)
                //         ->get();

                $formData = DB::select("SELECT form_data.attribute_id, form_data.age_group_id, 
                        SUM(form_data.male) as Male, 
                        SUM(form_data.female) as Female, 
                        regions.name AS Region 
                        FROM form_data 
                        JOIN forms ON form_data.form_id = forms.id 
                        JOIN attributes ON form_data.attribute_id = attributes.id 
                        JOIN wards ON forms.ward_id = wards.id 
                        JOIN districts ON wards.district_id = districts.id 
                        JOIN regions ON districts.region_id = regions.id 
                        WHERE forms.form_attribute_id = '".$this->form[$j]->form_attribute_id."'
                        AND form_data.updated_at BETWEEN '".Carbon::parse($this->startDate)->startOfDay()."' AND '".Carbon::parse($this->endDate)->startOfDay()."'
                        AND regions.id = ".$this->region_id."
                        AND status = 1 
                        GROUP BY form_data.attribute_id, form_data.age_group_id, regions.name 
                        ORDER BY attributes.attribute_no ASC;");

                foreach ($formData as $data) {
                    if (!isset($this->formData[$j][$data->age_group_id][$data->attribute_id])) {

                            $this->formData[$j][$data->age_group_id][$data->attribute_id] = [

                                'F' => [],

                                'M' => [],

                        ];

                    }

                    $this->formData[$j][$data->age_group_id][$data->attribute_id]['F'] = $data->Female;
                    $this->formData[$j][$data->age_group_id][$data->attribute_id]['M'] = $data->Male;
                }

            }

        }
        
        return view('exports.regional_report', [
            'quartile' => $this->quartile,
            'form_ids' => $this->form_ids,
            'rc' => $this->rc,
            'form' => $this->form,
            'firstForm' => $firstForm,
            'lastForm' => $lastForm,
            'attributeList' => $this->attributeList,
            'ageGroups' => $this->ageGroups,
            'formData' => $this->formData,
        ]);
    }
}