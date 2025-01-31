<?php

namespace App\Livewire\Pages\Product;

use App\Livewire\Forms\EditProductForm;
use Livewire\Component;
use App\Models\Product;

class EditProduct extends Component
{
    public EditProductForm $form;

    public function mount($id)
    {
        $this->form->setEditProduct($id);
    }
    public function update()
    {
        $this->validate();
        $this->form->updateProduct();
    }

    public function confirmDeleteProduct($id)
    {

        try {

          Product::where('id', $id)->delete();
          return redirect()->route('product');

            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'Product deleted successfully'
            ]);

            $this->dispatch('productDeleted', $id);

        } catch (\Exception $e) {
            session()->flash('sweet-alert', [
                'icon' => 'error',
                'title' => 'Failed to delete product'
            ]);

            $this->dispatch('productDeleteFailed');
        }
    }

    public function render()
    {
        return view('livewire.pages.product.edit-product');
    }
}
