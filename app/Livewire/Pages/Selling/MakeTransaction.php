<?php

namespace App\Livewire\Pages\Selling;

use App\Livewire\Forms\MakeTransaction as FormsMakeTransaction;
use Livewire\Component;

class MakeTransaction extends Component
{

    public FormsMakeTransaction $form;

    public function makeTransaction()
    {
        $this->validate();
        $this->form->createTransaction();
    }
    public function render()
    {
        return view('livewire.pages.selling.make-transaction');
    }
}
