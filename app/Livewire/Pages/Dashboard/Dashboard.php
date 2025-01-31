<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\Selling;

class Dashboard extends Component
{
    public $products = []; // Property untuk menyimpan data produk
    public $totalProducts = 0;
    public $activeProducts = 0;
    public $inactiveProducts = 0;
    public $totalSalesPerYear = 0;

    public function mount()
    {
        $this->fetchProducts(); // Fetch data saat komponen pertama kali di-load
    }

    public function fetchProducts()
    {
        try {
            // Ambil semua produk dari database
            $this->products = Product::orderBy('created_at', 'desc')->get();
            $productsCollection = collect($this->products);
    
            // Hitung total produk
            $this->totalProducts = $productsCollection->count();
    
            // Hitung produk active dan inactive
            $this->activeProducts = $productsCollection->where('status', 'Active')->count();
            $this->inactiveProducts = $productsCollection->where('status', 'Inactive')->count();

            // Hitung total penjualan per tahun
            $this->totalSalesPerYear = Selling::whereYear('created_at', date('Y'))->sum('total_price');
    
        } catch (\Exception $e) {
            // Jika terjadi error, reset semua nilai
            $this->products = [];
            $this->totalProducts = 0;
            $this->activeProducts = 0;
            $this->inactiveProducts = 0;
        }
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard.dashboard');
    }
}
