<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use App\Notifications\UserActionNotification;

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

                $acting_user = User::find(auth()->user()->id);
                $$acting_user->notify(new UserActionNotification(auth()->user(), 'Deleted Admin'));
            
                $this->dispatch('closeForm');
                $this->dispatch('success_alert', 'Admin details deleted successfully');

                // session()->flash('warning', 'Admin details deleted successfully');
    
            } else {
                $this->dispatch('closeForm');
                $this->dispatch('failure_alert', 'An error occurred. Try again later.');

                // session()->flash('error', 'An error occurred. Try again later.');
            }

        } else {
            $admin = User::where('id', $this->admin_id)->update([
                'status' => true
            ]);
    
            if ($admin) {
                $this->clearForm();

                $acting_user = User::find(auth()->user()->id);
                $$acting_user->notify(new UserActionNotification(auth()->user(), 'Restored deleted Admin'));
            
                $this->dispatch('closeForm');
                $this->dispatch('success_alert', 'Admin details restored successfully');

                // session()->flash('success', 'Admin details restored successfully');
    
            } else {
                $this->dispatch('closeForm');
                $this->dispatch('failure_alert', 'An error occurred. Try again later.');

                // session()->flash('error', 'An error occurred. Try again later.');
            }

        }

    }

    public function clearForm() {
        $this->admin_id = '';
    }

    public function render()
    {
        $role_id = '';
        $role  = Role::where('name', 'Admin')->get();
        foreach($role as $rl) {
            $role_id = $rl->id;

        }

        if ($this->status == false) {
            $this->btn_display = 'none';
            $admins = User::where('status', $this->status)->where('role_id', $role_id)->latest()->paginate(10);

        } else {
            $this->btn_display = '';
            $admins = User::where('status', $this->status)->where('role_id', $role_id)->latest()->paginate(10);

        }
        
        return view('livewire.admin-panel.admin-list', [
            'admins' => $admins
        ]);
    }
}