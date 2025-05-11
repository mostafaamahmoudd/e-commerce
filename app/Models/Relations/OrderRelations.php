<?php

namespace App\Models\Relations;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

trait OrderRelations
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot(['quantity', 'price']);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
