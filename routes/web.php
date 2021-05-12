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
    return view('home.home');
})->name('home');

Route::resource('post', 'PostController');
Route::resource('contacts', 'ContactController'); // aca estan los rutamientos para llamar a los metodos
Route::group(['prefix' => 'post'], function(){
    //En sector creamos toas las vistas que necesitemas
    //tal cual como se ve la opcion de busqueda
    Route::post('search', 'PostController@search')->name('post.search');


});
/*post es un identificador*/
Route::resource('category', 'CategoryController');
Route::group(['prefix' => 'category'], function () {
    Route::post('search','CategoryController@search')->name('category.search');
});
