<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Playlist;
use App\Models\Song;

class PageController extends Controller
{
  public function main(Request $request)
  {
    $sessionSongId = session('song_id');
    $sessionPlaylistId = session('playlist_id');
    $cookieSongId = $request->cookie('last_song');
    $cookiePlaylistId = $request->cookie('last_song');

    if($sessionSongId == null && $cookieSongId != null)
      session(['song_id' => $cookieSongId]);

    if($sessionSongId == null && $cookieSongId != null)
      session(['playlist_id' => $cookiePlaylistId]);

    $lastSong = Song::find(session('song_id'));

    return view('main', ['lastPage' => session('last_page'),
                         'lastSongUrl' => $lastSong->url,
                         'lastSongPoster' => $lastSong->poster,
                         'lastSongTitle' => $lastSong->title]);
  }

  public function home(Request $req)
  {
    $req->session()->put('last_page', 'home');
    return view('pages.home');
  }

  public function allPlaylists(Request $req)
  {
    $playlists = Playlist::select()->get();
    $req->session()->put('last_page', 'all_playlists');

    return view('pages.all_playlists', ['playlists' => $playlists]);
  }

  public function playlist(Request $req, $id)
  {
    $playlist = Playlist::find($id);
    $songs = $playlist->songs;
    $req->session()->put('last_page', 'playlist');

    return view('pages.playlist', ['playlist' => $playlist, 'songs' => $songs]);
  }

  public function userPlaylist(Request $req)
  {
    $playlist = Playlist::find(session('playlist_id'));
    $songs = $playlist->songs;
    $req->session()->put('last_page', 'user_playlist');

    return view('pages.user_playlist', ['playlist' => $playlist, 'songs' => $songs]);
  }
}
