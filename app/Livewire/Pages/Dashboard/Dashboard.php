<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\Selling;
use App\Models\SellingDetail;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $products = []; // Property to store product data
    public $topSellers = []; // Property to store top seller data
    public $totalProducts = 0;
    public $activeProducts = 0;
    public $inactiveProducts = 0;
    public $totalSalesPerYear = 0;

    public function mount()
    {
        $this->fetchProducts(); // Fetch data when component is first loaded
        $this->topSellerList();
    }

    public function fetchProducts()
    {
        try {
            // Get all products from database
            $this->products = Product::orderBy('created_at', 'desc')->get();
            $productsCollection = collect($this->products);
    
            // Count total products
            $this->totalProducts = $productsCollection->count();
    
            // Count active and inactive products
            $this->activeProducts = $productsCollection->where('status', 'Active')->count();
            $this->inactiveProducts = $productsCollection->where('status', 'Inactive')->count();

            // Calculate total sales per year
            $this->totalSalesPerYear = Selling::whereYear('created_at', date('Y'))->sum('total_price');
    
        } catch (\Exception $e) {
            // If error occurs, reset all values
            $this->products = [];
            $this->totalProducts = 0;
            $this->activeProducts = 0;
            $this->inactiveProducts = 0;
        }
    }

    public function topSellerList(){

        $this->topSellers = SellingDetail::with('product')
        ->select(
            'product_id', 
            DB::raw('SUM(quantity) as total_sold'),
            DB::raw('SUM(total_price) as total_price') // Use total_price instead of quantity * price
        )
        ->groupBy('product_id')
        ->orderByDesc('total_sold')
        ->get();
    
    
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard.dashboard');
    }
}
