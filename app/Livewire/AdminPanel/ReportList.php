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

    public $form_id, $report_name, $submit_status, $keywords, $date;

    public function getFormData($report_id) {
        $this->form_id = $report_id;
        $report = Form::find($this->form_id);
        $this->report_name = $report->form_attribute->name;
        
        $this->dispatch('openSubmitDataModel');

    }
    
    public function submitData() {
        $submit_report = DB::table('forms')->where('id', $this->form_id)->where('created_by', auth()->user()->id)->update([
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

    public function clearForm() {
        $this->reset(
            'form_id',
        );
    }
    
    public function render()
    {

        if((auth()->user()->role->name == 'Admin') || (auth()->user()->role->name == 'AMREF personnel')) {

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
                            });
                    });
                })
                ->when($this->date, function ($query) {

                    $query->where('created_at', 'like', '%'.$this->date.'%');
            
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
                            ->orWhere('created_at', 'like', '%'.$this->date.'%')
                            ->orWhereHas('ward', function ($query) {
                                $query->where('name', 'like', '%' . $this->keywords . '%');
                            })
                            ->orWhereHas('added_by', function ($query) {
                                $query->where('first_name', 'like', '%' . $this->keywords . '%')
                                    ->orWhere('last_name', 'like', '%' . $this->keywords . '%');
                            });
                    });
                })
                ->when($this->date, function ($query) {

                    $query->where('created_at', 'like', '%'.$this->date.'%');
            
                })
                ->with(['added_by', 'form_attribute', 'ward' => function($query){
                    $query->with(['district' => function($district){
                                    $district->with('region');
                                }]);
                }])->where('created_by', Auth::user()->id)
                ->latest()
                ->paginate(10);
        
        }
        
        return view('livewire.admin-panel.report-list', ['reports' => $reports]);
    }
}