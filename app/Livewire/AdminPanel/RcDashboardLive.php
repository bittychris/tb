<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use App\Models\User;
use App\Models\Ward;
use App\Models\Region;
use Livewire\Component;
use App\Models\District;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserActionNotification;

class RcDashboardLive extends Component
{
    public $form_id, $report_name, $submit_status, $keywords, $date, $submission_status;

    public $rcs_count, $total_regions, $region_count, $total_districts, $district_count, $total_wards, $ward_count;

    public $total_reports_count, $submitted_report_count, $reports_in_field_count;

    public $ward_visited_ids = [];

    public $districts_visited_ids = [];

    public $regions_visited_ids = [];

    public function getFormData($report_id) {
        $this->form_id = $report_id;
        $report = Form::find($this->form_id);
        $this->report_name = $report->form_attribute->name;

        $this->dispatch('openSubmitDataModel');

    }

    public function submitData() {
        $form_data = DB::table('form_data')
                        ->where('form_id', $this->form_id)
                        ->where('male', null)
                        ->orWhere('female', null)
                        ->get();

        if(count($form_data) > 0) {
            $this->dispatch('failure_alert', 'Failed to submit data, some parts of the form are empty');

        } else {
            $submit_report = DB::table('forms')
                                ->where('id', $this->form_id)
                                ->where('created_by', auth()->user()->id)
                                ->update([
                                        'status' => true,
                                    ]);

            if ($submit_report) {
                $acting_user = User::find(auth()->user()->id);
                $acting_user->notify(new UserActionNotification(auth()->user(), 'Submitted field data', 'Admin and AMREF personnel'));

                $this->dispatch('closeModel');
                $this->dispatch('success_alert', 'Field data submitted successfully.');

            } else {
                $this->dispatch('failure_alert', 'An error occurred. Try again later.');

            }

        }

    }

    public function clearForm() {
        $this->reset(
            'form_id',
        );
    }

    public function render()
    {
        // $rc_role = Role::findByName('Regional coordinator');

        // $this->rcs_count = User::where('role_id', $rc_role->id)->count();

        // $this->total_regions = Region::all()->count();

        $this->total_districts = District::where('region_id', auth()->user()->region_id)->count();

        $districts = District::where('region_id', auth()->user()->region_id)->get();

        $district_ids = [];

        foreach($districts as $district) {
            array_push($district_ids, $district->id);

        }

        $this->total_wards = Ward::whereIn('district_id', $district_ids)->count();


        $wards_visited = Form::where('created_by', Auth::user()->id)->get();

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

        // $districts_visited = District::whereIn('id', $this->districts_visited_ids)->get();


        // foreach($districts_visited as $district) {
        //     array_push($this->regions_visited_ids, $district->region_id);

        // }

        // $this->region_count = count(array_unique($this->regions_visited_ids));

        // dd($this->regions_visited_ids);

        $this->reports_in_field_count = Form::where('status', false)->where('created_by', Auth::user()->id)->count();

        $this->submitted_report_count = Form::where('status', true)->where('created_by', Auth::user()->id)->count();

        $field_data = Form::query()
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
                ->when($this->submission_status, function ($query) {

                    $query->where('status', 'like', '%' .$this->submission_status. '%');

                })
                ->when($this->date, function ($query) {

                    $query->whereBetween('created_at', ['2022-01-07', $this->date]);

                })
                ->with(['added_by', 'form_attribute', 'ward' => function($query){
                    $query->with(['district' => function($district){
                                    $district->with('region');
                                }]);
                }])
                ->where('created_by', Auth::user()->id)
                ->latest()
                ->limit(10)->get();

        $this->total_reports_count = $field_data->count();

        return view('livewire.admin-panel.rc-dashboard-live', [
            'field_data' => $field_data
        ]);
    }
}