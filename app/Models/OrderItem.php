<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Relations\OrderItemRelations;

class OrderItem extends Model
{
    use OrderItemRelations;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'quantity' => 'decimal',
            'price' => 'decimal',
        ];
    }
}
