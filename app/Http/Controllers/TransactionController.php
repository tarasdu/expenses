<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Transaction;
use Session;

class TransactionController extends Controller
{
    public function index() {

        $transaction = new Transaction();

        $transactions = $transaction->with('category')->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        #dd($transactions->toArray());

        return view('transactions.index')->with([

            'transactions' => $transactions,

        ]);
    }

    public function new() {

        # Get all the categories
        $categories = Category::orderBy('name', 'ASC')->get();

        # Organize the categories into an array where the key = category id and value = category name
        $categoriesForDropdown = [];
        foreach($categories as $category) {
            $categoriesForDropdown[$category->id] = $category->name;
        }

        return view('transactions.new')->with([
            'categoriesForDropdown' => $categoriesForDropdown,
        ]);

    }

    public function addNewTransaction(Request $request) {

        $this->validate($request, [
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'category_id' => 'not_in:0',
            'description' => 'nullable'
        ]);
        # Add new book to database
        $transaction = new Transaction();
        $transaction->date = $request->date;
        $transaction->amount = $request->amount;
        $transaction->category_id = $request->category_id;
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

        # Get all the categories
        $categories = Category::orderBy('name', 'ASC')->get();

        # Organize the categories into an array where the key = category id and value = category name
        $categoriesForDropdown = [];
        foreach($categories as $category) {
            $categoriesForDropdown[$category->id] = $category->name;
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
            'transaction' => $transaction,
            'categoriesForDropdown' => $categoriesForDropdown,
        ]);


    }

    public function saveEdits(Request $request) {

        $this->validate($request, [
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'category_id' => 'not_in:0',
            'description' => 'nullable'
        ]);

        $transaction = Transaction::find($request->id);
        # Edit transaction in the database
        $transaction->date = $request->date;
        $transaction->amount = $request->amount;
        $transaction->category_id = $request->category_id;
        $transaction->description = $request->description;

        $transaction->save();
        Session::flash('message', 'Your changes were saved.');
        return redirect('/');
    }

    public function delete(Request $request) {
        # Get the book to be deleted
        $transaction = Transaction::find($request->id);
        if(!$transaction) {
            Session::flash('message', 'Deletion failed; book not found.');
            return redirect('/');
        }

        $transaction->delete();
        # Finish
        Session::flash('message', 'Transaction was deleted.');
        return redirect('/');
    }
}
