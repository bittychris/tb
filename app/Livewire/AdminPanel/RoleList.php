<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $role_id, $role, $role_name;

    public $editMode = false;
    
    protected function rules() {

        return [
            'role_name' => ['required', 'string']
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveRole() {
        $validatedData = $this->validate();

        $checkRoleExists = Role::where('name', $validatedData['role_name'])->exists();

        if ($checkRoleExists) {
            session()->flash('already_exist', 'The Role already exists.');

        } else {
        
            $role = Role::create([
                'name' => $validatedData['role_name']
            ]);

            if ($role) {
                $this->clearForm();
                session()->flash('success', 'Role saved successfully');

            } else {
                session()->flash('error', 'An error occurred. Try again later.');
            }

        }

    }

    public function prepareEditRole($role_id) {

        $this->editMode = true;

        $role = Role::findOrFail($role_id);

        $this->role_id = $role->id;
        $this->role_name = $role->name;

    }

    public function updateRole() {

        $validatedData = $this->validate();
        
        $role = Role::where('id', $this->role_id)->update([
                'name' => $validatedData['role_name']
        ]);

        if ($role) {
            $this->clearForm();
            session()->flash('success', 'Role updated successfully');

        } else {
            session()->flash('error', 'An error occurred. Try again later.');
        }

    }

    public function prepareDeleteRole($role_id) {

        $this->role_id = $role_id;

    }

    public function DeleteRole() {

        $role = Role::where('id', $this->role_id)->delete();

        if ($role) {
            $this->clearForm();
            session()->flash('warning', 'Role deleted successfully');

        } else {
            session()->flash('error', 'An error occurred. Try again later.');
        }
        
    }

    public function clearForm() {
        $this->editMode = false;

        $this->role_id = '';

        $this->reset(
            'role_name'
        );
    }

    public function render()
    {
        $roles = Role::latest()->paginate(10);

        return view('livewire.admin-panel.role-list', ['roles' => $roles]);
    }
}
