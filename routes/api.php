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
Route::get('logout', 'API\Auth\LoginController@logout');
Route::post('register', 'API\Auth\RegisterController@register');


Route::get('departments', 'API\DepartmentsController@index');

//Route::group(['middleware' => 'auth:api'], function () {
//departments
Route::post('departments/create', 'API\DepartmentsController@store');
Route::get('department-documents/{department}', 'API\DocumentsController@filterDepartmentDocuments');
Route::get('departments/{department}', 'API\DepartmentsController@');
Route::put('departments/update/{department}', 'API\DepartmentsController@update');
Route::delete('departments/delete/{department}', 'API\DepartmentsController@destroy');

//categories
Route::get('categories', 'API\CategoriesController@index');
Route::get('categories/{category}', 'API\CategoriesController@show');
Route::post('categories/create', 'API\CategoriesController@store');
Route::put('categories/update/{category}', 'API\CategoriesController@update');
Route::delete('categories/delete/{category}', 'API\CategoriesController@destroy');

//users
Route::get('users', 'API\UsersController@index');
Route::get('users/{user}', 'API\UsersController@show');
Route::post('users/create', 'API\UsersController@store');
Route::put('users/update/{user}', 'API\UsersController@update');
Route::delete('users/delete/{user}', 'API\UsersController@destroy');
Route::get('/users/roles/{id}', 'API\UsersController@getUserPermissions');



Route::get('/analytics', 'API\AnalyticsController@analytics');

//Documents
Route::get('documents', 'API\DocumentsController@index');
Route::post('document-access-request/create', 'API\DocumentsController@storeAccessRequest');
Route::Delete('access-request-documents/delete/{document}', 'API\DocumentsController@DestroyAccessRequest');
Route::get('documents-history', 'API\DocumentsController@history');
Route::get('documents-download/{document}', 'API\DocumentsController@download');
Route::post('documents/create', 'API\DocumentsController@store');
Route::put('documents/update/{document}', 'API\DocumentsController@update');
Route::delete('documents/delete/{document}', 'API\DocumentsController@destroy');
Route::get('my-access-requests-documents/{id}', 'API\DocumentsController@myAccessRequest');
Route::post('/documents-access-request/approve/', 'API\DocumentsController@approveAccessRequest');
Route::post('/documents-access-request/reject-approval', 'API\DocumentsController@rejectAccessRequest');
Route::get('/temporary-documents/{id}', 'API\DocumentsController@getTemporaryDocuments');

//DocumentsAccessRequests
Route::get('document-access-requests', 'API\DocumentAccessRequestsController@index');
Route::post('document-access-requests/create', 'API\DocumentAccessRequestsController@store');
Route::put('document-access-requests/update/{documentAccessRequest}', 'API\DocumentAccessRequestsController@update');
Route::delete('document-access-requests/delete/{documentAccessRequest}', 'API\DocumentAccessRequestsController@destroy');
//});


