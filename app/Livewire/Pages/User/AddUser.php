<?php

namespace App\Livewire\Pages\User;

use App\Livewire\Forms\AddUserForm;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddUser extends Component
{
    public AddUserForm $form;
    public $roles = [];

    public function mount()
    {
        $this->roles = Role::pluck('name', 'name')->toArray();
    }

    public function saveUser()
    {
       $this->validate();
        $store = $this->form->createUser();
    }

    public function render()
    {
        return view('livewire.pages.user.add-user',[
            'roles' => $this->roles
        ]);
    }
}
