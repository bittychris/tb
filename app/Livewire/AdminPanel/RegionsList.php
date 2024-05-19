<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;
use App\Notifications\UserActionNotification;

class RegionsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $action, $region_id, $region, $region_name, $keywords;

    public $editMode = false;
    
    protected function rules() {

        return [
            'region_name' => ['required', 'string'],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveRegion() {
        $validatedData = $this->validate();

        $checkRegionExists = Region::where('name', $validatedData['region_name'])->exists();

        if ($checkRegionExists) {
            $this->dispatch('message_alert', 'The Region already exists.');

        } else {
        
            $region = Region::create([
                'name' => $validatedData['region_name'],
            ]);

            if ($region) {
                $this->clearForm();

                $acting_user = User::find(auth()->user()->id);
                $acting_user->notify(new UserActionNotification(auth()->user(), 'added new Region', 'Admin'));
            
                $this->dispatch('closeForm');
                $this->dispatch('success_alert', 'Region saved successfully');

            } else {
                $this->dispatch('closeForm');
                $this->dispatch('failure_alert', 'An error occurred. Try again later.');

            }

        }

    }

    public function prepareData($region_id, $action) {

        $this->region_id = $region_id;
        $this->action = $action;

        if($this->action == 'edit') {
            $this->editMode = true;

            $this->dispatch('openForm');

            $region = Region::findOrFail($region_id);

            $this->region_name = $region->name;

        } elseif($this->action == 'delete') {
            $this->dispatch('openDeleteModal');

        }  

    }

    public function updateRegion() {

        $validatedData = $this->validate();
        
        $region = Region::where('id', $this->region_id)->update([
                'name' => $validatedData['region_name'],
        ]);

        if ($region) {
            $this->clearForm();

            $acting_user = User::find(auth()->user()->id);
            $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated Region details', 'Admin'));
        
            $this->dispatch('closeForm');
            $this->dispatch('success_alert', 'Region updated successfully');


        } else {
            $this->dispatch('closeForm');
            $this->dispatch('failure_alert', 'An error occurred. Try again later.');

        }

    }

    public function DeleteRegion() {

        $region = Region::where('id', $this->region_id)->delete();

        if ($region) {
            $this->clearForm();
            
            $acting_user = User::find(auth()->user()->id);
            $acting_user->notify(new UserActionNotification(auth()->user(), 'Deleted Region', 'Admin'));
        
            $this->dispatch('closeForm');
            $this->dispatch('success_alert', 'Region deleted successfully');

        } else {
            $this->dispatch('closeForm');
            $this->dispatch('failure_alert', 'An error occurred. Try again later.');

        }
        
    }

    public function clearForm() {
        $this->editMode = false;

        $this->region_id = '';

        $this->reset(
            'region_name',
        );
    }

    public function render()
    {
        $regions = Region::when($this->keywords, function ($query) {

            $query->where('name', 'like', '%'.$this->keywords.'%');         
                
            })->orderBy('name', 'asc')->paginate(10);

        return view('livewire.admin-panel.regions-list', ['regions' => $regions]);
    }
}