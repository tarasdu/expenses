<?php

use Illuminate\Database\Seeder;
use App\Category;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Dining', 'Education', 'Groceries', 'Clothes', 'Auto', 'Utilities', 'Home improvements', 'Medical',
                        'Travel', 'Recreation', 'Taxes', 'Vacation', 'Other'];

        foreach ($categories as $category) {

            Category::insert([
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
                'name' => $category,
            ]);

        }
    }
}
