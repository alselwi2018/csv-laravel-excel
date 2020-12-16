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

Route::get('export', 'Wrencsv@export')->name('export');
Route::get('/', 'Wrencsv@importExport');
Route::post('import', 'Wrencsv@import')->name('import');
Route::get('delete', 'Wrencsv@deleteAll')->name('delete');
