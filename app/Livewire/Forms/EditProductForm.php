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
        // Get product data by ID from database
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


        // Calculate total products sold
        $this->soldStock = SellingDetail::where('product_id', $product->id)->sum('quantity');
        // Calculate total price of products sold
        $this->soldTotalPrice = SellingDetail::where('product_id', $product->id)->sum('total_price');
    }

    public function updateProduct()
    {
        $this->validate();

        try {
            // Update product in database
            Product::where('id', $this->id)->update([
                'name' => $this->name,
                'stock' => $this->stock,
                'price' => (float) $this->price,
                'status' => $this->status,
            ]);

            // Store notification in session before redirect
            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'Product updated successfully'
            ]);

            return redirect()->to('/product');
        } catch (\Exception $e) {
            // Store notification in session before redirect if error occurs
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to update product'
            ]);
        }
    }
}
