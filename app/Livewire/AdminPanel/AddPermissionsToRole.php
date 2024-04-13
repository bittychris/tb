<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Notifications\UserActionNotification;

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

    // public function selectAllPermissionGroup() {

    //     foreach($this->permissions as $permission) {
    //         array_push($this->selectedPermissionIds, $permission->id);

    //     }

    //     $this->allPermissions = false;
        
    //     return $this->selectedPermissionIds;
        
    // }

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
            $this->dispatch('message_alert', 'No Permission selected.');
            
            // session()->flash('warning', 'No Permission selected');

            return;

        } else {

            if ($this->editMode == false){

                $data = array();

                foreach($this->selectedPermissionIds as $permission_id) {

                    $checkRolePermissionExists = DB::table('role_has_permissions')->where('role_id', $validatedData['role_id'])->where('permission_id', $permission_id)->exists();

                    if ($checkRolePermissionExists) {
                        $this->dispatch('message_alert', 'The Role with the permission(s) already exists.');

                        // session()->flash('already_exist', 'The Role with the permission(s) already exists.');

                    } else {

                        $data['role_id'] = $validatedData['role_id'];
                        $data['permission_id'] = $permission_id;

                        DB::table('role_has_permissions')->insert($data);
                        // $rolePermissions = DB::table('role_has_permissions')->insert($data);

                        // if($rolePermissions) {
                        //     $role = Role::find($this->role_id);
                        //     $permission = Permission::find($permission_id);
                        //     $users = User::all();

                        //     foreach($users as $user) {
                        //         if($user->role->name == $role->name) {
                        //             DB::table('model_has_permissions')->insert([
                        //                 'permission_id' => $permission->id,
                        //                 'model_id' => $user->id,
                        //                 'model_type' => 'App\Models\User'
                        //             ]);

                        //         }
                        //     }
                            
                        // }

                    }
                }

                $data = [];

                $this->clearForm();

                $acting_user = User::find(auth()->user()->id);
                $acting_user->notify(new UserActionNotification(auth()->user(), 'Assigned permissions to a role', 'Admin'));
                
                // redirect(route('admin.permissions.roles'));

                $this->dispatch('perm_success_alert', 'Permissions of the Role saved successfully');

                // session()->flash('success', 'Permissions of the Role saved successfully');

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
                            $users = User::where('role_id', $this->role_id)->get();
                            $permissions = DB::table('role_has_permissions')->where('role_id', $this->role_id)->get();

                            foreach($users as $user) {
                                    
                                $role_permissions_del = DB::table('model_has_permissions')
                                                                ->where('model_id', $user->id)
                                                                ->delete();
                                                                
                                if ($role_permissions_del) {
                                    foreach($permissions as $permission) {
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
                   
                    $acting_user = User::find(auth()->user()->id);
                    $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated permissions of a role', 'Admin'));
                        
                    redirect(route('admin.permissions.roles'));

                    $this->dispatch('perm_success_alert', 'Permissions of the Role updated successfully');

                    // session()->flash('success', 'Permissions of the Role updated successfully');

                } else {
                    $this->dispatch('failure_alert', 'An error occurred. Try again later.');

                    // session()->flash('error', 'An error occurred. Try again later.');

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

        $permissionGroups = Permission::select('group_name')->distinct()->get();

        $this->permissions = Permission::all();

        return view('livewire.admin-panel.add-permissions-to-role', [
            'permissions' => $this->permissions,
            'permissionGroups' => $permissionGroups,
            'roles' => $roles
        ]);
    }
    
}