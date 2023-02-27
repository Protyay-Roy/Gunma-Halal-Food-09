<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            ['id' => 1,'name' => 'Meat & Fish', 'slug' => 'meat-fish','status' => 1,
            'meta_description' => '1 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            'description' => '1 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.'],
            ['id' => 2, 'name' => 'Beans & Dry Fruit', 'slug' => 'beans-dry-fruit','status' => 1,
            'meta_description' => '2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            'description' => '2 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.'],
            ['id' => 3, 'name' => 'Vegetable & Fruits', 'slug' => 'vegetable-fruits','status' => 1,
            'meta_description' => '3 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            'description' => '3 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.'],
            ['id' => 4, 'name' => 'Snacks & Beverage', 'slug' => 'snacks-beverage','status' => 1,
            'meta_description' => '4 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            'description' => '4 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.'],

            // ------------------------------------------------------------------------------ //

            // RUN SEED AFTER ALL SEED... AND COMMENT THE UPPER PART OR YOUR SEED WILL BE WRONG

            // ------------------------------------------------------------------------------ //


            // ['id' => 5, 'category_id' => 1, 'name' => 'Beef', 'slug' => 'meat-fish-beef','status' => 1,
            // 'meta_description' => '5 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            // 'description' => '5 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.'],
            // ['id' => 6, 'category_id' => 1, 'name' => 'Chicken', 'slug' => 'meat-fish-chicken','status' => 1,
            // 'meta_description' => '6 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            // 'description' => '6 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.'],
            // ['id' => 7, 'category_id' => 2, 'name' => 'Beans', 'slug' => 'beans-dry-fruit-beans','status' => 1,
            // 'meta_description' => '7 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            // 'description' => '7 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.'],
            // ['id' => 8, 'category_id' => 2, 'name' => 'Dry Fruit', 'slug' => 'beans-dry-fruit-dry-fruit','status' => 1,
            // 'meta_description' => '8 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            // 'description' => '8 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.'],
            // ['id' => 9, 'category_id' => 4, 'name' => 'Namkin Chip', 'slug' => 'snacks-beverage-namkin-chip','status' => 1,
            // 'meta_description' => '9 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            // 'description' => '9 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.'],
            // ['id' => 10, 'category_id' => 4, 'name' => 'Ready to Eat', 'slug' => 'snacks-beverage-ready-to-eat','status' => 1,
            // 'meta_description' => '10 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            // 'description' => '10 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.'],
            // ['id' => 11, 'category_id' => 4, 'name' => 'Noodles', 'slug' => 'snacks-beverage-noodles','status' => 1,
            // 'meta_description' => '11 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, dicta.',
            // 'description' => '11 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum eaque illum eligendi assumenda nulla commodi incidunt aspernatur aliquam quidem! Quia labore, soluta nostrum perferendis velit corporis officiis eius doloremque necessitatibus ipsum ipsam, cupiditate esse non fuga magni doloribus itaque neque! Iusto pariatur explicabo minima, eveniet eum impedit culpa deleniti officia.']

        ];
        Category::insert($categoryRecords);
    }
}


