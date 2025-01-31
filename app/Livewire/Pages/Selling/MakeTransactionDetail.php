<?php

namespace App\Livewire\Pages\Selling;

use App\Models\Product;
use App\Models\Selling;
use App\Models\SellingDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MakeTransactionDetail extends Component
{
    public $sellingId;
    public $products = [];
    public $totalPrice = 0;
    public $selectedProduct = '';
    public $quantity = 1;
    public $paidAmount = 0;
    public $changeAmount = 0;
    protected $listeners = ['forceCloseTransaction'];


    /**
     * Initialize transaction details
     */
    public function mount($id)
    {
        if (!$id) {
            $this->dispatch('notify', type: 'error', message: 'Transaction ID is missing');
            return redirect()->route('transaction');
        }

        $this->sellingId = $id;
        $this->products = Product::all();
        $this->updateTotalPrice();
    }

    /**
     * Get the change amount property
     */
    public function updatePaidAmount()
    {
        // Validasi jika paidAmount kosong atau kurang dari total price
        if (!$this->paidAmount || $this->paidAmount < $this->totalPrice) {
            $this->dispatch('notify', type: 'error', message: 'Paid amount is not enough');
            $this->changeAmount = 0; // Reset change amount jika tidak valid
            return;
        }
    
        // Hitung kembalian jika pembayaran cukup
        $this->changeAmount = $this->paidAmount - $this->totalPrice;
    }
    
    /**
     * Get the cart data from session
     */
    public function getCart()
    {
        return Session::get("cart_{$this->sellingId}", []);
    }

    /**
     * Add product to the cart
     */
    public function addToCart()
    {
        $this->validate([
            'selectedProduct' => 'required|exists:product,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $product = Product::find($this->selectedProduct);
        if (!$product) {
            return $this->dispatch('notify', type: 'error', message: 'Product not found');
        }

        if ($this->quantity > $product->stock) {
            return $this->dispatch('notify', type: 'error', message: 'Product stock is not enough');
        }

        $cart = $this->getCart();
        $cart[$this->selectedProduct] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'quantity' => isset($cart[$this->selectedProduct])
                ? $cart[$this->selectedProduct]['quantity'] + $this->quantity
                : $this->quantity,
        ];

        if ($cart[$this->selectedProduct]['quantity'] > $product->stock) {
            return $this->dispatch('notify', type: 'error', message: 'Product stock is not enough');
        }

        Session::put("cart_{$this->sellingId}", $cart);
        $this->updateTotalPrice();

        $this->dispatch('notify', type: 'success', message: 'Product added to cart');
    }

    /**
     * Remove product from the cart
     */
    public function removeFromCart($productId)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put("cart_{$this->sellingId}", $cart);
            $this->updateTotalPrice();
            return $this->dispatch('notify', type: 'success', message: 'Product removed from cart');
        }

        return $this->dispatch('notify', type: 'error', message: 'Product not found in cart');
    }

    /**
     * Update total price of the cart
     */
    public function updateTotalPrice()
    {
        $cart = $this->getCart();
        $this->totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }
    /**
     * Confirm the transaction
     */
    public function confirmTransaction()
    {
        try {

            $this->updatePaidAmount();

            DB::transaction(function () {
                $cart = $this->getCart();

                foreach ($cart as $item) {
                    $product = Product::find($item['id']);

                    if (!$product || $product->stock < $item['quantity']) {
                        throw new \Exception("Stock not sufficient for product: {$item['name']}");
                    }

                    SellingDetail::create([
                        'selling_id' => $this->sellingId,
                        'product_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'total_price' => $item['price'] * $item['quantity']
                    ]);

                    $product->decrement('stock', $item['quantity']);
                }

                Selling::where('id', $this->sellingId)->update([
                    'total_price' => DB::raw("total_price + {$this->totalPrice}"),
                    'total_payment' => $this->paidAmount,
                    'total_change' => $this->changeAmount,
                ]);
                Session::forget("cart_{$this->sellingId}");
            });

            // Kirim event ke frontend untuk cetak struk dengan Print.js
            $this->dispatch('printReceipt');

            session()->flash('sweet-alert', [
                'icon' => 'success',
                'title' => 'Transaction confirmed successfully'
            ]);

            return redirect()->route('transaction');
        } catch (\Exception $e) {
            return $this->dispatch('notify', type: 'error', message: 'Failed to confirm transaction: ' . $e->getMessage());
        }
    }

    /**
     * Cancel the transaction
     */
    public function cancelTransaction()
    {
        try {
            Session::forget("cart_{$this->sellingId}");
            Selling::where('id', $this->sellingId)->delete();

            return $this->dispatch('notify', type: 'info', message: 'Transaction canceled');
        } catch (\Exception $e) {
            return $this->dispatch('notify', type: 'error', message: 'Failed to cancel transaction');
        }
    }

    /**
     * Force close the transaction
     */
    public function forceCloseTransaction()
    {
        try {
            DB::transaction(function () {
                $cart = $this->getCart();

                foreach ($cart as $item) {
                    $product = Product::find($item['id']);
                    if ($product) {
                        $product->increment('stock', $item['quantity']);
                    }
                }

                Session::forget("cart_{$this->sellingId}");
                Selling::where('id', $this->sellingId)->delete();
            });

            session()->flash('sweet-alert', [
                'icon' => 'info',
                'title' => 'Transaction closed successfully, all products are returned to stock'
            ]);

            return redirect()->route('transaction');
        } catch (\Exception $e) {
            $this->dispatch('notify', type: 'error', message: 'Failed to close transaction. Please try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.pages.selling.make-transaction-detail');
    }
}
