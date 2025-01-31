<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellingDetail extends Model
{
    protected $table = 'selling-detail';

    protected $fillable = [
        'selling_id',
        'product_id',
        'quantity',
        'total_price',
    ];

    //Join with product table
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
