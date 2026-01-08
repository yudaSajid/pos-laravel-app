<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ProductModel;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $fillable = ['name', 'slug'];

    public function products(): HasMany
    {
        return $this->hasMany(ProductModel::class);
    }
}
