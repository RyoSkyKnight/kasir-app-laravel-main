<?php

namespace App\Livewire\Pages\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;

class Product extends Component
{
    use WithFileUploads;

    public $products = [];

    public function mount()
    {
        $this->fetchProducts();
    }

    public function fetchProducts()
    {
        try {
            // Ambil semua produk dari database
            $this->products = ProductModel::orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            $this->products = [];
        }
    }

    public function render()
    {
        return view('livewire.pages.product.product')->name('product');
    }
}
