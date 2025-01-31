<?php

namespace App\Livewire\Pages\Selling;

use App\Models\Selling;
use App\Models\SellingDetail;
use Livewire\Component;

class TransactionView extends Component
{
    public $product = [], $name = '', $date = '' , $totalPayment =0 , $totalChange = 0 ,$totalPrice = 0, $id;

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
        $this->totalPrice = $seelingData->total_price;
        $this->totalPayment = $seelingData->total_payment;
        $this->totalChange = $seelingData->total_change;


        //get product on selling detail
        $this->product = SellingDetail::where('selling_id', $this->id)->get();
    }
    public function render()
    {
        return view('livewire.pages.selling.transaction-view');
    }
}
