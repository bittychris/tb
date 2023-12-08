<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddPermissionsToRole extends Component
{
    public $selectedAllPermissionIds, $permissions, $role_id;
    
    public $selectedPermissionIds = [];

    public $allPermissions = true;

    public $editMode = false;

    public function mount($role_id = null)
    {
        $this->role_id = $role_id ;

        if ($role_id){
            $this->editMode = true;
            $permission_ids = DB::table('role_has_permissions')
            ->select('*')
            ->where('permission_id', $this->role_id)
            ->get();

            $this->selectedPermissionIds = $permission_ids;

        }else{
            $this->editMode = false;

        }
    }

    public function selectAllPermissions() {

        foreach($this->permissions as $permission) {
            array_push($this->selectedPermissionIds, $permission->id);

        }

        $this->allPermissions = false;
        
        return $this->selectedPermissionIds;
        
    }

    public function deselectAllPermissions() {

        $this->selectedPermissionIds = [];

        $this->allPermissions = true;

        return $this->selectedPermissionIds;
    }

    protected function rules() {

        return [
            'role_id' => ['required', 'integer'],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function savePermissionsRole()
    {
        $validatedData = $this->validate();

        if (count($this->selectedPermissionIds) == 0) {
            session()->flash('warning', 'No Permission selected');

            return;

        } else {

            if (!$this->editMode){

                $data = array();

                foreach($this->selectedPermissionIds as $permission_id) {

                    $checkRolePermissionExists = DB::table('role_has_permissions')->where('role_id', $validatedData['role_id'])->where('permission_id', $permission_id)->exists();

                    if ($checkRolePermissionExists) {
                        session()->flash('already_exist', 'The Role with the permission(s) already exists.');

                    } else {

                        $data['role_id'] = $validatedData['role_id'];
                        $data['permission_id'] = $permission_id;

                        DB::table('role_has_permissions')->insert($data);

                    }
                }

                $data = [];

                $this->clearForm();

                session()->flash('success', 'Permissions of the Role saves successfully');

            }else{
                $data = array();

                foreach($this->selectedPermissionIds as $permission_id) {
                    $data['role_id'] = $validatedData['role_id'];
                    $data['permission_id'] = $permission_id;

                    DB::table('role_has_permissions')->insert($data);

                }

                $data = [];
                
                $this->clearForm();
               
                session()->flash('success', 'Permissions of the Role updated successfully');
                // return redirect(route('admin.permissions.roles'));
            }

        }

    }

    public function clearForm()
    {
        $this->editMode = false;

        $this->reset(
            'role_id'
        );
        
        $this->deselectAllPermissions();

    }

    public function render()
    {
        $roles = Role::all();

        $this->permissions = Permission::all();

        return view('livewire.admin-panel.add-permissions-to-role', [
            'permissions' => $this->permissions,
            'roles' => $roles
        ]);
    }
}
