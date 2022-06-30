<?php

use Illuminate\Support\Facades\Auth;
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



Route::controller(\App\Http\Controllers\HomeController::class)->group(function (){
    Route::get('/','index')->name('app');
    Route::get('post/{id}','index');
    Route::get('create','index');
});
Route::get('/qwerty',function (){
    echo url('/api/auth/login');
});
Auth::routes();

