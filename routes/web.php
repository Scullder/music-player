<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DataController;

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
Route::get('/playlists', [PageController::class, 'allPlaylists']);
Route::get('/playlist/{id}', [PageController::class, 'playlist'])->name('playlist');

Route::post('/set-playlist', [PageController::class, 'setPlaylist']);


Route::get('/create-data', [DataController::class, 'createData']);
