<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    public function index()
    {
        return CategoriesModel::select('name')->get();
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150'
        ]);

        try {
            $category = CategoriesModel::create($validated);

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
