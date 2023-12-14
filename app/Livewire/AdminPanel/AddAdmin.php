<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AddAdmin extends Component
{
    public $admin, $admin_id, $first_name, $last_name, $phone, $email, $roles, $role_id;

    public $editMode = false;
    
    public function mount($admin_id = null)
    {
        $this->admin_id = $admin_id;

        if ($admin_id){
            $this->editMode = true;

            $this->admin = User::findOrFail($admin_id);

            $this->first_name = $this->admin->first_name;
            $this->last_name = $this->admin->last_name;
            $this->email = $this->admin->email;
            $this->phone = $this->admin->phone;
            $this->role_id = $this->admin->role_id;
            
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
            'role_id' => ['required', 'integer'],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveAdmin() {
        $validatedData = $this->validate();

        if($this->editMode == false) {
            // $this->user->password = bcrypt($this->user_password);

            $checkAdminExists = User::where('email', $validatedData['email'])->exists();

            if ($checkAdminExists) {
                session()->flash('already_exist', 'The Email already exists.');

            } else {
            
                $admin = User::create([
                    'first_name' => $validatedData['first_name'],
                    'last_name' => $validatedData['last_name'],
                    'phone' => $validatedData['phone'],
                    'email' => $validatedData['email'],
                    'role_id' => $validatedData['role_id'],
                    'password' => bcrypt('Admin')

                ]);

                if ($admin) {
                    $role = Role::find($this->role_id);
                    $admin->assignRole($role->name);
                    
                    $this->clearForm();
                    session()->flash('success', 'New Admin saved successfully');
                    return redirect(route('admin.admins'));
                    
                } else {
                    session()->flash('error', 'An error occurred. Try again later.');
                }

            }

        } else {
            
            $admin = User::where('id', $this->admin_id)->update([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'role_id' => $validatedData['role_id']

            ]);
            
            // $admin->roles()->detach(); // This didn't work

            if ($admin) {
                // clear admin data in model_has_role table to enter new one
                $del_existing_role = DB::table('model_has_roles')->where('model_id', $this->admin_id)
                                    ->delete();
                
                if($del_existing_role) {
                    $role = Role::find($this->role_id);
                    $admin = User::find($this->admin_id);
                    $admin->assignRole($role->name);

                    $this->clearForm();
                    session()->flash('success', 'Admin details updated successfully');
                    return redirect(route('admin.admins'));
    
                }
               
            } else {
                session()->flash('error', 'An error occurred. Try again later.');
            }
            
        }
        

    }

    public function clearForm() {
        $this->editMode = false;

        $this->admin = '';

        $this->admin_id = '';

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
        $this->roles = Role::where('name', 'Admin')->get();

        return view('livewire.admin-panel.add-admin', [
            'roles' => $this->roles,
        ]);
    }
}