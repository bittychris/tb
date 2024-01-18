<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use App\Models\FormAttribute;
use Livewire\WithPagination;

class FormAttributesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $keywords;
    
    // public $formAttribute_id;

    // public function prepareData($formAttribute_id) {
    //     $this->formAttribute_id = $formAttribute_id;
    //     $this->dispatch('openDeleteModal');

    // }

    // public function deleteFormAttribute() {
        
    // }

    // public function clearForm() {
    //     $this->formAttribute_id = '';

    // }

    public function render()
    {
        $form_attributes = FormAttribute::when($this->keywords, function ($query) {

            $query->where('name', 'like', '%'.$this->keywords.'%');
    
        })->latest()->paginate(10);

        return view('livewire.admin-panel.form-attributes-list', ['form_attributes' => $form_attributes]);
    }
}