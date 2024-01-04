<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use App\Models\AgeGroup;
use Livewire\WithPagination;
use App\Notifications\UserActionNotification;

class AgeGroupsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $action, $ageGroup_id, $ageGroup, $age_group_name, $min_age, $max_age;

    public $editMode = false;
    
    protected function rules() {

        return [
            'age_group_name' => ['required', 'string'],
            'min_age' => ['required', 'integer'],
            'max_age' => ['required', 'integer']
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveAgeGroup() {
        $validatedData = $this->validate();

        $checkAgeGroupExists = AgeGroup::where('slug', $validatedData['age_group_name'])->exists();

        if ($checkAgeGroupExists) {
            session()->flash('already_exist', 'The Age group already exists.');

        } else {
        
            $ageGroup = AgeGroup::create([
                'slug' => $validatedData['age_group_name'],
                'min' => $validatedData['min_age'],
                'max' => $validatedData['max_age']
            ]);

            if ($ageGroup) {
                $this->clearForm();

                $acting_user = User::find(auth()->user()->id);
                $$acting_user->notify(new UserActionNotification(auth()->user(), 'added new age group'));
            
                $this->dispatch('closeForm');
                session()->flash('success', 'Age group saved successfully');

            } else {
                $this->dispatch('closeForm');
                session()->flash('error', 'An error occurred. Try again later.');
            }

        }

    }

    public function prepareData($ageGroup_id, $action) {

        $this->ageGroup_id = $ageGroup_id;
        $this->action = $action;

        if($this->action == 'edit') {
            $this->editMode = true;

            $this->dispatch('openForm');

            $ageGroup = AgeGroup::findOrFail($ageGroup_id);

            $this->age_group_name = $ageGroup->slug;
            $this->min_age = $ageGroup->min;
            $this->max_age = $ageGroup->max;

        } elseif($this->action == 'delete') {
            $this->dispatch('openDeleteModal');

        }  

    }

    public function updateAgeGroup() {

        $validatedData = $this->validate();
        
        $ageGroup = AgeGroup::where('id', $this->ageGroup_id)->update([
                'slug' => $validatedData['age_group_name'],
                'min' => $validatedData['min_age'],
                'max' => $validatedData['max_age']
        ]);

        if ($ageGroup) {
            $this->clearForm();

            $acting_user = User::find(auth()->user()->id);
            $$acting_user->notify(new UserActionNotification(auth()->user(), 'Updated age group details'));
        
            $this->dispatch('closeForm');
            session()->flash('success', 'Age group updated successfully');

        } else {
            $this->dispatch('closeForm');
            session()->flash('error', 'An error occurred. Try again later.');
        }

    }

    public function DeleteAgeGroup() {

        $ageGroup = AgeGroup::where('id', $this->ageGroup_id)->delete();

        if ($ageGroup) {
            $this->clearForm();
            
            $acting_user = User::find(auth()->user()->id);
            $$acting_user->notify(new UserActionNotification(auth()->user(), 'Deleted age group'));
        
            $this->dispatch('closeForm');
            // $this->dispatch('success', 'Age group updated successfully');

            session()->flash('warning', 'Age group deleted successfully');

        } else {
            $this->dispatch('closeForm');
            session()->flash('error', 'An error occurred. Try again later.');
        }
        
    }

    public function clearForm() {
        $this->editMode = false;

        $this->ageGroup_id = '';

        $this->reset(
            'age_group_name',
            'min_age',
            'max_age'
        );
    }

    public function render()
    {
        $ageGroups = AgeGroup::latest()->paginate(10);

        return view('livewire.admin-panel.age-groups-list', ['ageGroups' => $ageGroups]);
    }
}