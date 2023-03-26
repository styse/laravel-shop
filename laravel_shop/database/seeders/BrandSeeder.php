<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['id'=>1, 'name'=>'Asus', 'slug'=>110000000]
           ,['id'=>2, 'name'=>'Lenovo', 'slug'=>110000001]
           ,['id'=>3, 'name'=>'Samsung', 'slug'=>110000010]
        ];

        foreach ($items as $item)
            DB::table('products')->insert($item);
    }
}
