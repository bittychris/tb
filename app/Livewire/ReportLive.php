<?php

namespace App\Livewire;

use DateTime;
use Carbon\Carbon;
use App\Models\Form;
use App\Models\User;
use Livewire\Component;
use App\Models\FormData;
use App\Models\comments;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ReportLive extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $navigate_to = 'report';

    public $keywords, $date, $from_date, $to_date;

    public $form_id, $report_name, $rc, $rc_image, $sender_id, $receiver_id, $content, $unread_comment_count;

    public $comments = [];
   
    public $quartiles = [];

    public $currentDateTime;

    public $quartRange;

    public $selectedYear = '2024';

    public $startdate = "";

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
        
        $this->reset(
            'form_id',
            'receiver_id',
            'content'
        );

    }

    public function mount(){
        $this->currentDateTime = now()->toDateTimeString();
        $this->quartRange = ['2022-12-07 10:20:34', $this->currentDateTime];

    }
    
    public function submit()
    {   
        
        foreach ($this->quartiles as $quartile => $isSelected) {
            if ($isSelected) {
                $this->quartRange = $this->getQuartileRange($quartile);
            }
        }
        
    }

    private function getQuartileRange($quartile)
    {
        switch ($quartile) {
            case 'all':
                return ['2022-01-07 10:20:34', $this->currentDateTime];
            case 'q1':
                return [$this->selectedYear.'-01-01 10:20:01', $this->selectedYear.'-03-01 10:20:00'];
            case 'q2':
                return [$this->selectedYear.'-03-01 10:20:01', $this->selectedYear.'-06-01 10:20:00'];
            case 'q3':
                return [$this->selectedYear.'-06-01 10:20:01', $this->selectedYear.'-09-01 10:20:00'];
            case 'q4':
                return ['2024-09-01 10:20:01', '2024-12-01 10:20:00'];
            case 'range':
                return ['2024-09-01 10:20:01', '2024-12-01 10:20:00'];
            default:
                return null;
        }
    }

    public function updateStartDate()
    {
        $this->quartRange = [$this->startdate, $this->enddate];
    }

    public function updateEndDate()
    {
        $this->quartRange = [$this->startdate, $this->enddate];
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
            ->when($this->date, function ($query) {

                $query->whereBetween('created_at', ['2022-01-07', $this->date]);
        
            })
            ->with(['added_by', 'form_attribute', 'ward' => function($query){
                $query->with(['district' => function($district){
                                $district->with('region');
                            }]);
            }])->where('status', true)
            ->latest()
            ->paginate(10);

        $formdata = FormData::groupBy(['attribute_id', 'age_group_id'])
            ->select('attribute_id', 'age_group_id', 
                    DB::raw('SUM(male) as male'), 
                    DB::raw('SUM(female) as female')
            )->whereBetween('created_at', $this->quartRange)
            ->get();
        $this->quartiles = [];
        $users = User::all();

        return view('livewire.report-live', [
            'forms' => $res,
            'formDatas' => $formdata,
            'users' => $users,
        ]);
    }
}