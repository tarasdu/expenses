<?php

Route::get('/', 'TransactionController@index');

Route::get('/transactions/new', 'TransactionController@new');

Route::post('/transactions/new', 'TransactionController@addNewTransaction');

Route::get('/transactions/edit/{id}', 'TransactionController@edit');

Route::post('/transactions/edit', 'TransactionController@saveChanges');

Route::post('/transactions/delete', 'TransactionController@delete');


Route::get('/categories', 'CategoryController@index');

Route::post('/categories/new', 'CategoryController@addCategory');

Route::post('/categories/edit', 'CategoryController@editCategory');

Route::post('/categories/delete', 'CategoryController@delete');


Route::get('/report', 'ReportController@expenseReport');


if(App::environment('local')) {

    Route::get('/drop', function() {

        DB::statement('DROP database expenses');
        DB::statement('CREATE database expenses');

        return 'Dropped expenses; created expenses.';
    });

};
