<?php
namespace App\Livewire\Forms;

use App\Models\User;
use App\Models\Selling; 
use Spatie\Permission\Models\Role;
use Livewire\Form;
use Illuminate\Validation\Rule;

class EditUserForm extends Form
{
    public ?User $user = null;

    public $id, $name = '', $email = '', $role = '', $salesCount = 0, $totalRevenue = 0 , $userRole = '';

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->id)],
            'role' => 'required|exists:roles,name', // Make sure it matches the roles table from Spatie
        ];
    }

    public function setEditUser($id)
    {
        $user = User::findOrFail($id);
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()->first(); 


        // Only "Officer" role has total sales & revenue
        if ($this->role === 'Officer') {
            $this->salesCount = Selling::where('user_id', $id)->count(); // Number of transactions
            $this->totalRevenue = (int) Selling::where('user_id', $id)->sum('total_price'); // Total revenue
        } else {
            $this->salesCount = 0;
            $this->totalRevenue = 0;
        }
    }

    public function updateUser()
    {
        $this->validate();

        try {
            $user = User::findOrFail($this->id);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            // Update role using Spatie
            $user->syncRoles([$this->role]); 

            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'User updated successfully'
            ]);
            return redirect()->route('user');
            
        } catch (\Exception $e) {
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to update user'
            ]);
        }
    }
}
