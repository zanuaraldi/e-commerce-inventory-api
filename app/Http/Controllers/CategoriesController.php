<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index()
    {
        return CategoriesModel::select('name')->get();
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150'
        ],[
            'name.required' => 'Nama produk tidak boleh kosong'
        ]);

        try {
            $category = CategoriesModel::create($validator->validate());

            return response()->json([
                'message' => 'Kategori baru berhasil ditambahkan',
                'data' => $category
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika menambahkan data'
            ], 500);
        }
    }
}
