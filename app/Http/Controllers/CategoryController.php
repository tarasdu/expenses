<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use Validator;
use Auth;

class CategoryController extends Controller
{
    public function index(Request $request) {

        $user = $request->user();

        $category = new Category();
        $categories = $category->where('user_id', '=', $user->id)->orderBy('name', 'asc')->get();

        return view('categories.list')->with([

            'categories' => $categories,

        ]);
    }

    public function addCategory(Request $request) {

        $validator = Validator::make($request->all(), [
            'categoryName' => 'required|string',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();
            return response()->json([
                $errors->first()
            ], 422);
        }

        $category = new Category();
        $user = Auth::user();

        $category->name = $request->categoryName;
        $category->user_id = $user->id;
        $category->save();


        Session::flash('message', 'Category "'.$request->categoryName.'" was added.');

        return;
    }

    public function editCategory(Request $request) {

        $validator = Validator::make($request->all(), [
            'categoryName' => 'required|string',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();
            return response()->json([
                $errors->first()
            ], 422);
        }

        $category = Category::find($request->id);

        $category->name = $request->categoryName;
        $category->save();


        Session::flash('message', 'Your changes were saved.');

        return;
    }

    public function delete(Request $request) {

        $category = Category::find($request->id);

        if(!$category) {
            Session::flash('message', 'Deletion failed; category not found.');
            return redirect('/categories');
        }

        if ($category->transactions()->first()) {
            Session::flash('failure', 'Deletion failed; category "'.$category->name.'" has transactions; delete transactions first.');
            return redirect('/categories');
        }
        else {
            $category->delete();
            Session::flash('message', 'Category "'.$category->name.'" was deleted.');
            return redirect('/categories');
        }

    }
}
