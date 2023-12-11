<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class StaffList extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $staff_id, $status, $btn_display;

    public function mount($staffs_status) {
        $this->status = $staffs_status;

    }

    public function prepareDeleteStaff($staff_id) {
        $this->staff_id = $staff_id;
    }

    public function DeleteStaff() {

        if ($this->status == true) {
            $staff = User::where('id', $this->staff_id)->update([
                'status' => false
            ]);
    
            if ($staff) {
                $this->clearForm();
                session()->flash('warning', 'Staff details deleted successfully');
    
            } else {
                session()->flash('error', 'An error occurred. Try again later.');
            }

        } else {
            $staff = User::where('id', $this->staff_id)->update([
                'status' => true
            ]);
    
            if ($staff) {
                $this->clearForm();
                session()->flash('success', 'Staff details restored successfully');
    
            } else {
                session()->flash('error', 'An error occurred. Try again later.');
            }

        }
        
    }

    public function clearForm() {
        $this->staff_id = '';
    }

    public function render()
    {
        if ($this->status == false) {
            $this->btn_display = 'none';

            $staffs = User::where('status', $this->status)->whereNot('role_id', 1)->latest()->paginate(10);

        } else {
            $this->btn_display = '';
            $staffs = User::where('status', $this->status)->whereNot('role_id', 1)->latest()->paginate(10);

        }

        return view('livewire.admin-panel.staff-list', [
            'staffs' => $staffs
        ]);
    }
}
