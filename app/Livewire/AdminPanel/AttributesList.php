<?php

namespace App\Livewire\AdminPanel;

use App\Models\Attribute;
use Livewire\Component;
use Livewire\WithPagination;

class AttributesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $attribute_id, $attribute, $name;

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
                session()->flash('success', 'Attribute saved successfully');

            } else {
                session()->flash('error', 'An error occurred. Try again later.');
            }

        }

    }

    public function prepareEditAttribute($attribute_id) {
        
        $this->editMode = true;

        $attribute = Attribute::findOrFail($attribute_id);

        $this->attribute_id = $attribute->id;
        $this->name = $attribute->name;

    }

    public function updateAttribute() {

        $validatedData = $this->validate();
        
        $attribute = Attribute::where('id', $this->attribute_id)->update([
            'name' => $validatedData['name']

        ]);

        if ($attribute) {
            $this->clearForm();
            // $this->dispatch('success', 'Age group updated successfully');

            session()->flash('success', 'Age group updated successfully');

        } else {
            session()->flash('error', 'An error occurred. Try again later.');
        }

    }

    public function prepareDeleteAttribute($attribute_id) {

        $this->attribute_id = $attribute_id;

    }

    public function DeleteAttribute() {

        $attribute = Attribute::where('id', $this->attribute_id)->delete();

        if ($attribute) {
            $this->clearForm();
            // $this->dispatch('success', 'Age group updated successfully');

            session()->flash('warning', 'Attribute deleted successfully');

        } else {
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
