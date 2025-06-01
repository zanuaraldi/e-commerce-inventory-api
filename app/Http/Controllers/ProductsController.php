<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        return ProductsModel::with('categories')->get(['id', 'name', 'price', 'stock_quantity', 'category_id']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ],[
            'name.required' => 'Nama produk tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong',
            'price.min' => 'Harga tidak boleh negatif',
            'stock_quantity.required' => 'Stok tidak boleh kosong',
            'stock_quantity.min' => 'Stok tidak boleh negatif',
            'category_id.required' => 'Kategori tidak boleh kosong',
            'category_id.exists' => 'Kategori tidak valid atau tidak ada'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'error' => $validator->errors()
            ]);
        }

        try {
            $product = ProductsModel::create($validator->validate());
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
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika mencari data'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0'
        ],[
            'name.required' => 'Nama produk tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong',
            'price.min' => 'Harga tidak boleh negatif',
            'stock_quantity.required' => 'Stok tidak boleh kosong',
            'stock_quantity.min' => 'Stok tidak boleh negatif'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'error' => $validator->errors()
            ]);
        }

        try {
            $product = ProductsModel::findOrFail($id);
            $product->update($validator->validate());
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika memperbarui data'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = ProductsModel::findOrFail($id);
            $product->delete();
            return response()->json(['message' => 'Hapus produk berhasil dilakukan'], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika menghapus data'
            ], 500);
        }
    }

    public function updateStock(Request $request)
    {
        try {
            $product = ProductsModel::findOrFail($request->product_id);
            $product->stock_quantity -= $request->quantity_sold;

            if ($product->stock_quantity < 0) {
                return response()->json(['message' => 'Jumlah stok barang tidak bisa kurang dari 0']);
            }

            $product->save();
            return response()->json([
                'message' => 'Jumlah stok telah diperbarui',
                'name' => $product->name,
                'stock_quantity' => $product->stock_quantity
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika memperbarui data'
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = ProductsModel::query();

            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            $product = $query->with('categories')->get();
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika pencarian data'
            ], 500);
        }
    }

    public function inventoryValue()
    {
        try {
            $total = ProductsModel::selectRaw('SUM(price * stock_quantity) as total')->value('total');
            return response()->json([
                'total_inventory_value' => $total
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika menghitung total inventaris'
            ], 500);
        }
    }
}
