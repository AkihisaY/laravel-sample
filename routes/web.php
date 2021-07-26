<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Login
Route::get('login', 'App\Http\Controllers\LoginController@index');
Route::post('login', 'App\Http\Controllers\LoginController@login');
//Logout
Route::get('logout', 'App\Http\Controllers\LoginController@logout');
//Reset Login
Route::get('reset', 'App\Http\Controllers\LoginController@reset');
//Error
Route::get('error', 'App\Http\Controllers\LoginController@error');
//Time Out
Route::get('timeout', 'App\Http\Controllers\LoginController@timeout');
//Create/Edit Login
Route::get('login/add', 'App\Http\Controllers\LoginController@create');
Route::post('login/create', 'App\Http\Controllers\LoginController@insert');

Route::get('top', 'App\Http\Controllers\TopController@index');
//Add Asset
Route::get('top/add', 'App\Http\Controllers\TopController@create');
Route::post('top/add', 'App\Http\Controllers\TopController@insert');
Route::get('top/delete', 'App\Http\Controllers\TopController@delete');

//Api
Route::get('get_api', 'App\Http\Controllers\ApiController@getApi');
Route::get('api', 'App\Http\Controllers\ApiController@index');
Route::post('api/create', 'App\Http\Controllers\ApiController@create');
Route::post('api/delete', 'App\Http\Controllers\ApiController@delete');
Route::post('api/recover', 'App\Http\Controllers\ApiController@recover');

//Document
Route::get('document', 'App\Http\Controllers\DocumentController@index');

//Expense
Route::get('expense', 'App\Http\Controllers\ExpenseController@index');

//Ajax
//Chart JS
Route::get('top/stocks', 'App\Http\Controllers\TopController@stocks');
Route::get('top/assets', 'App\Http\Controllers\TopController@totalAsset');
Route::get('top/month_assets', 'App\Http\Controllers\TopController@monthAssets');
