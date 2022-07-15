<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;

class PlayerController extends Controller
{
  public function setPlaylist(Request $request)
  {
    $song = Song::find($request->song_id);
    $playlist = Playlist::find($request->playlist_id)->songs;

    // формирования плейлиста(массив с ссылками на песни)
    $playlistUrl = array();
    foreach($playlist as $song)
      $playlistUrl[] = $song->url;

    // индекс выбранной песни
    $index = array_search($song->url, $playlistUrl);

    $request->session()->put('playlist_id', $request->playlist_id);
    $request->session()->put('song_id', $request->song_id);

    $content = json_encode(['url' => $request->url,
                            'playlist' => $playlistUrl,
                            'index' => $index,
                            'songTitle' => $song->title,
                            'poster' => $song->poster]);

    return response($content)->withCookie(cookie('last_song', $request->song_id, 60 * 24 * 30))
                             ->withCookie(cookie('last_playlist', $request->playlist_id, 60 * 24 * 30));
  }

  public function set(Request $request)
  {
    $song = Song::find($request->song_id);
    $songs = Playlist::find($request->playlist_id)->songs;

    $songsArray = $songs->toArray();
    $index = $this->createIndexFromZero($songsArray, $request->song_id);

    $content = json_encode(['url' => $request->url,
                            'songs' => $songs->toJson(),
                            'index' => $index,
                            'songTitle' => $song->title,
                            'poster' => $song->poster]);

    $request->session()->put('playlist_id', $request->playlist_id);
    $request->session()->put('song_id', $request->song_id);

    return response($content)->withCookie(cookie('last_song', $request->song_id, 60 * 24 * 30))
                             ->withCookie(cookie('last_playlist', $request->playlist_id, 60 * 24 * 30));
  }

  public function update()
  {
    $songId = session('song_id');
    $songs = Playlist::find(session('playlist_id'))->songs;
    $songsArray = $songs->toArray();
    $index = $this->createIndexFromZero($songsArray, $songId);

    return json_encode(['songs' => $songs->toJson(), 'lastSong' => $index]);
  }

  private function createIndexFromZero($songs, $songId)
  {
    $index = 0;
    foreach($songs as ['id' => $id])
    {
      if($id == $songId)
        return $index;
      $index++;
    }
  }



}
