<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Form;

class AddProductForm extends Form
{
    // Define nullable Product model property
    public ?Product $product = null;

    // Define form fields with default empty values
    public $name = '', $stock = '', $price = '';

    // Validation rules for form fields
    protected $rules = [
        'name' => 'required|min:3',          
        'stock' => 'required|numeric|min:0',  
        'price' => 'required|numeric|min:0',  
    ];

    public function addProduct()
    {
        // Validate the form data against the rules
        $this->validate();

        try {
            // Save data to database using Product model
            Product::create([
                'name' => $this->name,
                'stock' => $this->stock,
                'price' => $this->price,
                'status' => 'Draft',
            ]);

            // Store success notification in session before redirect
            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'Product added successfully'
            ]);

            return redirect()->to('/product');
        } catch (\Exception $e) {
            // Store error notification in session if something goes wrong
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to add product'
            ]);
        }
    }
}