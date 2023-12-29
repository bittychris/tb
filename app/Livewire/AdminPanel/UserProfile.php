<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Component
{
    public $userDetails, $first_name, $last_name, $phone, $email;

    public $editMode = false;

    public $emailExists = false;

    public function prepareData() {
        $this->editMode = true;

        if($this->editMode == true) {
            $this->first_name = $this->userDetails->first_name;
            $this->last_name = $this->userDetails->last_name;
            $this->email = $this->userDetails->email;
            $this->phone = $this->userDetails->phone;

        }
        
    }

    protected function rules() {

        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            // 'email' => 'required|email|unique:users,email,' . auth()->id(),
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->user()->id),
            ],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveUserDetails() {
        $validatedData = $this->validate();

        $user = User::where('id', $this->userDetails->id)->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email']

        ]);

        if($user) {
            $this->clearForm();
            redirect(route('user.profile'));
            session()->flash('success', 'Profile details updated successfully');

        }

    }

    public function clearForm() {
        $this->editMode = false;

        $this->reset(
            'first_name',
            'last_name',
            'phone',
            'email',
        );
    }
    
    public function render()
    {
        $this->userDetails = Auth::user();

        return view('livewire.admin-panel.user-profile', [
            'userDetails' => $this->userDetails
        ]);
    }
}
