<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class AdminList extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $admin_id, $status, $btn_display;

    public function mount($admins_status) {
        $this->status = $admins_status;

    }

    public function prepareDeleteAdmin($admin_id) {
        $this->admin_id = $admin_id;
        $this->dispatch('openDeleteModal');

    }

    public function DeleteAdmin() {

        if ($this->status == true) {
            $admin = User::where('id', $this->admin_id)->update([
                'status' => false
            ]);
    
            if ($admin) {
                $this->clearForm();
                $this->dispatch('closeForm');
                session()->flash('warning', 'Admin details deleted successfully');
    
            } else {
                $this->dispatch('closeForm');
                session()->flash('error', 'An error occurred. Try again later.');
            }

        } else {
            $admin = User::where('id', $this->admin_id)->update([
                'status' => true
            ]);
    
            if ($admin) {
                $this->clearForm();
                $this->dispatch('closeForm');
                session()->flash('success', 'Admin details restored successfully');
    
            } else {
                $this->dispatch('closeForm');
                session()->flash('error', 'An error occurred. Try again later.');
            }

        }

    }

    public function clearForm() {
        $this->admin_id = '';
    }

    public function render()
    {
        $role  = Role::where('name', 'Admin')->get();

        if ($this->status == false) {
            $this->btn_display = 'none';
            $admins = User::where('status', $this->status)->where('role_id', $role->id)->latest()->paginate(10);

        } else {
            $this->btn_display = '';
            $admins = User::where('status', $this->status)->where('role_id', $role->id)->latest()->paginate(10);

        }
        
        return view('livewire.admin-panel.admin-list', [
            'admins' => $admins
        ]);
    }
}
