<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;

class AddStaff extends Component
{
    public $editMode = false;
    
    public function render()
    {
        return view('livewire.admin-panel.add-staff');
    }
}
