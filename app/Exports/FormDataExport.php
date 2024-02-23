<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Form;
use App\Models\AgeGroup;
use App\Models\FormData;
use App\Models\Attribute;
use App\Models\FormAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormDataExport implements FromView, ShouldAutoSize
{   
    public $region_id, $startDate, $endDate, $scanning_name, $quartile;
    
    public $form_ids = [];


    public $form = [];

    public $ageGroups = [];

    public $attributeList = [];

    public $formData = [];

    protected $range;
    public function __construct($range)
    {
        $this->range = $range;
    }
    public function view() : view
    {

        $range = explode(',', $this->range);

        $this->startDate = date('Y-m-d', strtotime($range[0]));
        $this->endDate = date('Y-m-d', strtotime($range[1]));

        if((Carbon::parse($this->startDate)->startOfDay() >= date('Y', strtotime($range[0])).'-01-01 00:00:00') && (Carbon::parse($this->endDate)->startOfDay() <= date('Y', strtotime($range[1])).'-03-01 23:59:59')) {
            $this->quartile = '1st Quartile';
            
        } elseif((Carbon::parse($this->startDate)->startOfDay() >= date('Y', strtotime($range[0])).'-03-01 00:00:00') && (Carbon::parse($this->endDate)->startOfDay() <= date('Y', strtotime($range[1])).'-06-01 23:59:59')) {
            $this->quartile = '2nd Quartile';
            
        } elseif((Carbon::parse($this->startDate)->startOfDay() >= date('Y', strtotime($range[0])).'-06-01 00:00:00') && (Carbon::parse($this->endDate)->startOfDay() <= date('Y', strtotime($range[1])).'-09-01 23:59:59')) {
            $this->quartile = '3rd Quartile';
            
        } elseif((Carbon::parse($this->startDate)->startOfDay() >= date('Y', strtotime($range[0])).'-09-01 00:00:00') && (Carbon::parse($this->endDate)->startOfDay() <= date('Y', strtotime($range[1])).'-12-01 23:59:59')) {
            $this->quartile = '4th Quartile';
            
        } else {
            $this->quartile = '---';
        }

        $forms = Form::select('forms.*', 'form_attributes.updated_at as upt_at', 'form_attributes.created_at as crt_at')
            ->join('form_attributes', 'forms.form_attribute_id', '=', 'form_attributes.id')
            ->whereBetween('forms.updated_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()])
            ->where('forms.status', true)
            ->orderBy('crt_at', 'asc')
            ->get();

        $firstForm = Form::whereBetween('updated_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()])
            ->where('status', true)
            ->orderBy('updated_at', 'asc')
            ->first();

        $lastForm = Form::whereBetween('updated_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()])
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

        $j = 0;

        foreach($this->form_ids as $form_id) {
            $j++;
            
            if(!empty($form_id)) {
                $this->form[$j] = Form::where('form_attribute_id', $form_id)->first();
                $formsAttributes = FormAttribute::where('id', $this->form[$j]->form_attribute_id)->first();
                $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->orderBy('created_at', 'asc')->get();
                $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->orderBy('attribute_no', 'asc')->get();

                $formData = DB::select("SELECT form_data.attribute_id, form_data.age_group_id, 
                        SUM(form_data.male) as Male, 
                        SUM(form_data.female) as Female
                        FROM form_data 
                        JOIN forms ON form_data.form_id = forms.id 
                        JOIN attributes ON form_data.attribute_id = attributes.id  
                        WHERE forms.form_attribute_id = '".$this->form[$j]->form_attribute_id."'
                        AND form_data.updated_at BETWEEN '".Carbon::parse($this->startDate)->startOfDay()."' AND '".Carbon::parse($this->endDate)->startOfDay()."'
                        AND status = 1 
                        GROUP BY form_data.attribute_id, form_data.age_group_id 
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

       return view('exports.overall_report', [
            'quartile' => $this->quartile,
            'form_ids' => $this->form_ids,
            'form' => $this->form,
            'firstForm' => $firstForm,
            'lastForm' => $lastForm,
            'attributeList' => $this->attributeList,
            'ageGroups' => $this->ageGroups,
            'formData' => $this->formData,
       ]);
    }
}