<?php

namespace App\Models\Relations;

use App\Models\Product;

trait UserRelations
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
