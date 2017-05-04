<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Transaction;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        $numberOfCategories = count($categories);

        for ($i=0; $i < 90; $i++) {

            $categoryId = rand(0, $numberOfCategories-2)+1;
            $amount = rand(1, 200);
            $day = rand(1, 28);
            $month = rand(1, 12);
            $year = 2016;
            $randomDate = date_create();
            date_date_set($randomDate, $year, $month, $day);
            $date = date_format($randomDate, 'Y-m-d');
            $description = "Note ".rand(1, 100);


            Transaction::insert([

                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                'date' => $date,
                'amount' => $amount,
                'category_id' => $categoryId,
                'description' => $description
            ]);

        }

    }
}
