<?php

namespace App\Livewire;

use App\Models\comments;
use DateTime;
use Carbon\Carbon;
use App\Models\Form;
use App\Models\User;
use Livewire\Component;
use App\Models\FormData;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ReportLive extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $keywords, $date, $from_date, $to_date;

    public $form_id, $report_name, $rc, $rc_image, $sender_id, $receiver_id, $content, $unread_comment_count;

    public $comments = [];
   
    public $quartiles = [];
    public $currentDateTime;
    public $quartRange = [];

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

    public function __construct(){
        $this->currentDateTime = Carbon::now()->toDateTimeString();
        $this->quartRange = ['2022-12-07 10:20:34', $this->currentDateTime];
        $this->quartiles['all'] = true;

    }
    
    public function submit()
    {

        //when 2025 change year or use getyear to keep it automatic
        foreach($this->quartiles as $quartile => $key){
            if ($key) {
                switch ($quartile) {
                    case 'all':
                        // $this->quartRange = ['2022-01-07 10:20:34', '2028-12-07 10:20:37'];
                        $this->quartRange = ['2022-01-07 10:20:34',  $this->currentDateTime];
                        break;
                    case 'q1':
                        $this->quartRange = ['2024-01-01 10:20:01', '2024-03-01 10:20:00'];
                        break;
                    case 'q2':
                        $this->quartRange = ['2024-03-01 10:20:01', '2024-06-01 10:20:00'];
                        break;
                    case 'q3':
                        $this->quartRange = ['2024-06-01 10:20:01', '2024-09-01 10:20:00'];
                        break;
                    case 'q4':
                        $this->quartRange = ['2024-09-01 10:20:01', '2024-12-01 10:20:00'];
                        break;
                }
            }

        }  
       
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
        
        // $formdata =  FormData::all();
            
        // // $res =  Form::all();
        //     // $formdata = $formdata->groupBy('attribute_id','form_id')->map(function ($group) {
        //     //     return $group->sortBy('age_group.min')->unique('age_group.min');
        //     // });

        // $res = Form::query()
        //     ->when($this->keywords, function ($query) {
        //         return $query->where(function ($query) {
        //             $query->where('scanning_name', 'like', '%' . $this->keywords . '%')
        //                 // ->orWhere('created_at', $this->date)
        //                 ->orWhereHas('ward', function ($query) {
        //                     $query->where('name', 'like', '%' . $this->keywords . '%');
        //                 })
        //                 ->orWhereHas('added_by', function ($query) {
        //                     $query->where('first_name', 'like', '%' . $this->keywords . '%')
        //                         ->orWhere('last_name', 'like', '%' . $this->keywords . '%');
        //                 });
        //         });
        //     })
        //     ->when($this->date, function ($query) {

        //         $query->whereBetween('created_at', ['2022-01-07', $this->date]);
        
        //     })
        //     ->with(['added_by', 'form_attribute', 'ward' => function($query){
        //         $query->with(['district' => function($district){
        //                         $district->with('region');
        //                     }]);
        //     }])->where('status', true)
        //     ->latest()
        //     ->paginate(10);

        // $res = Form::query()
        //     ->when($this->keywords, function ($query) {
        //         return $query->where(function ($query) {
        //             $query->where('scanning_name', 'like', '%' . $this->keywords . '%')
        //                 // ->orWhere('created_at', $this->date)
        //                 ->orWhereHas('ward', function ($query) {
        //                     $query->where('name', 'like', '%' . $this->keywords . '%');
        //                 })
        //                 ->orWhereHas('added_by', function ($query) {
        //                     $query->where('first_name', 'like', '%' . $this->keywords . '%')
        //                         ->orWhere('last_name', 'like', '%' . $this->keywords . '%');
        //                 })
        //                 ->orWhereHas('ward.district.region', function ($query) {
        //                     $query->where('name', 'like', '%' . $this->keywords . '%');
        //                 });
        //         });
        //     })
        //     ->when($this->date, function ($query) {

        //         $query->whereBetween('created_at', ['2022-01-07', $this->date]);
        
        //     })
        //     ->with(['added_by', 'form_attribute', 'ward' => function($query){
        //         $query->with(['district' => function($district){
        //                         $district->with('region');
        //                     }]);
        //     }])->where('status', true)
        //     ->latest()
        //     ->paginate(10);

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
            
        
        // $quartiles = $this->quartiles;

        // //when 2025 change year or use getyear to keep it automatic
        // foreach($quartiles as $quartile => $key){
        //     if($quartile == 'all'){
        //         // $this->from_date = date('Y-m-d', strtotime($this->date));
                            
        //         $this->quartRange = ['2022-12-07 10:20:34', '2027-12-07 10:20:37'];
                
        //         $this->from_date = $this->quartRange[0];
        //         $this->to_date = $this->quartRange[1];
        //     }
        // }

        
        // $formdata = FormData::groupBy(['attribute_id', 'age_group_id'])
        // ->select('attribute_id', 'age_group_id', 
        //         DB::raw('SUM(male) as male'), 
        //         DB::raw('SUM(female) as female')
        // )
        // ->when($this->from_date, $this->to_date, function ($query) {

        //     $query->whereBetween('created_at', [$this->from_date, $this->to_date]);
    
        // })
        // // ->whereBetween('created_at', $this->quartRange)
        // ->get();

        // $users = User::all();
        // return view('livewire.report-live',[
        //     'forms' => $res,
        //     'formDatas' => $formdata,
        //     'users' => $users
        // ]);

        $formdata =  FormData::all();
            
        // $res =  Form::all();
            // $formdata = $formdata->groupBy('attribute_id','form_id')->map(function ($group) {
            //     return $group->sortBy('age_group.min')->unique('age_group.min');
            // });

        
        $formdata = FormData::groupBy(['attribute_id', 'age_group_id'])
        ->select('attribute_id', 'age_group_id', 
                DB::raw('SUM(male) as male'), 
                DB::raw('SUM(female) as female')
        )->whereBetween('created_at', $this->quartRange)
        ->get();

        $users = User::all();
        return view('livewire.report-live',[
            'forms' => $res,
            'formDatas' => $formdata,
            'users' => $users
        ]);
    }

}