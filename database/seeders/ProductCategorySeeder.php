<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create(['title' => 'Category 1', 'desc' => 'desc for Category 1']);
        SubCategory::create(['title' => 'Category 2', 'desc' => 'desc for Category 2']);
        SubCategory::create(['title' => 'Category 3', 'desc' => 'desc for Category 3']);
        SubCategory::create(['title' => 'Category 1', 'desc' => 'desc for Category 1']);
        SubCategory::create(['title' => 'Category 2', 'desc' => 'desc for Category 2']);
        SubCategory::create(['title' => 'Category 3', 'desc' => 'desc for Category 3']);

        SubCategory::create(['title' => 'Category 1', 'desc' => 'desc for Category 1']);
        SubCategory::create(['title' => 'Category 2', 'desc' => 'desc for Category 2']);
        SubCategory::create(['title' => 'Category 3', 'desc' => 'desc for Category 3']);

        SubCategory::create(['title' => 'Category 1', 'desc' => 'desc for Category 1']);
        SubCategory::create(['title' => 'Category 2', 'desc' => 'desc for Category 2']);
        SubCategory::create(['title' => 'Category 3', 'desc' => 'desc for Category 3']);

        SubCategory::create(['title' => 'Category 1', 'desc' => 'desc for Category 1']);
        SubCategory::create(['title' => 'Category 2', 'desc' => 'desc for Category 2']);
        SubCategory::create(['title' => 'Category 3', 'desc' => 'desc for Category 3']);


    }
}
