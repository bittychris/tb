<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use App\Models\User;
use Livewire\Component;
use App\Models\comments;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserActionNotification;

class ReportList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $form_id, $report_name, $submit_status, $keywords, $date, $submission_status;

    public $rc, $rc_image, $sender_id, $receiver_id, $content, $unread_comment_count;

    public $comments = [];

    // public $submission_status = 'all';

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
        // $this->receiver_id = $report_details->added_by->id;

        $this->dispatch('openCommentModel');

    }

    public function sendComment() {
        $validatedData = $this->validate();

        $last_comment = comments::where('sender_id', auth()->user()->id)->orWhere('receiver_id', auth()->user()->id)->latest()->limit(1)->get();
        // dd($last_comment);

        foreach($last_comment as $comment) {
            if($comment->receiver_id == auth()->user()->id) {
                $this->receiver_id = $comment->sender_id;

            } else {
                $this->receiver_id = $comment->receiver_id;

            }
            
        }
        
        $comment = comments::create([
            'form_id' => $this->form_id,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->receiver_id,
            'content' => $validatedData['content'],
        ]);

        if($comment) {
            $this->reset(
                'content'
            );

            $this->comments = comments::where(function ($query) {

                $query->where('form_id', $this->form_id)
            
                      ->where(function ($query) {
            
                          $query->where('sender_id', auth()->user()->id)
            
                                ->orWhere('receiver_id', auth()->user()->id);
            
                      });
            
            })->orderBy('created_at', 'asc')->get();
        }
        
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


    // public function mount()
    // {

    //     $this->timer(500, $this->reloadComments());

    // }

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


    public function clearForm() {
        $this->reset(
            'form_id',
            'content'
        );
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
        
        // if(empty($this->submission_status)) {
        //     dd($this->submission_status);
        // }

        if((auth()->user()->role->name == 'Admin') || (auth()->user()->role->name == 'AMREF personnel')) {

            // $reports = Form::query()
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

            //         $query->where('created_at', 'like', '%'.$this->date.'%');
            
            //     })
            //     ->with(['added_by', 'form_attribute', 'ward' => function($query){
            //         $query->with(['district' => function($district){
            //                         $district->with('region');
            //                     }]);
            //     }])
            //     ->latest()
            //     ->paginate(10);

            $reports = Form::query()
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
    
                $query->where(function ($query) {

                    if ($this->submission_status == 'submitted') {
                
                        $query->where('status', 1);
                
                    } elseif ($this->submission_status == 'not_submitted') {
                
                        $query->where('status', 0);
                
                    } elseif ($this->submission_status == 'all') {
                
                        $query->whereIn('status', [0, 1]);
                
                    } else {
                
                        $query->where('status', [0, 1]);
                
                    }
                
                });

                // $query->where('status', $this->submission_status == 'submitted' ? 1 : ($this->submission_status == 'not_submitted' ? 0 : ($this->submission_status == 'all' ? [0, 1] : 0)))
                // $query->where('status', $this->submission_status == 'submitted' ? 1 : ($this->submission_status == 'not_submitted' ? 0 : [0, 1]));
        
            })
            ->when($this->date, function ($query) {

                $query->whereBetween('created_at', ['2022-01-07', $this->date]);
        
            })
            ->with(['added_by', 'form_attribute', 'ward' => function($query){
                $query->with(['district' => function($district){
                                $district->with('region');
                            }]);
            }])
            ->latest()
            ->paginate(10);
            
        } else {
           
            // $reports = Form::query()
            //     ->when($this->keywords, function ($query) {
            //         return $query->where(function ($query) {
            //             $query->where('scanning_name', 'like', '%' . $this->keywords . '%')
            //                 ->orWhere('created_at', 'like', '%'.$this->date.'%')
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

            //         $query->where('created_at', 'like', '%'.$this->date.'%');
            
            //     })
            //     ->with(['added_by', 'form_attribute', 'ward' => function($query){
            //         $query->with(['district' => function($district){
            //                         $district->with('region');
            //                     }]);
            //     }])
            //     ->where('created_by', Auth::user()->id)
            //     ->latest()
            //     ->paginate(10);
            
            $reports = Form::query()
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
                ->paginate(10);
        
        }
        
        return view('livewire.admin-panel.report-list', ['reports' => $reports]);
    }
}