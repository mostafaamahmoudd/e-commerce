<?php

namespace App\Models;

use App\Models\Relations\ProductRelations;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ProductRelations;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
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
}
