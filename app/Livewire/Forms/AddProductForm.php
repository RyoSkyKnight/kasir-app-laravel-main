<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Form;

class AddProductForm extends Form
{
    public ?Product $product = null;

    public $name = '', $stock = '', $price = '';

    protected $rules = [
        'name' => 'required|min:3',
        'stock' => 'required|numeric|min:0',
        'price' => 'required|numeric|min:0',
    ];


    public function addProduct()
    {
        $this->validate();

        try {
            // Simpan data ke database menggunakan model Product
            Product::create([
                'name' => $this->name,
                'stock' => $this->stock,
                'price' => $this->price,
                'status' => 'Draft',
            ]);

            // Simpan notifikasi di session sebelum redirect
            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'Product added successfully'
            ]);

            return redirect()->to('/product');
        } catch (\Exception $e) {
            // Simpan notifikasi di session sebelum redirect jika terjadi kesalahan
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to add product'
            ]);
        }
    }
}
