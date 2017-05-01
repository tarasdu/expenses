<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class PracticeController extends Controller
{

    public function practice3() {

        $transaction = new Transaction();

        $transactions = $transaction->where('category', '=', 'Groceries')
                                    ->orderBy('amount')
                                    ->get();

        dump($transactions->toArray());
    }

    public function practice2() {

        $transaction = new Transaction();

        $transactions = $transaction->all();

        dump($transactions->toArray());
    }


    public function practice1() {

        $transaction = new Transaction();

        $transaction->date = "2017-03-25";
        $transaction->amount = 10;
        $transaction->category = "Groceries";
        $transaction->description = "households";

        $transaction->save();

        dump($transaction);

    }

    /**
    * ANY (GET/POST/PUT/DELETE)
    * /practice/{n?}
    *
    * This method accepts all requests to /practice/ and
    * invokes the appropriate method.
    *
    */
    public function index($n = null) {
        # If no specific practice is specified, show index of all available methods
        if(is_null($n)) {
            foreach(get_class_methods($this) as $method) {
                if(strstr($method, 'practice'))
                echo "<a href='".str_replace('practice','/practice/',$method)."'>" . $method . "</a><br>";
            }
        }
        # Otherwise, load the requested method
        else {
            $method = 'practice'.$n;
            if(method_exists($this, $method))
            return $this->$method();
            else
            dd("Practice route [{$n}] not defined");
        }
    }
}
