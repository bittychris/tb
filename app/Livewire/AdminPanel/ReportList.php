<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ReportList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $form_id, $report_name, $submit_status;

    public function getFormData($report_id) {
        $this->form_id = $report_id;
        $report = Form::find($this->form_id);
        $this->report_name = $report->form_attribute->name;
        
        $this->dispatch('openSubmitDataModel');

    }
    
    public function submitData() {
        $submit_report = DB::table('form_data')->where('form_id', $this->form_id)->update([
            'status' => true,
        ]);

        if ($submit_report) {
            $this->dispatch('closeModel');
            $this->dispatch('message_alert', 'The Role already exists.');
                        
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
        if((auth()->user()->role->name == 'Admin') && (auth()->user()->role->name == 'AMREF personnel')) {
            $reports = Form::query()
            ->with(['added_by', 'form_attribute', 'ward' => function($query){
                $query->with(['district' => function($district){
                    $district->with('region');
                }]);
            }])
            // ->where('created_by', Auth::user()->id)
            ->latest()
            ->paginate(10);

        } else {

            $reports = Form::query()
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