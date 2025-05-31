<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'price', 'stock_quantity', 'category_id'];
    public function categories()
    {
        return $this->belongsTo(CategoriesModel::class);
    }
}
