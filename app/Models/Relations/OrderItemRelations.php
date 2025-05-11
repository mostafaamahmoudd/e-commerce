<?php

namespace App\Models\Relations;

use App\Models\Order;
use App\Models\Product;

trait OrderItemRelations
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
