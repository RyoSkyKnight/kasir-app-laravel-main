<?php
namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Product;

class NotificationModal extends Component
{
    public $lowStockProducts = []; // Produk dengan stok < 5
    public $showModal = false; // Status modal
    public $hasNotification = false; // Indikator titik merah di tombol

    public function mount()
    {
        $this->fetchLowStockProducts();
    }

    public function fetchLowStockProducts()
    {
      // Ambil produk dengan stok < 5
      $this->lowStockProducts = Product::where('stock', '<', 5)->get();

      // Notifikasi muncul jika ada produk dengan stok rendah
      if (!$this->showModal) {
      $this->hasNotification = collect($this->lowStockProducts)->isNotEmpty();
      }
    }

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;

        // Notifikasi tetap ada meskipun modal dibuka
        if ($this->showModal) {
            $this->fetchLowStockProducts();
            $this->hasNotification = false;
        }
    }

    public function render()
    {
        return view('livewire.components.notification-modal');
    }
}
