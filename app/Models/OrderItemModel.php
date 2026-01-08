<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\OrderModel;
use App\Models\ProductModel;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity', 
        'price_at_purchase'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(OrderModel::class,'order_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class,'product_id')->withTrashed();
    }
}
