<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\LiveController;

use App\Http\Controllers\PageController;



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

Route::get('/', [IndexController::class, 'index']);
Route::get('/main', [PageController::class, 'main'])->name('main');
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/playlist', [PageController::class, 'playlist'])->name('playlist');

Route::post('/set-playlist', [PageController::class, 'setPlaylist']);


Route::get('/db_insert', [DataController::class, 'createData']);
