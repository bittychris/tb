<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminList extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $admin_id;

    public function prepareDeleteAdmin($admin_id) {
        $this->admin_id = $admin_id;
    }

    public function DeleteAdmin() {

        $admin = User::where('id', $this->admin_id)->update([
            'status' => false
        ]);

        if ($admin) {
            $this->clearForm();
            redirect(route('admin.admins'));
            session()->flash('danger', 'Admin details deleted successfully');

        } else {
            session()->flash('error', 'An error occurred. Try again later.');
        }

    }

    public function clearForm() {
        $this->admin_id = '';
    }

    public function render()
    {
        $admins = User::where('status', true)->where('role_id', 1)->latest()->paginate(10);
        
        return view('livewire.admin-panel.admin-list', [
            'admins' => $admins
        ]);
    }
}
