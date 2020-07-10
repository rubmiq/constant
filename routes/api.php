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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/addCategories', 'Categories@create');
Route::put('/updateCategory', 'Categories@update');
Route::put('/set_sort', 'Categories@set_sort');
Route::put('/set_main_sort', 'Categories@set_main_sort');
Route::delete('/addCategories', 'Categories@delete');
Route::get('/getCategories', 'Categories@index');
Route::get('/edit/{id}', 'Categories@edit');

