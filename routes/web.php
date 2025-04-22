<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fetch-data', [App\Http\Controllers\ScrapController::class, 'insertDataIntoNews']);

Route::get('news/update', [App\Http\Controllers\ScrapController::class, 'NewsUpdate'])->name('admin.news.update');

Route::get('image/update', [App\Http\Controllers\ScrapController::class, 'ImageUpdate'])->name('admin.image.update');

require __DIR__.'/admin.php';
