<?php

use App\Http\Controllers\LinkController;
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

Route::get('links', [LinkController::class, 'index'])->name('index_link');
Route::get('/', [LinkController::class, 'create'])->name('create_link');
Route::post('/', [LinkController::class, 'store'])->name('store_link');
Route::get('links/{link}', [LinkController::class, 'show'])->name('show_link');
Route::get('{uri}', [LinkController::class, 'visit'])->where('uri', '.+')->name('visit_link');
