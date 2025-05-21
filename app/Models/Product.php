<?php

namespace App\Models;

use App\Models\Relations\ProductRelations;
use App\Support\Cartable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Cartable
{
    use HasFactory;
    use ProductRelations;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'sku',
        'category_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'price' => 'float',
        ];
    }

    public function getQuantity()
    {
        return $this->quantity - ($this->orderItems->sum('pivot.quantity') ?? 0);
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
