<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Transaction;
use Validator;


class PracticeController extends Controller
{

    public function link(Request $request)
    {
        dump($request->startDate);
        dump($request->endDate);
        dump($request->categories);
        dump($request->tags);
    }

    public function dropdown(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();

        return view('test')->with([
            'categories' => $categories,
            'tags' => $tags
        ]);
    }


    public function ajax(Request $request)
    {

            $validator = Validator::make($request->all(), [
                'categoryName' => 'required|alpha',
            ]);

            if ($validator->fails()) {

                $errors = $validator->errors();
                return response()->json([
                    $errors->first()
                ], 422);
            }

            /*$this->validate($request, [
                'categoryName' => 'required|alpha_dash',
            ]);*/



            return response()->json(['feedback' => 'This is post method', 'aa' => 'another response']);


    }

    public function practice4() {

        $categories = Category::all();
        $numberOfCategories = count($categories);

        for ($i=0; $i < 90; $i++) {

            $categoryId = rand(0, $numberOfCategories-1)+1;
            $amount = rand(1, 200);
            $day = rand(1, 28);
            $month = rand(1, 12);
            $year = 2016;
            $randomDate = date_create();
            date_date_set($randomDate, $year, $month, $day);
            $date = date_format($randomDate, 'Y-m-d');
            $description = "Note ".rand(1, 100);


            Transaction::insert([

                'date' => $date,
                'amount' => $amount,
                'category_id' => $categoryId,
                'description' => $description
            ]);

        }



    }

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
