<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use CartRelations;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total',
    ];
}
