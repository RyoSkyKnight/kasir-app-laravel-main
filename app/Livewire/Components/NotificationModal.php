<?php
namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Product;

class NotificationModal extends Component
{
    public $lowStockProducts = []; // Products with stock < 5
    public $hasNotification = false; // Red dot indicator on button

    public function mount()
    {
        $this->fetchLowStockProducts();
    }

    public function fetchLowStockProducts()
    {
        // Get products with stock < 5
        $this->lowStockProducts = Product::where('stock', '<', 5)->get();
        // Check if there are products with stock < 5
        $this->hasNotification = collect($this->lowStockProducts)->isNotEmpty();
    }

    public function render()
    {
        return view('livewire.components.notification-modal');
    }
}
