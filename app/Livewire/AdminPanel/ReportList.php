<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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
            // ->where('created_by', Auth::user()->id)
            ->latest()
            ->paginate(15);

        return view('livewire.admin-panel.report-list', ['reports' => $reports]);
    }
}