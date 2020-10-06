<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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
})->name('home');
Route::post('/post/new', [Postcontroller::class, 'post'])->name('post');
//password
Route::post('/v/password', [Postcontroller::class, 'password'])->name('password');
//deleter
Route::post('/v/delete', [Postcontroller::class, 'delete'])->name('delete');
//viewer
Route::get('/v/{id}', [Postcontroller::class, 'view'])->name('view');