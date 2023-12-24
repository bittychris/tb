<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{
    public $current_password, $new_password, $confirm_password;

    protected function rules() {

        return [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string'],
            'confirm_password' => ['required', 'string'],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function changePassword() {
        $validatedData = $this->validate();

        if (Hash::check($validatedData['current_password'], auth()->user()->password)) {
            
            if($this->new_password == $this->confirm_password) {
        
                $password = User::where('id', auth()->user()->id)->update([
                    'password' => bcrypt($validatedData['new_password'])
                ]);
    
                if($password) {
    
                    $this->clearForm();
                    Auth::logout();
                    session()->invalidate();
                    session()->regenerateToken();
                    session()->flash('success', 'Password changed successfully. Login to continue');
                    return redirect(route('login'));
    
                } else {
                    return session()->flash('error', 'An error occurred. Try again later.');
    
                }
    
            } else {
                return session()->flash('warning', 'Confirm the password correctly');
                
            }

        } else {
            return session()->flash('warning', 'Current password is not correct');

        }

        
    }

    public function clearForm() {

        $this->reset(
            'current_password',
            'new_password',
            'confirm_password'        
        );
    }

    public function render()
    {
        return view('livewire.admin-panel.change-password');
    }
}
