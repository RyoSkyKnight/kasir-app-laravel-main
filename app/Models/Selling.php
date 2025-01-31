<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    protected $table = 'selling';

    protected $fillable = [
        'user_id',
        'customer_name',
        'date',
        'total_price',
    ];

    //join with user table
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
