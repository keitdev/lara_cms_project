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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Protected by Admin Portal 
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'admin']], function() {
    Route::resource('dashboard', DashboardController::class)->only([
        'index'
    ]);
    Route::resources([
        'post' => PostController::class,
        'tag' => TagController::class,
        'categorie' => CategorieController::class,
        'page' => PageController::class,
        'comment' => CommentController::class,
        'user' => UserController::class,
    ]);
});
