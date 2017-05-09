<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Transaction;
use Session;

class TransactionController extends Controller
{
    public function index() {

        $transaction = new Transaction();

        $transactions = $transaction->with('category', 'tags')->orderBy('date', 'desc')->orderBy('id', 'desc')->get();

        return view('transactions.index')->with([

            'transactions' => $transactions,

        ]);
    }

    public function new() {

        $categoriesForDropdown = Category::getCategoriesForDropdown();
        $tagsForCheckboxes = Tag::getTagsForCheckboxes();

        return view('transactions.new')->with([
            'categoriesForDropdown' => $categoriesForDropdown,
            'tagsForCheckboxes' => $tagsForCheckboxes,
        ]);

    }

    public function addNewTransaction(Request $request) {

        $this->validate($request, [
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'category_id' => 'not_in:0',
            'description' => 'nullable'
        ]);

        $transaction = new Transaction();
        $transaction->date = $request->date;
        $transaction->amount = $request->amount;
        $transaction->category_id = $request->category_id;
        $transaction->description = $request->description;
        $transaction->save();

        $tags = ($request->tags) ?: [];
        $transaction->tags()->sync($tags);
        $transaction->save();

        Session::flash('message', 'The transaction was added.');

        return redirect('/');
    }

    public function edit($id) {



        $transaction = Transaction::with('tags')->find($id);
        if(is_null($transaction)) {
            Session::flash('message', 'Transaction was not found.');
            return redirect('/');
        }

        $categoriesForDropdown = Category::getCategoriesForDropdown();
        $tagsForCheckboxes = Tag::getTagsForCheckboxes();


        $tagsForThisTransaction = [];
        foreach($transaction->tags as $tag) {
            $tagsForThisTransaction[] = $tag->name;
        }



        return view('transactions.edit')->with([
            'transaction' => $transaction,
            'categoriesForDropdown' => $categoriesForDropdown,
            'tagsForCheckboxes' => $tagsForCheckboxes,
            'tagsForThisTransaction' => $tagsForThisTransaction,
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

        if($request->tags) {
            $tags = $request->tags;
        }
        else {
            $tags = [];
        }

        $transaction->tags()->sync($tags);
        $transaction->save();

        Session::flash('message', 'Your changes were saved.');
        return redirect('/');
    }

    public function delete(Request $request) {

        $transaction = Transaction::find($request->id);
        if(!$transaction) {
            Session::flash('message', 'Deletion failed; transaction not found.');
            return redirect('/');
        }

        $transaction->tags()->detach();

        $transaction->delete();

        Session::flash('message', 'Transaction was deleted.');
        return redirect('/');
    }
}
