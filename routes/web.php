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
Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::get('/','SiteController@index')->name('site.index');
    Route::get('/fetch', 'SiteController@fetch')->name('site.fetch');
    Route::get('/news/view/{id}', 'SiteController@news')->name('news.view');
    Route::get('/news/catagory/{id}', 'SiteController@catagoryNews')->name('news.catagory');
    Route::post('/news/comment/{id}', 'SiteController@comment')->name('news.comment');

});

Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers'], function(){
    Route::middleware(['auth', 'verified'])->group(function() {
        Route::resource('catagories', 'CatagoryController');
        Route::resource('news', 'NewsController');
        Route::resource('comments', 'CommentController');
    });
});
