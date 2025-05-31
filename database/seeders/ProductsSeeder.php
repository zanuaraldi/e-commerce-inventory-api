<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Masker Medis',
                'price' => 29000.00,
                'stock_quantity' => 100,
                'category_id' => 1
            ],
            [
                'name' => 'Tolak Angin',
                'price' => 50000.00,
                'stock_quantity' => 50,
                'category_id' => 1
            ],
            [
                'name' => 'Bodrex Flu & Batuk',
                'price' => 3000.00,
                'stock_quantity' => 40,
                'category_id' => 1
            ],
            [
                'name' => 'Asus Vivobook',
                'price' => 5599000.00,
                'stock_quantity' => 10,
                'category_id' => 2
            ],
            [
                'name' => 'Mouse Rexus',
                'price' => 300000.00,
                'stock_quantity' => 20,
                'category_id' => 2
            ],
            [
                'name' => 'Keyboard Logitech',
                'price' => 450000.00,
                'stock_quantity' => 40,
                'category_id' => 2
            ],
            [
                'name' => 'Setrika',
                'price' => 130000.00,
                'stock_quantity' => 25,
                'category_id' => 3
            ],
            [
                'name' => 'Oven',
                'price' => 1000000.00,
                'stock_quantity' => 5,
                'category_id' => 3
            ],
            [
                'name' => 'Vacuum Cleaner',
                'price' => 300000.00,
                'stock_quantity' => 50,
                'category_id' => 3
            ]
        ];
        DB::table('products')->insert($data);
    }
}
