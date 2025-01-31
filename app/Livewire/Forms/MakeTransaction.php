<?php

namespace App\Livewire\Forms;

use App\Models\Selling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Form;

class MakeTransaction extends Form
{
    public ?Selling $selling = null;

    public $customer_name = '', $total_price = 0, $transaction_date = '', $user_id = '';

    protected $rules = [
        'customer_name' => 'required|min:3',
        'transaction_date' => 'required|date',
    ];

    public function createTransaction()
    {
        $this->validate();

        try {
            // Create new transaction
            $selling = Selling::create([
                'user_id' => Auth::id(),
                'customer_name' => $this->customer_name,
                'total_price' => 0, // Default 0, will be updated after products are added
                'total_payment' => 0, // Default 0, will be updated after payment
                'total_change' => 0, // Default 0, will be updated after payment
                'date' => $this->transaction_date,
            ]);

            // Save notification in session before redirect
            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'Transaction created successfully!'
            ]);

            // Redirect to transaction detail page to add products
            return redirect()->route('transaction.add.detail', ['id' => $selling->id]);

        } catch (\Exception $e) {
            // Log error if something goes wrong
            Log::error('Failed to create transaction', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'customer_name' => $this->customer_name
            ]);

            // Save error notification in session
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to create transaction. Please try again.'
            ]);
        }
    }
}
