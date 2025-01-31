<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class AddUserForm extends Form
{
    public ?User $user = null;

    public $name = '', 
           $email = '', 
           $password = 'Officer1!', 
           $password_confirmation = 'Officer1!', 
           $userrole = 'Officer'; // Fix: Use string to capture role

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'userrole' => ['required', 'exists:roles,name'], // Fix: Adjust with form
        ];
    }

    public function createUser()
    {
        // Validate data
        $this->validate();

        try {
            // Create new user
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            // Check if role exists in database
            $role = Role::where('name', $this->userrole)->first();
            if (!$role) {
                throw new \Exception('Role not found');
            }

            // Assign role to user
            $user->assignRole($role->name); // Make sure to use `name`, not ID

            // Flash message
            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'User successfully created!',
            ]);

            return redirect()->route('user'); // Replace with appropriate route

        } catch (\Exception $e) {
            // Debugging error
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to create user!',
                'text' => $e->getMessage(), // Add error message to know the cause
            ]);
        }
    }
}
