<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CategoryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = 
    [
        'category_id', 
        'name', 
        'description', 
        'price', 
        'stock', 
        'image'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryModel::class);
    }
}
