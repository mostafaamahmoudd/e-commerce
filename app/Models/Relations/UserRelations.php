<?php

namespace App\Models\Relations;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

trait UserRelations
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function orderItems()
    {
        return $this->hasManyThrough(OrderItem::class, Order::class);
    }
}
