<?php

namespace App\Livewire\Pages\Selling;

use App\Models\Selling;
use App\Models\SellingDetail;
use Livewire\Component;

class TransactionView extends Component
{
    public $carts = [], $name = '', $date = '' , $totalPayment =0 , $totalChange = 0 ,$totalPrice = 0, $id;

    public function mount($id)
    {
        $this->id = $id;
        $this->getSellingDataProduct();
    }

    /**
     * Get Data Selling with product
     */
    public function getSellingDataProduct()
    {
        $seelingData = Selling::where('id', $this->id)->first();

        $this->name = $seelingData->customer_name;
        $this->date = $seelingData->date;
        $this->totalPrice = (int) $seelingData->total_price;
        $this->totalPayment = (int) $seelingData->total_payment;
        $this->totalChange = (int) $seelingData->total_change;


        //get product on selling detail
        $this->carts = SellingDetail::with('product')
        ->where('selling_id', $this->id)->get();
    }
    public function render()
    {
        return view('livewire.pages.selling.transaction-view');
    }
}
