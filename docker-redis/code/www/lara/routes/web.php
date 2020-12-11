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

Route::get('/input', function () {return view('welcome'); });
Route::post('/upload', [App\Http\Controllers\HController::class, "upload"]);
Route::get('/ttt', [App\Http\Controllers\HController::class, "show"])->name('emails');
Route::get('/exel', [App\Http\Controllers\ExcelController::class, "import"]);
Route::get('/exelnow', [App\Http\Controllers\ExcelController::class, "importNow"]);
Route::get('/pusher', [App\Http\Controllers\HController::class, "showPusher"]);
Route::get('/', [App\Http\Controllers\HController::class, "showAll"]);
