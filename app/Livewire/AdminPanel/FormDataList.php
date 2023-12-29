<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use App\Models\FormData;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class FormDataList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $from_data = FormData::latest()->paginate(10);

        return view('livewire.admin-panel.form-data-list', ['from_data' => $from_data]);
    }
}