<?php

namespace App\Livewire\Pages\Product;

use App\Livewire\Forms\AddProductForm;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AddProduct extends Component
{
    use WithFileUploads;

    public AddProductForm $form;


    public function saveProduct()
    {
        $this->validate();
        $store = $this->form->addProduct();
    }

    public function render()
    {
        return view('livewire.pages.product.add-product');
    }
}
