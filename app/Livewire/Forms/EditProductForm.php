<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use App\Models\Selling;
use App\Models\SellingDetail;
use Livewire\Form;

class EditProductForm extends Form
{
    public ?Product $product = null;

    public $id = '', $name = '', $stock = '', $price = 0, $status = '' , $soldStock = '' , $soldTotalPrice = 0;

    protected $rules = [
        'name' => 'required|min:3',
        'stock' => 'required|numeric|min:0',
        'price' => 'required|numeric|min:0',
        'status' => 'required',
    ];

    public function setEditProduct($id)
    {
        // Ambil data produk berdasarkan ID dari database
        $product = Product::find($id);

        if (!$product) {
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Product not found'
            ]);

            return redirect()->to('/product');
        }

        $this->id = $product->id;
        $this->name = $product->name;
        $this->stock = $product->stock;
        $this->status = $product->status;
        $this->price = (int) $product->price;


        // Menghitung total produk yang terjual
        $this->soldStock = SellingDetail::where('product_id', $product->id)->sum('quantity');
        // Menghitung total harga produk yang terjual
        $this->soldTotalPrice = SellingDetail::where('product_id', $product->id)->sum('total_price');
    }

    public function updateProduct()
    {
        $this->validate();

        try {
            // Update produk di database
            Product::where('id', $this->id)->update([
                'name' => $this->name,
                'stock' => $this->stock,
                'price' => (float) $this->price,
                'status' => $this->status,
            ]);

            // Simpan notifikasi di session sebelum redirect
            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'Product updated successfully'
            ]);

            return redirect()->to('/product');
        } catch (\Exception $e) {
            // Simpan notifikasi di session sebelum redirect jika terjadi kesalahan
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to update product'
            ]);
        }
    }
}
