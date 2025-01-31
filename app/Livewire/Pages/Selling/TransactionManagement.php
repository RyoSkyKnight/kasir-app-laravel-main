<?php

namespace App\Livewire\Pages\Selling;

use App\Models\Selling;
use Livewire\Component;

class TransactionManagement extends Component
{

    //** Get Data */
    public function getTransaction()
    {
        $transactions = Selling::with('user')
            ->where('total_price', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        return $transactions;
    }
    public function render()
    {
        return view('livewire.pages.selling.transaction-management', [
            'transactions' => $this->getTransaction()
        ]);

    }
}
