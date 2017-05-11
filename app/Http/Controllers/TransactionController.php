<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Transaction;
use Session;

class TransactionController extends Controller
{
    public function index(Request $request) {


        $startDate = ($request->startDate) ? : null;
        $endDate = ($request->endDate) ? : null;
        $categoriesForFilter = ($request->categories) ? : null;
        $tagsForFilter = ($request->tags) ? : null;
        $isRequest = (!$request->all()) ? false : true;
        $categoryIds = [];
        $tagsNames = [];

        if ($startDate || $endDate) {
            $this->validate($request, [
                'startDate' => 'date|nullable',
                'endDate' => 'date|after_or_equal:startDate|nullable',
            ]);
        }

        $categories = Category::orderBy('name', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();

        if ($categories->count() == 0) {
            return redirect('/categories');
        }

        if (!$isRequest) {
            $transactions = Transaction::with('category', 'tags')->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        }
        else {
            if ($tagsForFilter) {

                $tagsNames = array_keys($tagsForFilter);
                if ($startDate && $endDate) {
                    $transactions = Transaction::with('category', 'tags')->whereHas('tags', function($tags) use($tagsNames) {
                        $tags->whereIn('name', $tagsNames);
                    })->whereBetween('date', [$startDate, $endDate])->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
                }
                elseif ($startDate) {
                    $transactions = Transaction::with('category', 'tags')->whereHas('tags', function($tags) use($tagsNames) {
                        $tags->whereIn('name', $tagsNames);
                    })->where('date', '>=', $startDate)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
                }
                elseif ($endDate) {
                    $transactions = Transaction::with('category', 'tags')->whereHas('tags', function($tags) use($tagsNames) {
                        $tags->whereIn('name', $tagsNames);
                    })->where('date', '<=', $endDate)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
                }
                else {
                    $transactions = Transaction::with('category', 'tags')->whereHas('tags', function($tags) use($tagsNames) {
                        $tags->whereIn('name', $tagsNames);
                    })->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
                }
            }
            else {
                if ($startDate && $endDate) {
                    $transactions = Transaction::with('category', 'tags')->whereBetween('date', [$startDate, $endDate])->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
                }
                elseif ($startDate) {
                    $transactions = Transaction::with('category', 'tags')->where('date', '>=', $startDate)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
                }
                elseif ($endDate) {
                    $transactions = Transaction::with('category', 'tags')->where('date', '<=', $endDate)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
                }
                else {
                    $transactions = Transaction::with('category', 'tags')->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
                }
            }
        };

        if ($categoriesForFilter) {

            $categoryIds = array_keys($categoriesForFilter);
            $transactions = $transactions->whereIn('category_id', $categoryIds);
        };



        return view('transactions.index')->with([

            'transactions' => $transactions,
            'categories' => $categories,
            'tags' => $tags,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'categoryIds' => $categoryIds,
            'tagsNames' => $tagsNames,
            'isRequest' => $isRequest,

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
            'description' => 'nullable|string',
            'newTag' => 'nullable|string'
        ]);

        $transaction = new Transaction();
        $transaction->date = $request->date;
        $transaction->amount = $request->amount;
        $transaction->category_id = $request->category_id;
        $transaction->description = $request->description;
        $transaction->save();

        if($request->tags) {
            $tags = array_keys($request->tags);
        }
        else {
            $tags = [];
        }

        if ($request->newTag) {
            $newTag = new Tag();
            $newTag->name = $request->newTag;
            $transaction->tags()->sync($tags);
            $transaction->tags()->save($newTag);
        }
        else
        {
            $transaction->tags()->sync($tags);
            $transaction->save();
        }

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

    public function saveChanges(Request $request) {

        $this->validate($request, [
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'category_id' => 'not_in:0',
            'description' => 'nullable|string',
            'newTag' => 'nullable|string'
        ]);

        $transaction = Transaction::find($request->id);
        $transaction->date = $request->date;
        $transaction->amount = $request->amount;
        $transaction->category_id = $request->category_id;
        $transaction->description = $request->description;

        if($request->tags) {
            $tags = array_keys($request->tags);
        }
        else {
            $tags = [];
        }

        if ($request->newTag) {
            $newTag = new Tag();
            $newTag->name = $request->newTag;
            $transaction->tags()->sync($tags);
            $transaction->tags()->save($newTag);
        }
        else
        {
            $transaction->tags()->sync($tags);
            $transaction->save();
        }

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
