<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Transaction;

class ReportController extends Controller
{

    public function expenseReport()
    {

        $transaction = new Transaction();

        $transactionsByCategory = $transaction->all()->groupBy('category_id');

        $categories = Category::all();

        $sumByCategory = [];


        foreach ($transactionsByCategory as $categoryId => $transactionsGroup) {

            $category = $categories->where('id', $categoryId)->first();
            $sumByCategory[$category->name] = $transactionsGroup->sum('amount');
        }

        ksort($sumByCategory);
        $total = array_sum($sumByCategory);

        return view('reports.expense')->with([

            'sumByCategory' => $sumByCategory,
            'total' => $total,
        ]);


    }

}
