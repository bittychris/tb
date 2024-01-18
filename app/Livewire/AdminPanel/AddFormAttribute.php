<?php

namespace App\Livewire\AdminPanel;

use App\Models\User; 
use Livewire\Component;
use App\Models\AgeGroup;
use App\Models\Attribute;
use App\Models\FormAttribute;
use App\Notifications\UserActionNotification;

class AddFormAttribute extends Component
{
    public $fromAttribute, $name;

    public $editMode = false;
    
    public $form_id;

    public $selectedAgeGroupIds = [];
    public $selectedAttributeIds = [];

    protected function rules()
    {

        return [
            'name' => ['required', 'string']
        ];

    }

    public function mount($form_id = null)
    {
        $this->form_id = $form_id ;


        if ($form_id){
            $this->editMode = true;
            $form_attribute = FormAttribute::find($form_id);

            $this->name = $form_attribute->name;
            $this->selectedAgeGroupIds = json_decode($form_attribute->age_group_ids);
            $this->selectedAttributeIds = json_decode($form_attribute->attribute_ids);
        }else{
            $this->editMode = false;
        }
    }

    public function saveFormAttribute()
    {
        $validatedData = $this->validate();

        $checkAttributeExists = FormAttribute::where('name', $validatedData['name'])->exists();

        if ($checkAttributeExists && !$this->editMode) {
            $this->dispatch('message_alert', 'The From Attributes already exists.');
            
            // session()->flash('already_exist', 'The From Attributes already exists.');

        } else {

            if (count($this->selectedAgeGroupIds) == 0) {
                $this->dispatch('message_alert', 'No Age Group selected.');

                // session()->flash('warning', 'No Age Group selected');
                
                return;
            } elseif (count($this->selectedAttributeIds) == 0) {
                $this->dispatch('message_alert', 'No Attribute selected.');

                // session()->flash('warning', 'No Attribute selected');
                return;
            } else {

                $age_group_ids = json_encode($this->selectedAgeGroupIds);

                $attribute_ids = json_encode($this->selectedAttributeIds);

                if ($this->editMode){
                    FormAttribute::where('id', $this->form_id)->update([
                        'name' => $this->name,
                        'age_group_ids' => $age_group_ids,
                        'attribute_ids' => $attribute_ids
                    ]);

                    $acting_user = User::find(auth()->user()->id);
                    $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated Form Attribute details', 'admin'));

                    $this->dispatch('success_alert', 'From attribute updated successfully');

                    // session()->flash('success', 'From attribute updated successfully');
                    return redirect(route('admin.form_attributes'));

                } else{
                    $form_attribute = FormAttribute::create([
                        'name' => $this->name,
                        'age_group_ids' => $age_group_ids,
                        'attribute_ids' => $attribute_ids
                    ]);

                    $acting_user = User::find(auth()->user()->id);
                    $acting_user->notify(new UserActionNotification(auth()->user(), 'Added new Form attribute', ''));
                    
                    $this->dispatch('success_alert', 'From attribute saved successfully');

                    // session()->flash('success', 'From attribute saved successfully');
                    return redirect(route('admin.form_attributes'));
                    // return redirect(route('admin.edit_form_attributes', ['form_id' => $form_attribute->id]));
                }

            }

        }

    }

    public function clearForm()
    {
        $this->editMode = false;

    }

    public function render()
    {
        $ageGroups = AgeGroup::orderBy('created_at','asc')->get();

        $attributes = Attribute::orderBy('created_at','asc')->get();

        return view('livewire.admin-panel.add-form-attribute',
            [
                'ageGroups' => $ageGroups,
                'attributes' => $attributes
            ]);
    }
}