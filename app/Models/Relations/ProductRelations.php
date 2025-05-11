<?php

namespace App\Models\Relations;

use App\Models\OrderItem;
use App\Models\Category;
use App\Models\User;

trait ProductRelations
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
