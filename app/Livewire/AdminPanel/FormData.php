<?php

namespace App\Livewire\AdminPanel;

use App\Models\FormData as ModelsFormData;
use Livewire\Component;

class FormData extends Component
{
    public $form, $form_id, $age_group_id, $attribute_id, $male, $female;

    public function mount($form) {
        $this->form = $form;
        $this->form_id = $form->id;

    }

    protected function rules() {

        return [
            'age_group_id' => ['required', 'string'],
            'attribute_id' => ['required', 'string'],
            'male' => ['required', 'integer'],
            'female' => ['required', 'integer']
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveData() {
        $validatedData = $this->validate();
        
        $form_data = FormData::create([
            'form_id' => $this->form_id,
            'age_group_id' => $validatedData['age_group_id'],
            'attribute_id' => $validatedData['attribute_id'],
            'male' => $validatedData['male'],
            'female' => $validatedData['female']
        ]);

        if ($form_data) {
            $this->clearForm();
            session()->flash('success', $this->form->scanning_name .'data saved successfully');

        } else {
            session()->flash('error', 'An error occurred. Try again later.');
        }
    }

    public function render()
    {
        return view('livewire.admin-panel.form-data');
    }
}
