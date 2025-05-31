<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return ProductsModel::with('categories')->get(['id', 'name', 'price', 'stock_quantity', 'category_id']);
    }
    
}
