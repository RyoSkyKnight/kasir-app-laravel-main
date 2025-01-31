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
           $userrole = 'Officer'; // Perbaikan: Gunakan string untuk menangkap role

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'userrole' => ['required', 'exists:roles,name'], // Perbaikan: Sesuaikan dengan form
        ];
    }

    public function createUser()
    {
        // Validasi data
        $this->validate();

        try {
            // Buat user baru
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            // Cek apakah role ada di database
            $role = Role::where('name', $this->userrole)->first();
            if (!$role) {
                throw new \Exception('Role not found');
            }

            // Berikan role kepada user
            $user->assignRole($role->name); // Pastikan menggunakan `name`, bukan ID

            // Flash message
            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'User successfully created!',
            ]);

            return redirect()->route('user'); // Ganti dengan route yang sesuai

        } catch (\Exception $e) {
            // Debugging error
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to create user!',
                'text' => $e->getMessage(), // Tambahkan pesan error agar tahu penyebabnya
            ]);
        }
    }
}
