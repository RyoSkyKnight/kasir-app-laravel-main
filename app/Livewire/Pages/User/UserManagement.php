<?php
namespace App\Livewire\Pages\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class UserManagement extends Component
{
    public $users = [];

    public function mount()
    {
        $this->fetchUsers();
    }

   

    public function fetchUsers()
    {
        // Ambil semua pengguna
        $users = User::all();

        // Ambil daftar user_id yang sedang aktif dari tabel sessions
        $activeSessions = DB::table('sessions')->pluck('user_id')->toArray();

        // Tambahkan status online ke setiap user
        foreach ($users as $user) {
            $user->is_online = in_array($user->id, $activeSessions);
        }

        $this->users = $users;
    }

    public function render()
    {
        return view('livewire.pages.user.user-management')->name('user-management');
    }
}
