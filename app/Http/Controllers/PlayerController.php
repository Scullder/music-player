<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;

class PlayerController extends Controller
{
  public function setPlaylist(Request $request)
  {
    $request->session()->put('playlist_id', $request->playlist_id);
    $request->session()->put('song_id', $request->song_id);

    $songs = Playlist::find($request->playlist_id)->songs;
    // массив для хранения только ссылок на песни из выбраного плейлиста
    $playlist = array();
    foreach($songs as $song)
      $playlist[] = $song->url;

    $index = array_search($request->url, $playlist);

    return json_encode(['url' => $request->url, 'playlist' => $playlist, 'index' => $index]);
  }
}
