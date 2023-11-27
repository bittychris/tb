<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class StaffList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $staffs = User::latest()->paginate(10);

        return view('livewire.admin-panel.staff-list', [
            'staffs' => $staffs
        ]);
    }
}
