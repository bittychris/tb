<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use App\Models\District;
use Livewire\WithPagination;
use App\Notifications\UserActionNotification;

class DistrictsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $action, $district_id, $district, $district_name, $region_id, $keywords;

    public $editMode = false;
    
    protected function rules() {

        return [
            'district_name' => ['required', 'string'],
            'region_id' => ['required', 'integer'],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveDistrict() {
        $validatedData = $this->validate();

        $checkDistrictExists = District::where('name', $validatedData['district_name'])->where('region_id', $validatedData['region_id'])->exists();

        if ($checkDistrictExists) {
            $this->dispatch('message_alert', 'The District already added in that Region.');

        } else {
        
            $district = District::create([
                'name' => $validatedData['district_name'],
                'region_id' => $validatedData['region_id'],
            ]);

            if ($district) {
                $this->clearForm();

                $acting_user = User::find(auth()->user()->id);
                $acting_user->notify(new UserActionNotification(auth()->user(), 'added new District', 'Admin'));
            
                $this->dispatch('closeForm');
                $this->dispatch('success_alert', 'District saved successfully');

            } else {
                $this->dispatch('closeForm');
                $this->dispatch('failure_alert', 'An error occurred. Try again later.');

            }

        }

    }

    public function prepareData($district_id, $action) {

        $this->district_id = $district_id;
        $this->action = $action;

        if($this->action == 'edit') {
            $this->editMode = true;

            $this->dispatch('openForm');

            $district = District::findOrFail($district_id);

            $this->district_name = $district->name;
            $this->region_id = $district->region_id;

        } elseif($this->action == 'delete') {
            $this->dispatch('openDeleteModal');

        }  

    }

    public function updateDistrict() {

        $validatedData = $this->validate();
        
        $district = District::where('id', $this->district_id)->update([
            'name' => $validatedData['district_name'],
            'region_id' => $validatedData['region_id'],
        ]);

        if ($district) {
            $this->clearForm();

            $acting_user = User::find(auth()->user()->id);
            $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated District details', 'Admin'));
        
            $this->dispatch('closeForm');
            $this->dispatch('success_alert', 'District updated successfully');


        } else {
            $this->dispatch('closeForm');
            $this->dispatch('failure_alert', 'An error occurred. Try again later.');

        }

    }

    public function DeleteDistrict() {

        $district = District::where('id', $this->district_id)->delete();

        if ($district) {
            $this->clearForm();
            
            $acting_user = User::find(auth()->user()->id);
            $acting_user->notify(new UserActionNotification(auth()->user(), 'Deleted District', 'Admin'));
        
            $this->dispatch('closeForm');
            $this->dispatch('success_alert', 'District deleted successfully');

        } else {
            $this->dispatch('closeForm');
            $this->dispatch('failure_alert', 'An error occurred. Try again later.');

        }
        
    }

    public function clearForm() {
        $this->editMode = false;

        $this->district_id = '';

        $this->reset(
            'district_name',
            'region_id',
        );
    }

    public function render()
    {
        $districts = District::when($this->keywords, function ($query) {
            $query->where(function ($query) {
                $query->where('name', 'like', '%'.$this->keywords.'%')
                    ->orWhereHas('region', function ($query) {
                        $query->where('name', 'like', '%'.$this->keywords.'%');
                    });
            });
        })->orderBy('name', 'asc')->paginate(10);
        
        $regions = Region::orderBy('name', 'asc')->get();

        return view('livewire.admin-panel.districts-list', [
            'districts' => $districts,
            'regions' => $regions,
        ]);
    }
}