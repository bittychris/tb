<?php

namespace App\Livewire\AdminPanel;

use App\Models\AgeGroup;
use Livewire\Component;
use Livewire\WithPagination;

class AgeGroupsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $ageGroup_id, $ageGroup, $age_group_name, $min_age, $max_age;

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
                session()->flash('success', 'Age group saved successfully');

            } else {
                session()->flash('error', 'An error occurred. Try again later.');
            }

        }

    }

    public function prepareEditAgeGroup($ageGroup_id) {

        $this->editMode = true;

        $ageGroup = AgeGroup::findOrFail($ageGroup_id);

        $this->ageGroup_id = $ageGroup->id;
        $this->age_group_name = $ageGroup->slug;
        $this->min_age = $ageGroup->min;
        $this->max_age = $ageGroup->max;

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
            // $this->dispatch('success', 'Age group updated successfully');

            session()->flash('success', 'Age group updated successfully');

        } else {
            session()->flash('error', 'An error occurred. Try again later.');
        }

    }

    public function prepareDeleteAgeGroup($ageGroup_id) {

        $this->ageGroup_id = $ageGroup_id;

    }

    public function DeleteAgeGroup() {

        $ageGroup = AgeGroup::where('id', $this->ageGroup_id)->delete();

        if ($ageGroup) {
            $this->clearForm();
            // $this->dispatch('success', 'Age group updated successfully');

            session()->flash('warning', 'Age group deleted successfully');

        } else {
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
