<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::get('/{any}', function () {
//    return view('welcome');
//})->where('any', '.*');

Route::post('login', 'API\Auth\LoginController@login');
Route::post('logout', 'API\Auth\LoginController@logout');
Route::post('register', 'API\Auth\RegisterController@register');


Route::get('departments', 'API\DepartmentsController@index');
//Route::group(['middleware' => 'auth:api'], function () {
//departments
Route::post('departments/create', 'API\DepartmentsController@store');
Route::get('departments/{department}', 'API\DepartmentsController@show');
Route::put('departments/update/{department}', 'API\DepartmentsController@update');
Route::delete('departments/delete/{department}', 'API\DepartmentsController@destroy');

//categories
Route::get('categories', 'API\CategoriesController@index');
Route::post('categories/create', 'API\CategoriesController@store');
Route::put('categories/update/{category}', 'API\CategoriesController@update');
Route::delete('categories/delete/{category}', 'API\CategoriesController@destroy');

//users
Route::get('users', 'API\UsersController@index');
Route::post('users/create', 'API\UsersController@store');
Route::put('users/update/{user}', 'API\UsersController@update');
Route::delete('users/delete/{user}', 'API\UsersController@destroy');

//Documents
Route::get('documents', 'API\DocumentsController@index');
Route::post('documents/create', 'API\DocumentsController@store');
Route::put('documents/update/{document}', 'API\DocumentsController@update');
Route::delete('documents/delete/{document}', 'API\DocumentsController@destroy');


//DocumentsAccessRequests
Route::get('document-access-requests', 'API\DocumentAccessRequestsController@index');
Route::post('document-access-requests/create', 'API\DocumentAccessRequestsController@store');
Route::put('document-access-requests/update/{documentAccessRequest}', 'API\DocumentAccessRequestsController@update');
Route::delete('document-access-requests/delete/{documentAccessRequest}', 'API\DocumentAccessRequestsController@destroy');
//});


