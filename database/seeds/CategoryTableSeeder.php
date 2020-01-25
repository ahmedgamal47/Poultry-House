<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $category = new Category();
            $category->name = 'تصنيف ' . $i;
            $category->image = Category::defaultImage();
            $category->save();
        }
    }
}
