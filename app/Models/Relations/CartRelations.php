<?php

namespace App\Models\Relations;

use App\Models\CartItem;

trait CartRelations
{
    /**
     * Relation one-to-many, CartItem model.
     */
    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
