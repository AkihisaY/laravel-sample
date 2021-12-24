<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExpenseController;
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
Route::get('login', [LoginController::class,'index']);
Route::post('login', [LoginController::class,'login']);
//Logout
Route::get('logout', [LoginController::class,'logout']);
//Reset Login
Route::get('reset', [LoginController::class,'reset']);
//Error
Route::get('error', [LoginController::class,'error']);
//Time Out
Route::get('timeout', [LoginController::class,'timeout']);
//Create/Edit Login
Route::get('login/add', [LoginController::class,'create']);
Route::post('login/create', [LoginController::class,'insert']);

Route::get('top', [TopController::class,'index']);
//Add Asset
Route::get('top/add', [TopController::class,'create']);
Route::post('top/add', [TopController::class,'insert']);
Route::get('top/delete', [TopController::class,'delete']);

//Api
Route::get('get_api', [ApiController::class,'getApi']);
Route::get('api', [ApiController::class,'index']);
Route::post('api/create', [ApiController::class,'create']);
Route::post('api/delete', [ApiController::class,'delete']);
Route::post('api/recover', [ApiController::class,'recover']);

//Document
// Route::get('document', 'App\Http\Controllers\DocumentController@index');
Route::get('document', [DocumentController::class,'index']);

//Expense
// Route::post('expense/csv', 'App\Http\Controllers\ExpenseController@import');
Route::get('expense', [ExpenseController::class,'index']);
Route::get('expense/csv', [ExpenseController::class,'csv']);
Route::post('expense/csv', [ExpenseController::class,'import']);

//Ajax
//Chart JS
Route::get('top/stocks', [TopController::class,'stocks']);
Route::get('top/assets', [TopController::class,'totalAsset']);
Route::get('top/month_assets', [TopController::class,'monthAssets']);