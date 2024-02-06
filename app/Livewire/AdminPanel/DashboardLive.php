<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use App\Models\User;
use App\Models\Ward;
use App\Models\Region;
use Livewire\Component;
use App\Models\District;
use Spatie\Permission\Models\Role;

class DashboardLive extends Component
{
    public $keywords, $date, $rcs_count, $total_regions, $region_count, $total_districts, $district_count, $total_wards, $ward_count;

    public $total_reports_count, $submitted_report_count, $reports_in_field_count;

    public $ward_visited_ids = [];

    public $districts_visited_ids = [];

    public $regions_visited_ids = [];

    public function render()
    {
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

        // dd($this->regions_visited_ids);

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

        return view('livewire.admin-panel.dashboard-live', [
            'submitted_field_reports' => $submitted_field_reports
        ]);
    }
}