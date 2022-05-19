<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            '1'=>
            [
                'name' => 'Product 1' ,
                'description' => 'Product 1 description',
                'price' => rand(10,1000)
            ],
            '2'=>
            [
                'name' => 'Product 2' ,
                'description' => 'Product 2 description',
                'price' => rand(10,1000)
            ],
            '3'=>
            [
                'name' => 'Product 3' ,
                'description' => 'Product 3 description',
                'price' => rand(10,1000)
            ],
            '4'=>
            [
                'name' => 'Product 4' ,
                'description' => 'Product 4 description',
                'price' => rand(10,1000)
            ],
            '5'=>
            [
                'name' => 'Product 5' ,
                'description' => 'Product 5 description',
                'price' => rand(10,1000)
            ]
           ]);
        //
        // for ($i = 1; $i <= 20; $i++) {
        //     DB::table('categories')->insert([
        //         'name' => 'Product' . $i,
        //         'description' => 'Product ' . $i . 'description',
        //         'price' => rand(10,1000)
        //     ]);
        // }
    }
}
