<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Session;

class TransactionController extends Controller
{
    public function index() {

        $transaction = new Transaction();

        $transactions = $transaction->orderBy('date', 'desc')->get();
        #dd($transactions->toArray());

        return view('transactions.index')->with([

            'transactions' => $transactions,

        ]);
    }

    public function new() {

        return view('transactions.new');

    }

    public function addNewTransaction(Request $request) {

        $this->validate($request, [
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'category' => 'required|alpha',
            'description' => 'required'
        ]);
        # Add new book to database
        $transaction = new Transaction();
        $transaction->date = $request->date;
        $transaction->amount = $request->amount;
        $transaction->category = $request->category;
        $transaction->description = $request->description;
        $transaction->save();

        Session::flash('message', 'The transaction was added.');
        # Redirect the user to book index
        return redirect('/');
    }

    public function edit($id) {



        $transaction = Transaction::find($id);
        if(is_null($transaction)) {
            Session::flash('message', 'The book you requested was not found.');
            return redirect('/');
        }
        #$authorsForDropdown = Author::getAuthorsForDropdown();
        #$tagsForCheckboxes = Tag::getTagsForCheckboxes();
        # Create a simple array of just the tag names for tags associated with this book;
        # will be used in the view to decide which tags should be checked off
        #$tagsForThisBook = [];
        #foreach($book->tags as $tag) {
        #    $tagsForThisBook[] = $tag->name;
        #}
        # Results in an array like this: $tagsForThisBook => ['novel','fiction','classic'];


        return view('transactions.edit')->with([
            'id' => $id,
            'transaction' => $transaction,
        ]);


    }

    public function saveEdits(Request $request) {

        $this->validate($request, [
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'category' => 'required|alpha',
            'description' => 'required'
        ]);

        $transaction = Transaction::find($request->id);
        # Edit transaction in the database
        $transaction->date = $request->date;
        $transaction->amount = $request->amount;
        $transaction->category = $request->category;
        $transaction->description = $request->description;

        $transaction->save();
        Session::flash('message', 'Your changes were saved.');
        return redirect('/');
    }
}
