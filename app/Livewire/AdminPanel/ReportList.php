<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Notifications\UserActionNotification;

class ReportList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $form_id, $report_name, $submit_status, $keywords, $date, $submition_status;

    // public $submition_status = 'all';

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

        // if(empty($this->submition_status)) {
        //     dd($this->submition_status);
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
            ->when($this->submition_status, function ($query) {
    
                $query->where(function ($query) {

                    if ($this->submition_status == 'submitted') {
                
                        $query->where('status', 1);
                
                    } elseif ($this->submition_status == 'not_submitted') {
                
                        $query->where('status', 0);
                
                    } elseif ($this->submition_status == 'all') {
                
                        $query->whereIn('status', [0, 1]);
                
                    } else {
                
                        $query->where('status', [0, 1]);
                
                    }
                
                });

                // $query->where('status', $this->submition_status == 'submitted' ? 1 : ($this->submition_status == 'not_submitted' ? 0 : ($this->submition_status == 'all' ? [0, 1] : 0)))
                // $query->where('status', $this->submition_status == 'submitted' ? 1 : ($this->submition_status == 'not_submitted' ? 0 : [0, 1]));
        
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
                ->when($this->submition_status, function ($query) {
    
                    $query->where('status', 'like', '%' .$this->submition_status. '%');
            
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