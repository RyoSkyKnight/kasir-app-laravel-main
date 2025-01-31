<?php
namespace App\Livewire\Pages\User;

use App\Livewire\Forms\EditUserForm;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class EditUser extends Component
{
    public EditUserForm $form;
    public $roles = []; // Gunakan array kosong, nanti diisi di mount()

    public function mount($id)
    {
        $this->form->setEditUser($id);
        $this->roles = Role::pluck('name', 'name')->toArray(); // Ambil roles dari database
    }

    public function updateUser()
    {
        $this->validate();
        $store = $this->form->updateUser();
    }

    public function confirmDeleteUser($id)
    {
        try {
            User::where('id', $id)->delete();

            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'User deleted successfully'
            ]);

            $this->dispatch('userDeleted', $id);

            return redirect()->route('user');

        } catch (\Exception $e) {
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to delete user'
            ]);

            $this->dispatch('userDeleteFailed');
        }
    }

    public function render()
    {
        return view('livewire.pages.user.edit-user', [
            'roles' => $this->roles
        ]);
    }
}
