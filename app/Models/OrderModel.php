<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\OrderItemModel;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id', 'order_number', 'total_price', 
        'status_payment', 'status_shipping', 
        'payment_proof', 'shipping_address'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItemModel::class, 'order_id', 'id');
    }
}
