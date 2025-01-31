<?php

namespace App\Livewire\Pages\Selling;

use App\Models\Selling;
use Livewire\Component;

class TransactionManagement extends Component
{

   public $transactions = [];
   
    public function mount()
    {
        $this->getTransaction();
    }
    
    //** Get Data */
    public function getTransaction()
    {
        $this->transactions = Selling::with('user')
            ->where('total_price', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.selling.transaction-management');

    }
}
