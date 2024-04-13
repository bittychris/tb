<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use App\Models\User;
use App\Models\Ward;
use App\Models\Region;
use Livewire\Component;
use App\Models\District;
use App\Models\FormData;
use App\Models\Attribute;
use App\Models\FormAttribute;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardLive extends Component
{
    public $keywords, $date, $rcs_count, $total_regions, $region_count, $total_districts, $district_count, $total_wards, $ward_count;

    public $total_reports_count, $submitted_report_count, $reports_in_field_count;

    // public $form_id = '2420fdd8-6a21-46ea-874d-37768f84afd3';

    public $formsAttributes;

    public $formsAttribute;
    
    public $labels = [];

    public $maleDatasets = [];

    public $femaleDatasets = [];
    
    // public $form_id = '249466c0-f8b1-493d-9049-744de6591339'; // public meeting report

    public $ward_visited_ids = [];

    public $districts_visited_ids = [];

    public $regions_visited_ids = [];

    // public function updateFormId(){
    //     return $this->getChartData();
        
    // }
    
    public function getChartData() {

        $this->dispatch('updateChart');

        $mainAttribute = '';
        // $labels = [];
        $datasets = [];
        // $maleDatasets = [];
        // $femaleDatasets = [];

        // if(!empty($this->form_id)) {

            $this->formsAttribute = FormAttribute::where('name', 'TB SCREENING (CI+ACF)')->first();

            $attributeList = Attribute::whereIn('id', json_decode($this->formsAttribute->attribute_ids))->get();
            
            foreach($attributeList as $attribute) {
                if($attribute->attribute_no == 1.0) {
                    $mainAttribute = $attribute;
    
                } elseif($attribute->attribute_no == 0.1) {
                    $mainAttribute = $attribute;
    
                } elseif($attribute->attribute_no == 0.2) {
                    $mainAttribute = $attribute;
    
                }
            }
            
            $forms = Form::where('form_attribute_id', $this->formsAttribute->id)->get();

            if($forms) {
                $form_ids = [];
                $labels = [];
                $datasets = [];

                foreach($forms  as $form) {
                    array_push($form_ids, $form->id);
                }

                $formData = FormData::selectRaw('SUM(male) as total_male, SUM(female) as total_female, regions.name as region')
                    ->join('forms', 'form_data.form_id', '=', 'forms.id')
                    ->join('wards', 'forms.ward_id', '=', 'wards.id')
                    ->join('districts', 'wards.district_id', '=', 'districts.id')
                    ->join('regions', 'districts.region_id', '=', 'regions.id')
                    ->where('forms.form_attribute_id', '=', $this->formsAttribute->id)
                    // ->where('forms.form_attribute_id', '=', '2420fdd8-6a21-46ea-874d-37768f84afd3')
                    ->where('form_data.attribute_id', '=', '6a00ea10-2cde-4063-a0a2-a3f75a7c4697')
                    ->where('forms.status', '=', 1)
                    ->orderBy('regions.name', 'asc')
                    ->groupBy('region')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->region => [
                            'male' => $item->total_male,
                            'female' => $item->total_female,
                        ]];
                    });
                
                foreach($formData as $region => $data) {
                    array_push($this->labels, $region);
                    array_push($datasets, $data);

                }

                foreach($datasets as $data) {
                    array_push($this->maleDatasets, $data['male']);
                    array_push($this->femaleDatasets, $data['female']);

                }
            }          

        // }

        $this->dispatch('renderChart');


    }

    public function render()
    {
        // if(!empty($this->form_id)) {
            $this->getChartData();

        // }

        $rc_role = Role::findByName('Regional coordinator');

        $this->rcs_count = User::where('role_id', $rc_role->id)->count();

        $this->total_regions = Region::all()->count();

        $this->total_districts = District::all()->count();

        $this->total_wards = Ward::all()->count();

        $wards_visited = Form::all();

        foreach($wards_visited as $ward) {
            array_push($this->ward_visited_ids, $ward->ward_id);

        }

        $this->ward_count = count(array_unique($this->ward_visited_ids));

        $ward_ids = array_unique($this->ward_visited_ids);

        $wards_visited = Ward::whereIn('id', $ward_ids)->get();

        foreach($wards_visited as $ward) {
            array_push($this->districts_visited_ids, $ward->district_id);

        }

        $this->district_count = count(array_unique($this->districts_visited_ids));

        $districts_visited = District::whereIn('id', $this->districts_visited_ids)->get();

        foreach($districts_visited as $district) {
            array_push($this->regions_visited_ids, $district->region_id);

        }

        $this->region_count = count(array_unique($this->regions_visited_ids));

        $this->total_reports_count = Form::all()->count();

        $this->reports_in_field_count = Form::where('status', false)->count();

        $submitted_field_reports = Form::query()
            ->when($this->keywords, function ($query) {
                return $query->where(function ($query) {
                    $query->where('scanning_name', 'like', '%' . $this->keywords . '%')
                        // ->orWhere('created_at', $this->date)
                        ->orWhereHas('ward', function ($query) {
                            $query->where('name', 'like', '%' . $this->keywords . '%');
                        })
                        ->orWhereHas('added_by', function ($query) {
                            $query->where('first_name', 'like', '%' . $this->keywords . '%')
                                ->orWhere('last_name', 'like', '%' . $this->keywords . '%');
                        })
                        ->orWhereHas('ward.district', function ($query) {
                            $query->where('name', 'like', '%' . $this->keywords . '%');
                        })
                        ->orWhereHas('ward.district.region', function ($query) {
                            $query->where('name', 'like', '%' . $this->keywords . '%');
                        });
                });
            })
            ->when($this->date, function ($query) {

                $query->whereBetween('created_at', ['2022-01-07', $this->date]);

            })
            ->with(['added_by', 'form_attribute', 'ward' => function($query){
                $query->with(['district' => function($district){
                                $district->with('region');
                            }]);
            }])->where('status', true)
            ->latest()
            ->limit(10)->get();

        $this->submitted_report_count = $submitted_field_reports->count();

        $this->formsAttributes = FormAttribute::orderBy('created_at','asc')->get();
        
        return view('livewire.admin-panel.dashboard-live', [
            'submitted_field_reports' => $submitted_field_reports,
            'formsAttributes' => $this->formsAttributes,
            // 'labels' => $this->labels,
            // 'maleDatasets' => $this->maleDatasets,
            // 'femaleDatasets' => $this->femaleDatasets,
        ]);
    }
}