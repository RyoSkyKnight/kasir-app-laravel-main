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
            // Buat transaksi baru
            $selling = Selling::create([
                'user_id' => Auth::id(),
                'customer_name' => $this->customer_name,
                'total_price' => 0, // Default 0, akan di-update setelah produk ditambahkan
                'date' => $this->transaction_date,
            ]);

            // Simpan notifikasi di session sebelum redirect
            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'Transaction created successfully!'
            ]);

            // Redirect ke halaman detail transaksi untuk menambahkan produk
            return redirect()->route('transaction.add.detail', ['id' => $selling->id]);

        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan
            Log::error('Failed to create transaction', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'customer_name' => $this->customer_name
            ]);

            // Simpan notifikasi kesalahan di session
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to create transaction. Please try again.'
            ]);
        }
    }
}
