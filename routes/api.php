<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('external-books', 'Api\BookController@getExternalBook');

Route::prefix('v1')->group(function () {
    Route::get('books', 'Api\BookController@books');
    Route::post('books', 'Api\BookController@createBook');
    Route::patch('books/{id}', 'Api\BookController@updateBook');
    Route::get('books/{id}', 'Api\BookController@showBook');
    Route::delete('books/{id}', 'Api\BookController@deleteBook');
});
