<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Notifications\UserActionNotification;

class PermissionsToRoleList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $role_id;

    public $listen = 'closeFrom';

    public function prepareDeleteRolesInPermission($role_id) {

        $this->role_id = $role_id;
        $this->dispatch('openDeleteModal');

    }

    public function DeleteRolesInPermission() {

        $permission_ids_del = DB::table('role_has_permissions')
                            ->where('role_id', $this->role_id)
                            ->delete();

        if ($permission_ids_del) {
            $role = Role::find($this->role_id);
            // $permission = Permission::find($permission_id);
            $users = User::where('role_id', $this->role_id )->get();

            foreach($users as $user) {
                DB::table('model_has_permissions')
                                        ->where('model_id', $user->id)
                                        ->delete();
                
            }
        
            $this->clearForm();

            $acting_user = User::find(auth()->user()->id);
            $acting_user->notify(new UserActionNotification(auth()->user(), 'Deleted Permissions Assigned to role', 'admin'));
            
            $this->dispatch('closeForm');
            $this->dispatch('success_alert', 'Permissions Assigned to role deleted successfully');
            // session()->flash('warning', 'Permissions Assigned to role deleted successfully');

        } else {
            $this->dispatch('closeForm');
            $this->dispatch('failure_alert', 'An error occurred. Try again later.');
            
            // session()->flash('error', 'An error occurred. Try again later.');

        }
        
    }
    
    public function clearForm() {
        $this->role_id = '';

    }

    public function render()
    {
        
        $Roles = DB::table('roles')
                            ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
                            ->select('roles.*')
                            ->distinct()
                            ->latest()->paginate(10);

        $RolesPermissions = DB::table('role_has_permissions')
                            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                            ->select('role_has_permissions.*', 'permissions.name as permission_name')
                            ->distinct()
                            ->get();

        return view('livewire.admin-panel.permissions-to-role-list', [
            'Roles' => $Roles,
            'RolesPermissions' => $RolesPermissions
        ]);
    }
}