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
        $numberOfCategories = $categories->count();

        for ($i=0; $i < 1000; $i++) {

            $categoryId = rand(1, $numberOfCategories);
            $amount = rand(1, 50);
            $endDate = Carbon::now()->timestamp;
            $startDate = Carbon::now()->subYears(2)->timestamp;
            $randomDate = rand($startDate, $endDate);
            $date = Carbon::createFromTimestamp($randomDate)->toDateString();
            $description = "Memo ".rand(1, 100);

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
