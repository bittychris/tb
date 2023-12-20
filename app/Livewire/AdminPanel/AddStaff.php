<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AddStaff extends Component
{
    public $staff, $staff_id, $first_name, $last_name, $phone, $email, $roles, $role_id;

    public $editMode = false;
    
    public function mount($staff_id = null)
    {
        $this->staff_id = $staff_id;

        if ($staff_id){
            $this->editMode = true;

            $this->staff = User::findOrFail($staff_id);

            $this->first_name = $this->staff->first_name;
            $this->last_name = $this->staff->last_name;
            $this->email = $this->staff->email;
            $this->phone = $this->staff->phone;
            $this->role_id = $this->staff->role_id;
            
        }else{
            $this->editMode = false;
        }
    }

    protected function rules() {

        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'role_id' => ['required', 'string'],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveStaff() {
        $validatedData = $this->validate();

        if($this->editMode == false) {
            // $this->user->password = bcrypt($this->user_password);

            $checkStaffExists = User::where('email', $validatedData['email'])->exists();

            if ($checkStaffExists) {
                session()->flash('already_exist', 'The Email already exists.');

            } else {
            
                $staff = User::create([
                    'first_name' => $validatedData['first_name'],
                    'last_name' => $validatedData['last_name'],
                    'phone' => $validatedData['phone'],
                    'email' => $validatedData['email'],
                    'role_id' => $validatedData['role_id'],
                    'password' => bcrypt('Admin')
                ]);

                if ($staff) {
                    $role = Role::find($this->role_id);
                    $staff->assignRole($role->name);

                    $this->clearForm();
                    session()->flash('success', 'New Staff saved successfully');
                    return redirect(route('admin.staffs'));

                } else {
                    session()->flash('error', 'An error occurred. Try again later.');
                }

            }

        } else {
            
            $staff = User::where('id', $this->staff_id)->update([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'role_id' => $validatedData['role_id']

            ]);

            // $staff->roles()->detach(); // this didn't work

            if ($staff) {
                // clear staff data in model_has_role table to enter new one
                $del_existing_role = DB::table('model_has_roles')->where('model_id', $this->staff_id)
                                    ->get();
                
                if($del_existing_role) {
                    DB::table('model_has_roles')->where('model_id', $this->staff_id)
                        ->delete();

                    $role = Role::find($this->role_id);
                    $staff = User::find($this->staff_id);
                    $staff->assignRole($role->name);

                    $this->clearForm();
                    session()->flash('success', 'Staff details updated successfully');
                    return redirect(route('admin.staffs'));

                } else {
                    $role = Role::find($this->role_id);
                    $staff = User::find($this->staff_id);
                    $staff->assignRole($role->name);

                    $this->clearForm();
                    session()->flash('success', 'Staff details updated successfully');
                    return redirect(route('admin.staffs'));
    
                }
               
            } else {
                session()->flash('error', 'An error occurred. Try again later.');
            }
            
        }
        

    }

    public function clearForm() {
        $this->editMode = false;

        $this->staff = '';

        $this->staff_id = '';

        $this->reset(
            'first_name',
            'last_name',
            'phone',
            'email',
            'role_id',
        );
    }

    public function render()
    {
        $this->roles = Role::whereNot('name', 'Admin')->get();

        return view('livewire.admin-panel.add-staff', [
            'roles' => $this->roles,
        ]);
    }
}
