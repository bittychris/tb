<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $permission_id, $permission, $permission_name, $group_name;

    public $listen = 'closeFrom';

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
            session()->flash('already_exist', 'The Permission already exists.');

        } else {
        
            $permission = Permission::create([
                'name' => $validatedData['permission_name'],
                'group_name' => $validatedData['group_name']
            ]);

            if ($permission) {
                $this->clearForm();
                session()->flash('success', 'Permission saved successfully');

            } else {
                session()->flash('error', 'An error occurred. Try again later.');
            }

        }

    }

    public function prepareEditPermission($permission_id) {

        $this->editMode = true;

        $permission = Permission::findOrFail($permission_id);

        $this->permission_id = $permission->id;
        $this->permission_name = $permission->name;
        $this->group_name = $permission->group_name;

    }

    public function updatePermission() {

        $validatedData = $this->validate();
        
        $permission = Permission::where('id', $this->permission_id)->update([
                'name' => $validatedData['permission_name'],
                'group_name' => $validatedData['group_name']

        ]);

        if ($permission) {
            $this->clearForm();
            session()->flash('success', 'Permission updated successfully');

        } else {
            session()->flash('error', 'An error occurred. Try again later.');
        }

    }

    public function prepareDeletePermission($permission_id) {

        $this->permission_id = $permission_id;

    }

    public function DeletePermission() {

        $permission = Permission::where('id', $this->permission_id)->delete();

        if ($permission) {
            $this->clearForm();
            session()->flash('warning', 'Permission deleted successfully');

        } else {
            session()->flash('error', 'An error occurred. Try again later.');
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
