<?php

namespace App\Models\Relations;

use App\Models\Product;
use App\Models\User;

trait CartRelations
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
