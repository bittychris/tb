<?php

namespace App\Livewire\AdminPanel;

use App\Models\Attribute;
use Livewire\Component;
use Livewire\WithPagination;

class AttributesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $action, $attribute_id, $attribute, $name;

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

    public function saveAttribute() {
        $validatedData = $this->validate();

        $checkAttributeExists = Attribute::where('name', $validatedData['name'])->exists();

        if ($checkAttributeExists) {
            session()->flash('already_exist', 'The Attribute already exists.');

        } else {
        
            $attribute = Attribute::create([
                'name' => $validatedData['name']
            ]);

            if ($attribute) {
                $this->clearForm();
                $this->dispatch('closeForm');
                session()->flash('success', 'Attribute saved successfully');

            } else {
                $this->dispatch('closeForm');
                session()->flash('error', 'An error occurred. Try again later.');
            }

        }

    }

    public function prepareData($attribute_id, $action) {
        
        $this->attribute_id = $attribute_id;
        $this->action = $action;

        
        if($this->action == 'edit') {
            $this->editMode = true;

            $this->dispatch('openForm');

            $attribute = Attribute::findOrFail($attribute_id);

            $this->attribute_id = $attribute->id;
            $this->name = $attribute->name;
        
        } elseif($this->action == 'delete') {
            $this->dispatch('openDeleteModal');

        }  

    }

    public function updateAttribute() {

        $validatedData = $this->validate();
        
        $attribute = Attribute::where('id', $this->attribute_id)->update([
            'name' => $validatedData['name']

        ]);

        if ($attribute) {
            $this->clearForm();
            $this->dispatch('closeForm');
            session()->flash('success', 'Age group updated successfully');

        } else {
            $this->dispatch('closeForm');
            session()->flash('error', 'An error occurred. Try again later.');
        }

    }

    public function DeleteAttribute() {

        $attribute = Attribute::where('id', $this->attribute_id)->delete();

        if ($attribute) {
            $this->clearForm();
            $this->dispatch('closeForm');
            session()->flash('warning', 'Attribute deleted successfully');

        } else {
            $this->dispatch('closeForm');
            session()->flash('error', 'An error occurred. Try again later.');
        }
        
    }

    public function clearForm() {
        $this->editMode = false;

        $this->attribute_id = '';

        $this->reset(
            'name'
        );
    }

    public function render()
    {
        $attributes = Attribute::latest()->paginate(10);

        return view('livewire.admin-panel.attributes-list', ['attributes' => $attributes]);
    }
}
