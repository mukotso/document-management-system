<?php



Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Support\Facades\Route;

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
