<?php

namespace App\Models\Relations;

use App\Models\Product;

trait CategoryRelations
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
