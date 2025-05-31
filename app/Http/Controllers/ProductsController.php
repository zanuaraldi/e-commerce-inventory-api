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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        try {
            $product = ProductsModel::create($validated);
            return response()->json([
                'message' => 'Produk baru berhasil ditambahkan',
                'data' => $product
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika menambahkan data'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = ProductsModel::with('categories')->findOrFail($id);
            return response()->json($product);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika mencari data'
            ], 500);
        }
    }
}
