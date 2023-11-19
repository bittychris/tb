<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use App\Models\AgeGroup;
use App\Models\Attribute;
use App\Models\FormAttribute;

class AddFormAttribute extends Component
{
    public $fromAttribute, $name;
    
    public $age_group_ids = [0];

    public $attribute_ids = [0];

    public $editMode = false;

    protected function rules() {

        return [
            'name' => ['required', 'string']
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveFormAttribute() {

        $validatedData = $this->validate();

        $checkAttributeExists = FormAttribute::where('name', $validatedData['name'])->exists();

        if ($checkAttributeExists) {
            session()->flash('already_exist', 'The From Attributes already exists.');

        } else {
        
            array_splice($this->age_group_ids, 0, 1);

            array_splice($this->attribute_ids, 0, 1);

            if (empty($this->age_group_ids)) {
                session()->flash('warning', 'No Age Group selected');

            } elseif (empty($this->attribute_ids)) {
                session()->flash('warning', 'No Attribute selected');
            
            } elseif (!empty($this->attribute_ids) && !empty($this->attribute_ids)) {

                $age_group_ids = json_encode($this->age_group_ids);

                $attribute_ids = json_encode($this->attribute_ids);

                $form_attribute = FormAttribute::create([
                    'name' => $validatedData['name'],
                    'age_group_ids' => $age_group_ids,
                    'attribute_ids' => $attribute_ids
                ]);
    
                if ($form_attribute) {
                    $this->clearForm();
                    session()->flash('success', 'From attribute saved successfully');
    
                } else {
                    session()->flash('error', 'An error occurred. Try again later.');
                }

            }
            
        }

    }

    public function clearForm() {
        $this->editMode = false;

        $this->reset(
            'name'
        );

        $this->age_group_ids = [0];
        $this->attribute_ids = [0];

    }

    public function render()
    {
        $ageGroups = AgeGroup::all();

        $attributes = Attribute::all();

        return view('livewire.admin-panel.add-form-attribute', 
        [
            'ageGroups' => $ageGroups, 
            'attributes' => $attributes
        ]);
    }
}
