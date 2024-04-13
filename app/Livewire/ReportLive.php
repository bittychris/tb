<?php

namespace App\Livewire;

use App\Models\AgeGroup;
use DateTime;
use Carbon\Carbon;
use App\Models\Form;
use App\Models\User;
use App\Models\Ward;
use App\Models\Region;
use Livewire\Component;
use App\Models\comments;
use App\Models\District;
use App\Models\FormData;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ReportLive extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $navigate_to = 'report';

    public $keywords, $date, $from_date, $to_date, $region_id;

    public $form_id, $report_name, $rc, $rc_image, $sender_id, $receiver_id, $content, $unread_comment_count;

    public $startDate = '1999-01-07 10:20:34';

    public $endDate;

    public $form_to_export_ids = [];

    public $comments = [];

    public $form_ids = [];

    public $select_all_quartiles = false;

    public $quartile;

    public $quartiles = [];

    public $formData = [];

    public $currentDateTime;

    public $quartRange;

    public $selectedYear = '2024';

    public $startdate = '1999-01-07 10:20:34';

    public $enddate = "";

    public function navigateTo($show) {
        $this->navigate_to = $show;

    }

    // Comments part
    protected function rules() {

        return [
            'content' => ['required', 'string']
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function getReportDetails($form_id) {
        $this->form_id = $form_id;

        $report_details = Form::find($this->form_id);

        $this->report_name = $report_details->scanning_name;
        $this->rc = $report_details->added_by->first_name. ' ' .$report_details->added_by->last_name;
        $this->rc_image = $report_details->added_by->image;
        $this->receiver_id = $report_details->added_by->id;

        $this->dispatch('openCommentModel');

    }

    public function sendComment() {
        $validatedData = $this->validate();

        $comment = comments::create([
            'form_id' => $this->form_id,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->receiver_id,
            'content' => $validatedData['content'],
        ]);

        if($comment) {
            $this->clearForm();

        }

    }

    public function clearForm() {
        $this->reset(
            'content'
        );
    }

    public function reloadComments() {
        $this->unread_comment_count = comments::where('form_id', $this->form_id)->where('receiver_id', auth()->user()->id)->where('read_at', null)->count();

        $this->comments = comments::where(function ($query) {

            $query->where('form_id', $this->form_id)

                  ->where(function ($query) {

                      $query->where('sender_id', auth()->user()->id)

                            ->orWhere('receiver_id', auth()->user()->id);

                  });

        })->orderBy('created_at', 'asc')->get();

    }

    public function sendEditLink()
    {
        $content = "edit_report-" .$this->form_id. "";

        $edit_link = comments::create([
            'form_id' => $this->form_id,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->receiver_id,
            'content' => $content,
        ]);

        if($edit_link) {
            $this->clearForm();

        }

    }

    public function closeCommentModel() {
        $this->dispatch('closeCommentModel');

        $remove_unread_status = comments::where(function ($query) {

            $query->where('form_id', $this->form_id)

                  ->where(function ($query) {

                      $query->where('receiver_id', auth()->user()->id);

                  });

        })->update([
            'read_at' => Carbon::now()
        ]);

        if($remove_unread_status) {
            $this->reset(
                'form_id',
                'receiver_id',
                'content'
            );

            return redirect(route('admin.reporting'));

        }


    }

    public function mount($report = null){
        $this->currentDateTime = now()->toDateTimeString();
        $this->endDate = now()->toDateTimeString();
        $this->enddate = now()->toDateTimeString();
        $this->quartRange = ['1999-01-01 00:00:00', $this->currentDateTime];

        if(!empty($report)) {
            $this->form_id = $report;

            $this->getReportDetails($this->form_id);
        }

    }

    public function SelectAllQuartiles() {
        $this->quartile = '';
        $this->quartRange = '';
        $this->form_ids = [];

        $this->quartRange = [$this->selectedYear.'-01-01 00:00:00', $this->selectedYear.'-12-01 23:59:59'];
        $this->startdate = $this->quartRange[0];
        $this->enddate = $this->quartRange[1];

        if(!empty($this->region_id)) {
            $this->form_ids = [];
            
            $region = Region::find($this->region_id);

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

            $forms = Form::whereIn('ward_id', $ward_ids)->where('status', true)
                ->whereBetween('created_at', $this->quartRange)
                ->get();

            foreach($forms as $form) {
                array_push($this->form_ids, $form->id);

            }

            $this->select_all_quartiles = true;

            if(count($this->form_ids) == 0) {
                $this->select_all_quartiles = false;
                $this->dispatch('message_alert', 'There is no Overall Field Data for '.$region->name. ' region in Year '.$this->selectedYear);
                $this->quartRange = [$this->selectedYear.'-01-01 00:00:00', $this->currentDateTime];

                $this->region_id = '';
            
            } else {
                return $this->form_ids;
            }

        } else {

            $forms = Form::where('status', true)
            ->whereBetween('created_at', $this->quartRange)
            ->get();
    
            foreach($forms as $form) {
                array_push($this->form_ids, $form->id);
    
            }

            $this->select_all_quartiles = true;

            if(count($this->form_ids) == 0) {
                $this->select_all_quartiles = false;
                $this->dispatch('message_alert', 'There is no Overall Field Data for year '.$this->selectedYear);
                $this->quartRange = [$this->selectedYear.'-01-01 00:00:00', $this->currentDateTime];
    
            } else {
                return $this->form_ids;
            }

        } 
            
    }

    public function DeselectAllQuartiles() {
        $this->quartile = '';

        $this->quartRange = [$this->selectedYear.'-01-01 00:00:00', $this->selectedYear.'-12-01 23:59:59'];
        $this->startdate = $this->quartRange[0];
        $this->enddate = $this->quartRange[1];

        $this->select_all_quartiles = false;
            
    }

    public function submit()
    {
        $this->form_ids = [];
        
        $this->quartRange = $this->getQuartileRange($this->quartile);
        $this->startdate = $this->quartRange[0];
        $this->enddate = $this->quartRange[1];

        if($this->quartile == 'q1') {
            $quartile = '1st Quartile';
            
        } elseif($this->quartile == 'q2') {
            $quartile = '2nd Quartile';
            
        } elseif($this->quartile == 'q3') {
            $quartile = '3rd Quartile';
            
        } elseif($this->quartile == 'q4') {
            $quartile = '4th Quartile';
            
        }

        if(!empty($this->region_id)) {
            $this->form_ids = [];
            
            $region = Region::find($this->region_id);

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

            $forms = Form::whereIn('ward_id', $ward_ids)->where('status', true)
                ->whereBetween('created_at', $this->quartRange)
                ->get();

            foreach($forms as $form) {
                array_push($this->form_ids, $form->id);

            }

            if(count($this->form_ids) == 0) {
                $this->dispatch('message_alert', 'There is no Overall Field Data for '.$region->name. ' region in '.$quartile.' of Year '.$this->selectedYear);
                // $this->region_id = '';
                $this->quartile = '';
                $this->quartRange = [$this->selectedYear.'-01-01 00:00:00', $this->currentDateTime];
            
            } else {
                return $this->form_ids;
            }

        } else {

            $forms = Form::where('status', true)
            ->whereBetween('created_at', $this->quartRange)
            ->get();
    
            foreach($forms as $form) {
                array_push($this->form_ids, $form->id);
    
            }

            if(count($this->form_ids) == 0) {
                $this->dispatch('message_alert', 'There is no Overall Field Data in '.$quartile.' of year '.$this->selectedYear);
                $this->quartile = '';
                $this->quartRange = [$this->selectedYear.'-01-01 00:00:00', $this->currentDateTime];
    
            } else {
                return $this->form_ids;
            }

        } 
        
    }

    private function getQuartileRange($quartile)
    {
        switch ($quartile) {
            // case 'all':
            //     return ['2024-01-01 00:00:00', $this->currentDateTime];

            case 'q1':
                return [$this->selectedYear.'-01-01 00:00:00', $this->selectedYear.'-03-01 23:59:59'];

            case 'q2':
                return [$this->selectedYear.'-03-01 00:00:00', $this->selectedYear.'-06-01 23:59:59'];

            case 'q3':
                return [$this->selectedYear.'-06-01 00:00:00', $this->selectedYear.'-09-01 23:59:59'];
            case 'q4':
                return [$this->selectedYear.'-09-01 00:00:00', $this->selectedYear.'-12-01 23:59:59'];
            default:
                return null;

        }
    }

    public function updateStartDate()
    {
        return $this->quartRange = [Carbon::parse($this->startdate)->startOfDay(), Carbon::parse($this->enddate)->endOfDay()];
    }

    public function updateEndDate()
    {
        return $this->quartRange = [Carbon::parse($this->startdate)->startOfDay(), Carbon::parse($this->enddate)->endOfDay()];
    }

    // function to calculate Total
    public function calculateTotal($attributeId, $gender)
    {
        return collect($this->formData)->sum(function ($ageGroup) use ($attributeId, $gender) {
            return intval($ageGroup[$attributeId][$gender] ?? 0);
        });
    }

    public function render()
    {
        // Comments
        $this->comments = comments::where(function ($query) {

            $query->where('form_id', $this->form_id)

                  ->where(function ($query) {

                      $query->where('sender_id', auth()->user()->id)

                            ->orWhere('receiver_id', auth()->user()->id);

                  });

        })->orderBy('created_at', 'asc')->get();

        $this->unread_comment_count = comments::where('form_id', $this->form_id)->where('receiver_id', auth()->user()->id)->where('read_at', null)->count();

        $res = Form::query()
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
            ->when($this->startDate && $this->endDate, function ($query) {

                $query->whereBetween('updated_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()]);

            })
            ->with(['added_by', 'form_attribute', 'ward' => function($query){
                $query->with(['district' => function($district){
                                $district->with('region');
                            }]);
            }])->where('status', true)
            ->latest()
            ->paginate(10);

            
        if(!empty($this->region_id)) {
            $this->form_ids = [];
            
            $region = Region::find($this->region_id);

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

            $forms = Form::whereIn('ward_id', $ward_ids)->where('status', true)
                ->whereBetween('created_at', $this->quartRange)
                ->get();

            foreach($forms as $form) {
                array_push($this->form_ids, $form->id);

            }

            if(count($this->form_ids) == 0) {
                $this->dispatch('message_alert', 'There is no Field Data for '.$region->name. ' region');
                $this->region_id = '';
            
            }

        } else {
            $this->form_ids = [];

            $forms = Form::where('status', true)
                ->whereBetween('created_at', $this->quartRange)
                ->get();

            foreach($forms as $form) {
                array_push($this->form_ids, $form->id);

            }

        }
        
        $formdata = FormData::selectRaw('SUM(male) as total_male, SUM(female) as total_female, form_data.attribute_id, attributes.id as attributeId, form_data.age_group_id as age_groupId')
        
                    ->join('forms', 'form_data.form_id', '=', 'forms.id')
                    ->join('attributes', 'form_data.attribute_id', '=', 'attributes.id')
                    ->join('wards', 'forms.ward_id', '=', 'wards.id')
                    ->join('districts', 'wards.district_id', '=', 'districts.id')
                    ->join('regions', 'districts.region_id', '=', 'regions.id')
                    ->when($this->form_ids, function ($query) {
                                $query->whereIn('form_data.form_id', $this->form_ids);
                
                    })
                    ->where('forms.status', '=', 1)
                    ->orderBy('attributes.attribute_no', 'asc')
                    ->groupBy(['attributeId', 'age_groupId'])
                    ->get();
        
        foreach ($formdata as $data) {
            $this->formData[$data->age_groupId][$data->attributeId]['M'] = $data->total_male;
            $this->formData[$data->age_groupId][$data->attributeId]['F'] = $data->total_female;
        }
        
        $users = User::all();

        $attributes = Attribute::orderBy('attribute_no', 'asc')->get();

        $ageGroups = AgeGroup::orderBy('min', 'asc')->get();

        $regions = Region::orderBy('name', 'asc')->get();

        return view('livewire.report-live', [
            'forms' => $res,
            'formData' => $this->formData,
            'users' => $users,
            'attributeList' => $attributes,
            'ageGroups' => $ageGroups,
            'regions' => $regions,
        ]);
    }
}