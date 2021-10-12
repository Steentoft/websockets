<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [App\Http\Controllers\BaseController::class, 'index'])->name('index');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource("dashboard", '\App\Http\Controllers\DashboardController');
//Route::resource("contacts", '\App\Http\Controllers\ContactsController');
//Route::resource("dashboard", '\App\Http\Controllers\MessagesController');
//Route::resource("dashboard", '\App\Http\Controllers\RequestsController');

Auth::routes();

