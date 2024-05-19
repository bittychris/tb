<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use App\Models\District;
use App\Models\Ward;
use Livewire\WithPagination;
use App\Notifications\UserActionNotification;

class WardsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $action, $ward_id, $ward, $ward_name, $districts, $district_id, $region_id, $keywords;

    public $editMode = false;
    
    protected function rules() {

        return [
            'ward_name' => ['required', 'string'],
            'region_id' => ['required', 'integer'],
            'district_id' => ['required', 'integer'],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveWard() {
        $validatedData = $this->validate();

        $checkWardExists = Ward::where('name', $validatedData['ward_name'])->where('district_id', $validatedData['district_id'])->exists();

        if ($checkWardExists) {
            $this->dispatch('message_alert', 'The Ward already added in that District.');

        } else {
        
            $ward = Ward::create([
                'name' => $validatedData['ward_name'],
                'district_id' => $validatedData['district_id'],
            ]);

            if ($ward) {
                $this->clearForm();

                $acting_user = User::find(auth()->user()->id);
                $acting_user->notify(new UserActionNotification(auth()->user(), 'added new Ward', 'Admin'));
            
                $this->dispatch('closeForm');
                $this->dispatch('success_alert', 'Ward saved successfully');

            } else {
                $this->dispatch('closeForm');
                $this->dispatch('failure_alert', 'An error occurred. Try again later.');

            }

        }

    }

    public function prepareData($ward_id, $action) {

        $this->ward_id = $ward_id;
        $this->action = $action;

        if($this->action == 'edit') {
            $this->editMode = true;

            $this->dispatch('openForm');

            $ward = Ward::findOrFail($ward_id);

            $this->ward_name = $ward->name;
            $this->district_id = $ward->district_id;
            $this->region_id = $ward->district->region->id;

        } elseif($this->action == 'delete') {
            $this->dispatch('openDeleteModal');

        }  

    }

    public function updateWard() {

        $validatedData = $this->validate();
        
        $district = Ward::where('id', $this->ward_id)->update([
            'name' => $validatedData['ward_name'],
            'district_id' => $validatedData['district_id'],
        ]);

        if ($district) {
            $this->clearForm();

            $acting_user = User::find(auth()->user()->id);
            $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated Ward details', 'Admin'));
        
            $this->dispatch('closeForm');
            $this->dispatch('success_alert', 'Ward updated successfully');


        } else {
            $this->dispatch('closeForm');
            $this->dispatch('failure_alert', 'An error occurred. Try again later.');

        }

    }

    public function DeleteWard() {

        $ward = Ward::where('id', $this->ward_id)->delete();

        if ($ward) {
            $this->clearForm();
            
            $acting_user = User::find(auth()->user()->id);
            $acting_user->notify(new UserActionNotification(auth()->user(), 'Deleted Ward', 'Admin'));
        
            $this->dispatch('closeForm');
            $this->dispatch('success_alert', 'Ward deleted successfully');

        } else {
            $this->dispatch('closeForm');
            $this->dispatch('failure_alert', 'An error occurred. Try again later.');

        }
        
    }

    public function clearForm() {
        $this->editMode = false;

        $this->ward_id = '';

        $this->reset(
            'ward_name',
            'region_id',
            'district_id',
        );
    }

    public function render()
    {
        $wards = Ward::when($this->keywords, function ($query) {
            $query->where(function ($query) {
                $query->where('name', 'like', '%'.$this->keywords.'%')
                    ->orWhereHas('district', function ($query) {
                        $query->where('name', 'like', '%'.$this->keywords.'%');
                    })
                    ->orWhereHas('district.region', function ($query) {
                        $query->where('name', 'like', '%'.$this->keywords.'%');
                    });
            });
        })->orderBy('name', 'asc')->paginate(10);
        
        $regions = Region::orderBy('name', 'asc')->get();
        
        $this->districts = District::when($this->region_id, function ($query) {
                    $query->where('region_id', $this->region_id);
                })->orderBy('name', 'asc')->get();

        if($this->editMode == true) {
            $this->districts = District::orderBy('name', 'asc')->get();
            
        } 
        
        return view('livewire.admin-panel.wards-list', [
            'wards' => $wards,
            'districts' => $this->districts,
            'regions' => $regions,
        ]);
    }
}