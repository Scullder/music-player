<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PlayerController;


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

//Route::get('/', [IndexController::class, 'index']);

// переход по страницам сайта(подключение через AJAX)
Route::controller(PageController::class)->group(function () {
    Route::get('/main', 'main')->name('main');
    Route::get('/home', 'home')->name('home');
    Route::get('/playlists', 'allPlaylists');
    Route::get('/playlist/{id}', 'playlist')->name('playlist');
    Route::get('/user-playlist', 'userPlaylist')->name('userPlaylist');
});

// изменение плейлиста
Route::post('/set-playlist', [PlayerController::class, 'set']);
Route::get('/update-playlist', [PlayerController::class, 'update']);

// добавление данных в БД
Route::get('/create-data', [DataController::class, 'createData']);
Route::get('/update-playlist-image', [DataController::class, 'updateImages']);
Route::get('/update-songs-posters', [DataController::class, 'updatePosters']);
