<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Test extends Component
{
    #[Layout('layouts.app')]
    public $count = 0;

    public function increment()
    {
        Log::info('✅ Increment function triggered');
        $this->count++;
    }

    public function render()
    {
        return view('livewire.test');
    }
}
