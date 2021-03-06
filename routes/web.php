<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Client;

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
/*  
Route::get('/', function () {
    return view('welcome');
});  */


Route::get('/','ResultController@getData');
Route::get('/update', 'ResultController@viewUpdate');
Route::get('/export', 'ResultController@getReport');