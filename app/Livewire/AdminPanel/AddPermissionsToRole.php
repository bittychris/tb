<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddPermissionsToRole extends Component
{
    public $selectedAllPermissionIds, $permissions, $role_id;
    
    public $all_permissions = [];

    public $selectedPermissionIds = [];

    public $allPermissions = true;

    public $editMode = false;

    public function mount($role_id = null)
    {
        $this->role_id = $role_id ;

        $this->selectedPermissionIds = [];

        if ($role_id){
            $this->editMode = true;
            $permission_ids = DB::table('role_has_permissions')
                            ->select('*')
                            ->where('role_id', $this->role_id)
                            ->get();

            foreach($permission_ids as $permission) {
                array_push($this->selectedPermissionIds, $permission->permission_id);
    
            }

            return $this->selectedPermissionIds;

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
            'role_id' => ['required', 'string'],
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

            if ($this->editMode == false){

                $data = array();

                foreach($this->selectedPermissionIds as $permission_id) {

                    $checkRolePermissionExists = DB::table('role_has_permissions')->where('role_id', $validatedData['role_id'])->where('permission_id', $permission_id)->exists();

                    if ($checkRolePermissionExists) {
                        session()->flash('already_exist', 'The Role with the permission(s) already exists.');

                    } else {

                        $data['role_id'] = $validatedData['role_id'];
                        $data['permission_id'] = $permission_id;

                        $rolePermissions = DB::table('role_has_permissions')->insert($data);

                        if($rolePermissions) {
                            $role = Role::find($this->role_id);
                            $permission = Permission::find($permission_id);
                            $users = User::all();

                            foreach($users as $user) {
                                if($user->role->name == $role->name) {
                                    // $user->hasPermissionTo($permission->name);
                                    DB::table('model_has_permissions')->insert([
                                        'permission_id' => $permission->id,
                                        'model_id' => $user->id,
                                        'model_type' => 'App\Models\User'
                                    ]);

                                }
                            }
                            
                        }

                    }
                }

                $data = [];

                $this->clearForm();

                redirect(route('admin.permissions.roles'));

                session()->flash('success', 'Permissions of the Role saves successfully');

            } else {

                $role_permission_del = DB::table('role_has_permissions')
                                        ->where('role_id', $this->role_id)
                                        ->delete();
                
                if($role_permission_del) {

                    $data = array();

                    foreach($this->selectedPermissionIds as $permission_id) {
                        $data['role_id'] = $validatedData['role_id'];
                        $data['permission_id'] = $permission_id;
    
                        $rolePermissions = DB::table('role_has_permissions')->insert($data);

                        if($rolePermissions) {
                            $role = Role::find($this->role_id);
                            $permission = Permission::find($permission_id);
                            $users = User::all();

                            foreach($users as $user) {
                                if($user->role->name == $role->name) {
                                    $role_permissions_del = DB::table('model_has_permissions')
                                                            ->where('model_id', $user->id)
                                                            ->delete();

                                    if ($role_permissions_del) {
                                        // $user->hasPermissionTo($permission->name);
                                        DB::table('model_has_permissions')->insert([
                                            'permission_id' => $permission->id,
                                            'model_id' => $user->id,
                                            'model_type' => 'App\Models\User'
                                        ]);

                                    }
                                    
                                }
                            }
                            
                        }
    
                    }
    
                    $data = [];
                    
                    $this->clearForm();
                   
                    redirect(route('admin.permissions.roles'));

                    session()->flash('success', 'Permissions of the Role updated successfully');

                } else {
                    session()->flash('error', 'An error occurred. Try again later.');

                }
                
            }

        }

    }

    public function clearForm()
    {
        $this->all_permissions = [];

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
