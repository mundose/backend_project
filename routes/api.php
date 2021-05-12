<?php

use App\Http\Controllers\PostController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'category'], function () {
    Route::get('list', 'CategoryController@list');
    Route::post('create', 'CategoryController@save');
});

//Route::group (['post', PostController])


Route::group(['prefix' => 'contact'], function () {
    Route::get('list', 'ContactController@list');
    Route::post('store', 'ContactController@store'); // en este caso store hace de create
});
