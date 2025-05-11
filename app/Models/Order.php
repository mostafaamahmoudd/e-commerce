<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Models\Relations\OrderRelations;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use OrderRelations;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'payment_method',
        'transaction_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'total_amount' => 'float',
            'status' => OrderStatus::class,
            'payment_method' => PaymentType::class,
            'transaction_id' => 'string'
        ];
    }
}
