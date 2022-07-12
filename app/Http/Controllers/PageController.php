<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Playlist;
use App\Models\Song;

class PageController extends Controller
{
  public function main()
  {
    return view('main');
  }

  public function home()
  {
    return view('pages.home');
  }

  public function allPlaylists()
  {
    $playlists = Playlist::select()->get();

    return view('pages.all_playlists', ['playlists' => $playlists]);
  }

  public function playlist($id)
  {
    $playlist = Playlist::find($id);
    $songs = $playlist->songs;

    return view('pages.playlist', ['playlist' => $playlist, 'songs' => $songs]);
  }

  public function userPlaylist()
  {
    // session('song_id');
    $playlist = Playlist::find(session('playlist_id'));
    $songs = $playlist->songs;

    return view('pages.user_playlist', ['playlist' => $playlist, 'songs' => $songs]);
  }
}
