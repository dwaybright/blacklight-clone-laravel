<?php

use App\Http\Controllers\BlacklightController;
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

Route::get('/', [BlacklightController::class, 'show'])->name('home');

Route::get('/search', [BlacklightController::class, 'search'])->name('blacklight.search');

Route::get('/catalog/{solrDocumentId}', [BlacklightController::class, 'catalog'])->whereAlphaNumeric('solrDocumentId')->name('blacklight.catalog');
