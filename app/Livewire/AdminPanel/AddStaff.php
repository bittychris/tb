<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Notifications\UserActionNotification;

class AddStaff extends Component
{
    public $staff, $staff_id, $first_name, $last_name, $phone, $email, $roles, $role_id, $region;

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
                    'password' => bcrypt(12345)
                ]);

                if ($staff) {
                    $role = Role::find($this->role_id);
                    $staff->assignRole($role->name);
                    $permissions = DB::table('role_has_permissions')->where('role_id', $role->id)->get();
                    $addedStaff = User::latest()->first();

                    foreach($permissions as $permission) {
                        if($addedStaff) {
                            DB::table('model_has_permissions')->insert([
                                'permission_id' => $permission->permission_id,
                                'model_id' => $addedStaff->id,
                                'model_type' => 'App\Models\User'
                            ]);
    
                        }
                    }

                    $this->clearForm();

                    $acting_user = User::find(auth()->user()->id);
                    $acting_user->notify(new UserActionNotification(auth()->user(), 'Added new Staff'));

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
                    
                    DB::table('model_has_permissions')->where('model_id', $this->staff_id)
                        ->delete();

                    $role = Role::find($this->role_id);
                    $staff = User::find($this->staff_id);
                    $staff->assignRole($role->name);
                    $permissions = DB::table('role_has_permissions')->where('role_id', $role->id)->get();

                    foreach($permissions as $permission) {
                        DB::table('model_has_permissions')->insert([
                            'permission_id' => $permission->permission_id,
                            'model_id' => $this->staff_id,
                            'model_type' => 'App\Models\User'
                        ]);
    
                    }

                    $this->clearForm();
                    
                    $acting_user = User::find(auth()->user()->id);
                    $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated Staff details'));

                    session()->flash('success', 'Staff details updated successfully');
                    return redirect(route('admin.staffs'));

                } else {
                    $role = Role::find($this->role_id);
                    $staff = User::find($this->staff_id);
                    $staff->assignRole($role->name);

                    $this->clearForm();
                    
                    $acting_user = User::find(auth()->user()->id);
                    $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated Staff details'));

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