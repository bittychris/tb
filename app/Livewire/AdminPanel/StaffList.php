<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use App\Notifications\UserActionNotification;

class StaffList extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $staff_id, $status, $btn_display, $keywords;

    public function mount($staffs_status) {
        $this->status = $staffs_status;

    }

    public function prepareDeleteStaff($staff_id) {
        $this->staff_id = $staff_id;
        $this->dispatch('openDeleteModal');

    }

    public function DeleteStaff() {

        if ($this->status == true) {
            $staff = User::where('id', $this->staff_id)->update([
                'status' => false
            ]);
    
            if ($staff) {
                $this->clearForm();

                $acting_user = User::find(auth()->user()->id);
                $acting_user->notify(new UserActionNotification(auth()->user(), 'Deleted Staff', 'admin'));

                $this->dispatch('closeForm');
                $this->dispatch('success_alert', 'Staff details deleted successfully');
                
                // session()->flash('warning', 'Staff details deleted successfully');
    
            } else {
                $this->dispatch('closeForm');
                $this->dispatch('failure_alert', 'An error occurred. Try again later.');
                
                // session()->flash('error', 'An error occurred. Try again later.');
            }

        } else {
            $staff = User::where('id', $this->staff_id)->update([
                'status' => true
            ]);
    
            if ($staff) {
                $this->clearForm();
                
                $acting_user = User::find(auth()->user()->id);
                $acting_user->notify(new UserActionNotification(auth()->user(), 'Restored deleted Staff', 'admin'));
            
                $this->dispatch('closeForm');
                $this->dispatch('success_alert', 'Staff details restored successfully');
                
                // session()->flash('success', 'Staff details restored successfully');
    
            } else {
                $this->dispatch('closeForm');
                $this->dispatch('failure_alert', 'An error occurred. Try again later.');

                // session()->flash('error', 'An error occurred. Try again later.');
            }

        }
        
    }

    public function clearForm() {
        $this->staff_id = '';
    }

    public function render()
    {
        $role_id = '';
        $role  = Role::where('name', 'Admin',)->get();
        foreach($role as $rl) {
            $role_id = $rl->id;

        }

        if ($this->status == false) {
            $this->btn_display = 'none';

            $staffs = User::select('users.*', 'regions.name', 'roles.name')
                    ->join('regions', 'users.region_id', '=', 'regions.id')
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->when($this->keywords, function ($query) {
            
                        $query->where('regions.name', 'like', '%'.$this->keywords.'%')        
                            ->orWhere('roles.name', 'like', '%'.$this->keywords.'%')            
                            ->orWhere('users.first_name', 'like', '%'.$this->keywords.'%')            
                            ->orWhere('users.last_name', 'like', '%'.$this->keywords.'%')            
                            ->orWhere('users.phone', 'like', '%'.$this->keywords.'%')            
                            ->orWhere('users.email', 'like', '%'.$this->keywords.'%');
            
                })->where('users.status', $this->status)->whereNot('users.role_id', $role_id)
                    ->orderBy('users.created_at', 'desc')->paginate(10);


        } else {
            $this->btn_display = '';
            $staffs = User::select('users.*', 'regions.name', 'roles.name')
                    ->join('regions', 'users.region_id', '=', 'regions.id')
                    ->join('roles', 'users.role_id', '=', 'roles.id')       
                    ->when($this->keywords, function ($query) {
            
                        $query->where('regions.name', 'like', '%'.$this->keywords.'%') 
                            ->orWhere('roles.name', 'like', '%'.$this->keywords.'%')            
                            ->orWhere('users.first_name', 'like', '%'.$this->keywords.'%')            
                            ->orWhere('users.last_name', 'like', '%'.$this->keywords.'%')            
                            ->orWhere('users.phone', 'like', '%'.$this->keywords.'%')            
                            ->orWhere('users.email', 'like', '%'.$this->keywords.'%');
            
                })->where('users.status', $this->status)->whereNot('users.role_id', $role_id)
                    ->orderBy('users.created_at', 'desc')->paginate(10);


        }

        return view('livewire.admin-panel.staff-list', [
            'staffs' => $staffs
        ]);
    }
}