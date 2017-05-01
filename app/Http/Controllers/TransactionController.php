<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
    public function index() {

        $transaction = new Transaction();

        $transactions = $transaction->orderBy('date', 'desc')->get();
        #dd($transactions->toArray());

        return view('transactions/index')->with([

            'transactions' => $transactions,

        ]);
    }
}
