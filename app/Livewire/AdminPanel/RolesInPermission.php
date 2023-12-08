<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesInPermission extends Component
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

    public function saveRolesInPermission() {
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

    public function prepareEditRolesInPermission($permission_id) {

        $this->editMode = true;

        $permission = Permission::findOrFail($permission_id);

        $this->permission_id = $permission->id;
        $this->permission_name = $permission->name;

    }

    public function updateRolesInPermission() {

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

    public function prepareDeleteRolesInPermission($permission_id) {

        $this->permission_id = $permission_id;

    }

    public function DeleteRolesInPermission() {

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
        $roles = Role::all();

        $permissions = Permission::all();

        $PermissionsRoles = Role::latest()->paginate(10);

        return view('livewire.admin-panel.roles-in-permission', [
            'permissions' => $permissions,
            'roles' => $roles,
            'PermissionsRoles' => $PermissionsRoles
        ]);
    }
}
