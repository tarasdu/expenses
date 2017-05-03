<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Groceries', 'Clothes', 'Auto', 'Utilities', 'Home improvements', 'Other'];

        foreach ($categories as $category) {

            Category::insert([
                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                'name' => $category,
            ]);

        }
    }
}
