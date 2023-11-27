<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use Livewire\Component;

class ReportList extends Component
{
    public function render()
    {
        $reports = Form::query()
            ->with(['added_by', 'form_attribute', 'ward' => function($query){
                $query->with(['district' => function($district){
                    $district->with('region');
                }]);
            }])
            ->latest()
            ->paginate(15);

        return view('livewire.admin-panel.report-list', ['reports' => $reports]);
    }
}
