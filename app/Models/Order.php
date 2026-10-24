<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'order_no', 'invoice_number', 'name', 'phone', 'email', 'zone', 'address', 'area',
    'subtotal', 'delivery_cost', 'discount', 'advance', 'total', 'payment_type',
    'payment_gateway', 'transaction_id', 'special_notes', 'status', 'nittoz_response', 'transferred_at',
])]
class Order extends Model
{
    protected function casts(): array
    {
        return [
            'nittoz_response' => 'array',
            'transferred_at' => 'datetime',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payable(): int
    {
        return max(0, (int) $this->subtotal + (int) $this->delivery_cost - (int) $this->discount - (int) $this->advance);
    }
}
