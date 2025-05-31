<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Kesehatan'
            ],
            [
                'name' => 'Komputer & Laptop'
            ],
            [
                'name' => 'Elektronik'
            ],
        ];
        DB::table('categories')->insert($data);
    }
}
