<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name',
        'stock',
        'price',
        'status',
        'image',
        'created_at',
        'updated_at',
    ];

    public function sellingDetails()
    {
        return $this->hasMany(SellingDetail::class, 'product_id', 'id');
    }
}
