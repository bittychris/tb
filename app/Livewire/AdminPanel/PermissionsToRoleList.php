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

    public $permission_id;

    public $listen = 'closeFrom';

    public function prepareDeleteRolesInPermission($permission_id) {

        $this->permission_id = $permission_id;

    }

    public function DeleteRolesInPermission() {

        // $permission = Permission::where('id', $this->permission_id)->delete();

        // if ($permission) {
        //     $this->clearForm();
        //     session()->flash('warning', 'Permission deleted successfully');

        // } else {
        //     session()->flash('error', 'An error occurred. Try again later.');
        // }
        
    }
    
    public function clearForm() {
        $this->permission_id = '';

    }

    public function render()
    {
        
        $PermissionsRoles = DB::table('roles')
                            ->select('*')
                            ->paginate(10);

        return view('livewire.admin-panel.permissions-to-role-list', [
            'PermissionsRoles' => $PermissionsRoles
        ]);
    }
}
