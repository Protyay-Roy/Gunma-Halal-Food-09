<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1;$i<=500;$i++){
            $products = new Product;
            $products->admin_id  = 1;
            $products->category_id  = 4;
            $products->name = $faker->name;
            $products->slug = $faker->slug;
            $products->price = 2000;
            $products->discount = 0;
            $products->product_type = 'Dry';
            $products->cutting_system = 'No';
            $products->stock = 30;
            $products->status = 1;
            $products->image = 'images/product_image/demo_product.jpg';
            $products->save();
        }

    }
}
