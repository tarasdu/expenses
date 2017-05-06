<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Transaction;
use Carbon\Carbon;

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

        for ($i=0; $i < 1000; $i++) {

            $categoryId = rand(0, $numberOfCategories-1)+1;
            $amount = rand(1, 50);
            $endDate = Carbon::now()->timestamp;
            $startDate = Carbon::now()->subYears(2)->timestamp;
            $randomDate = rand($startDate, $endDate);
            $date = Carbon::createFromTimestamp($randomDate)->toDateString();
            $description = "Note ".rand(1, 100);


            Transaction::insert([

                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
                'date' => $date,
                'amount' => $amount,
                'category_id' => $categoryId,
                'description' => $description
            ]);

        }

    }
}
