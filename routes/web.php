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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('site.index');
Route::get('/fetch', [App\Http\Controllers\SiteController::class, 'fetch'])->name('site.fetch');
Auth::routes();
Route::get('/news/view/{id}', [App\Http\Controllers\SiteController::class, 'news'])->name('news.view');
Route::get('/news/catagory/{id}', [App\Http\Controllers\SiteController::class, 'catagoryNews'])->name('news.catagory');
Route::post('/news/comment/{id}', [App\Http\Controllers\SiteController::class, 'comment'])->name('news.comment');


Route::get('/admin/deshboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers'], function(){
    Route::middleware(['auth', 'verified'])->group(function() {
        Route::resource('catagories', 'CatagoryController');
        Route::resource('news', 'NewsController');
        Route::resource('comments', 'CommentController');
    });
});
