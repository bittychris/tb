<?php

namespace App\Livewire\AdminPanel;

use App\Models\Attribute;
use App\Models\Form;
use App\Models\User;
use Livewire\Component;
use App\Models\comments;
use Livewire\WithPagination;
use App\Models\FormAttribute;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserActionNotification;

class ReportList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $form_id, $report_name, $submit_status, $keywords, $startDate, $endDate;

    public $submission_status = 'all';

    public $rc, $rc_image, $sender_id, $receiver_id, $content, $unread_comment_count;

    public $unavailable_data_attr = [];

    public $unavailable_attributes_data = [];

    public $comments = [];

    public function getFormData($report_id) {
        $this->form_id = $report_id;
        $report = Form::find($this->form_id);
        $this->report_name = $report->form_attribute->name;

        $this->dispatch('openSubmitDataModel');

    }

    public function submitData() {

        $special_attributes = Attribute::where('attribute_no', 1)->orWhere('attribute_no', 10)->get();

        foreach($special_attributes as $attribute) {
            if($attribute->attribute_no == 1) {
                $first_attr_id = $attribute->id;
            }

            if($attribute->attribute_no == 10) {
                $tenth_attr_id = $attribute->id;
            }
        }

        $form = Form::find($this->form_id);
        $form_attribute = FormAttribute::find($form->form_attribute_id);
        $form_data = DB::table('form_data')
                        ->where('form_id', $this->form_id)
                        ->get();

        // $form_attribute_age_group_ids = json_decode($form_attribute->age_group_ids, true);
        $form_attribute_attribute_ids = json_decode($form_attribute->attribute_ids, true);

        foreach($form_data as $available_data) {

            foreach($form_attribute_attribute_ids as $attribute_id) {


                $form_data = DB::table('form_data')
                        ->where('form_id', $this->form_id)
                        ->where('attribute_id', $attribute_id)
                        ->get();

                if(count($form_data) == 0) {
                    array_push($this->unavailable_attributes_data, $attribute_id);

                } else {
                    $form_data = DB::table('form_data')
                        ->where('form_id', $this->form_id)
                        ->where('attribute_id', $attribute_id)
                        ->where(function ($query) {

                            $query->where('male', null)
                                    ->orWhere('female', null);

                        })
                        ->get();

                    if(count($form_data) != 0) {
                        array_push($this->unavailable_data_attr, $attribute_id);

                    }

                }

            }
        }

        if(count(array_unique($this->unavailable_attributes_data)) != 0) {
            $this->dispatch('closeModel');
            $this->dispatch('failure_alert', 'Can\'t submit the form, some fields of the form are empty');

            $this->unavailable_attributes_data = [];


        } elseif(count(array_unique($this->unavailable_data_attr)) != 0) {
            $this->dispatch('closeModel');
            $this->dispatch('failure_alert', 'Can\'t submit the form, some fields of the form are empty');

            $this->unavailable_data_attr = [];

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

    public function mount($form = null){
        $this->endDate = now()->toDateTimeString();
        $this->startDate = '2022-12-07 10:20:34';
       if(!empty($form)) {
            $this->form_id = $form;

            $this->getReportDetails($this->form_id);
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

            return redirect(route('admin.report'));

        }

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

        if((auth()->user()->role->name == 'Admin') || (auth()->user()->role->name == 'AMREF personnel')) {

            $reports = Form::query()
            ->when($this->keywords, function ($query) {
                return $query->where(function ($query) {
                    $query->where('scanning_name', 'like', '%' . $this->keywords . '%')
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

            })
            ->when($this->startDate && $this->endDate, function ($query) {

                $query->whereBetween('created_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()]);

            })
            ->with(['added_by', 'form_attribute', 'ward' => function($query){
                $query->with(['district' => function($district){
                                $district->with('region');
                            }]);
            }])
            ->latest()
            ->paginate(10);

        } else {

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

                })
                ->when($this->startDate && $this->endDate, function ($query) {

                    $query->whereBetween('created_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()]);

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