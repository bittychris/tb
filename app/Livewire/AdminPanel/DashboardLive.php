<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use Livewire\Component;

class DashboardLive extends Component
{
    public $keywords, $date;

    public function render()
    {
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
            
        return view('livewire.admin-panel.dashboard-live', [
            'submitted_field_reports' => $submitted_field_reports
        ]);
    }
}