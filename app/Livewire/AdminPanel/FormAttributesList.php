<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use App\Models\FormAttribute;
use Livewire\WithPagination;

class FormAttributesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $form_attributes = FormAttribute::latest()->paginate(10);

        return view('livewire.admin-panel.form-attributes-list', ['form_attributes' => $form_attributes]);
    }
}
