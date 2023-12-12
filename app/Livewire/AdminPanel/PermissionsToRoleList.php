<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
            $this->clearForm();
            $this->dispatch('closeForm');
            session()->flash('warning', 'Permissions Assigned to role deleted successfully');

        } else {
            $this->dispatch('closeForm');
            session()->flash('error', 'An error occurred. Try again later.');
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
