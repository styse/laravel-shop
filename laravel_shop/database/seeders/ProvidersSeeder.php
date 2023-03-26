<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $items = [
            ['id'=>1, 'name'=>'Provider1', 'slug'=>110000000, 'address'=>'Laborum consectetur ullamco consequat et.', 'phone'=>'+98987654321']
           ,['id'=>2, 'name'=>'Provider2', 'slug'=>110000001, 'address'=>'Incididunt eu aliquip sint enim esse.', 'phone'=>'+98256798765']
           ,['id'=>3, 'name'=>'Provider3', 'slug'=>110000010, 'address'=>'Mollit in ex commodo magna.', 'phone'=>'+98123456789']
        ];

        foreach ($items as $item)
            DB::table('providers')->insert($item);
    }
}
