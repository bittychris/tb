<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class StaffList extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $staff_id;

    public function prepareDeleteStaff($staff_id) {
        $this->staff_id = $staff_id;
    }

    public function DeleteStaff() {

        $staff = User::where('id', $this->staff_id)->update([
            'status' => false
        ]);

        if ($staff) {
            $this->clearForm();
            redirect(route('admin.staffs'));
            session()->flash('danger', 'Staff details deleted successfully');

        } else {
            session()->flash('error', 'An error occurred. Try again later.');
        }

    }

    public function clearForm() {
        $this->staff_id = '';
    }

    public function render()
    {
        $staffs = User::where('status', true)->whereNot('role_id', 1)->latest()->paginate(10);

        return view('livewire.admin-panel.staff-list', [
            'staffs' => $staffs
        ]);
    }
}
