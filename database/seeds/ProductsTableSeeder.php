<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[['name'=>'iphone',
            'product_type'=>'phone',
        'description'=>'description goes here ',
        'price'=>'3000',
        'image'=>'image/20.jpg'],
            ['name'=>'vivo',
                'product_type'=>'phone',
                'description'=>'description goes here',
                'price'=>'2000',
                'image'=>'image/21.jpg'],
            ['name'=>'apple',
                'product_type'=>'computer',
                'description'=>'description goes here',
                'price'=>'5000',
                'image'=>'image/22.jpg'],
            ['name'=>'legend',
                'product_type'=>'computer',
                'description'=>'description goes here',
                'price'=>'5000',
                'image'=>'image/23.jpg'],
            ['name'=>'sony',
                'product_type'=>'camera',
                'description'=>'description goes here',
                'price'=>'2000',
                'image'=>'image/24.jpg'],
            ['name'=>'canon',
                'product_type'=>'camera',
                'description'=>'description goes here',
                'price'=>'1900',
                'image'=>'image/25.jpg'],
            ['name'=>'jackson',
                'product_type'=>'clothes',
                'description'=>'description goes here',
                'price'=>'1000',
                'image'=>'image/26.jpg'],
            ['name'=>'moon',
                'product_type'=>'clothes',
                'description'=>'description goes here',
                'price'=>'1000',
                'image'=>'image/27.jpg'],

      ];
        DB::table('products')->insert($data);
    }
}
