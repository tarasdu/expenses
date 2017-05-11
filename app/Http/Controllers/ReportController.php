<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Transaction;
use Carbon\Carbon;

class ReportController extends Controller
{

    public function expenseReport(Request $request)
    {

        if ($request->exists(['startDate', 'endDate'])) {

            $this->validate($request, [
                'startDate' => 'required|date',
                'endDate' => 'required|date|after_or_equal:startDate',
            ]);
        }

        $startDate = $request->input('startDate', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('endDate', Carbon::now()->toDateString());

        $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->get();

        $transactionsByCategory = $transactions->groupBy('category_id');

        $categories = Category::all();

        $sumByCategory = [];


        foreach ($transactionsByCategory as $categoryId => $transactionsList) {

            $category = $categories->where('id', $categoryId)->first();
            $sumByCategory[$category->name] = $transactionsList->sum('amount');
        }

        ksort($sumByCategory);
        $total = array_sum($sumByCategory);

        return view('reports.expense')->with([

            'categories' => $categories,
            'sumByCategory' => $sumByCategory,
            'total' => $total,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);

    }

}
