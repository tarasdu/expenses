<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Transaction;

class TagTransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = Transaction::all();
        $tags = Tag::all();
        $numberOfTags = $tags->count();

        foreach ($transactions as $transaction) {
            $nubmerOfTagsForTransaction = rand(0, $numberOfTags);
            $tagsForTransaction = collect([]);
            for ($i=0; $i < $nubmerOfTagsForTransaction; $i++) {
                $tag = $tags->random();
                if (!$tagsForTransaction->contains($tag)) {
                    $transaction->tags()->save($tag);
                    $tagsForTransaction->push($tag);
                }
            }
        }


    }
}
