<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use App\Notifications\UserActionNotification;

class PermissionList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $action, $permission_id, $permission, $permission_name, $group_name;

    protected $listeners = [
        'closeForm',
        'openForm'
    ];

    public $editMode = false;
    
    protected function rules() {

        return [
            'permission_name' => ['required', 'string'],
            'group_name' => ['required', 'string']
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function savePermission() {
        $validatedData = $this->validate();

        $checkPermissionExists = Permission::where('name', $validatedData['permission_name'])->exists();

        if ($checkPermissionExists) {
            $this->dispatch('message_alert', 'The Permission already exists.');
            
            // session()->flash('already_exist', 'The Permission already exists.');

        } else {
        
            $permission = Permission::create([
                'name' => $validatedData['permission_name'],
                'group_name' => $validatedData['group_name']
            ]);

            if ($permission) {
                $this->clearForm();

                $acting_user = User::find(auth()->user()->id);
                $$acting_user->notify(new UserActionNotification(auth()->user(), 'Added new permission'));
            
                $this->dispatch('closeForm');
                $this->dispatch('success_alert', 'Permission saved successfully');

                // session()->flash('success', 'Permission saved successfully');

            } else {
                $this->dispatch('closeForm');
                $this->dispatch('failure_alert', 'An error occurred. Try again later.');
                
                // session()->flash('error', 'An error occurred. Try again later.');
            }

        }

    }

    public function prepareData($permission_id, $action) {

        $this->permission_id = $permission_id;
        $this->action = $action;

        if($this->action == 'edit') {
            $this->editMode = true;

            $this->dispatch('openForm');

            $permission = Permission::find($this->permission_id);
            $this->permission_name = $permission->name;
            $this->group_name = $permission->group_name;

        } elseif($this->action == 'delete') {
            $this->dispatch('openDeleteModal');

        }      

    }

    public function updatePermission() {

        $validatedData = $this->validate();
        
        $permission = Permission::where('id', $this->permission_id)->update([
                'name' => $validatedData['permission_name'],
                'group_name' => $validatedData['group_name']

        ]);

        if ($permission) {
            $this->clearForm();

            $acting_user = User::find(auth()->user()->id);
            $$acting_user->notify(new UserActionNotification(auth()->user(), 'Updated permission details'));
                
            $this->dispatch('closeForm');
            $this->dispatch('success_alert', 'Permission updated successfully');

            // session()->flash('success', 'Permission updated successfully');

        } else {
            $this->dispatch('closeForm');
            $this->dispatch('failure_alert', 'An error occurred. Try again later.');

            // session()->flash('error', 'An error occurred. Try again later.');
        }

    }

    public function DeletePermission() {

        $permission = Permission::where('id', $this->permission_id)->delete();

        if ($permission) {
            $this->clearForm();

            $acting_user = User::find(auth()->user()->id);
            $$acting_user->notify(new UserActionNotification(auth()->user(), 'Deleted permission'));
            
            $this->dispatch('closeForm');
            $this->dispatch('message_alert', 'Permission deleted successfully.');

            // session()->flash('warning', 'Permission deleted successfully');

        } else {
            $this->dispatch('closeForm');
            $this->dispatch('failure_alert', 'An error occurred. Try again later.');

            // session()->flash('error', 'An error occurred. Try again later.');
        }
        
    }

    public function clearForm() {
        $this->editMode = false;

        $this->permission_id = '';

        $this->reset(
            'permission_name',
            'group_name'
        );
    }

    public function render()
    {
        $permissions = Permission::latest()->paginate(10);

        return view('livewire.admin-panel.permission-list', ['permissions' => $permissions]);
    }
}