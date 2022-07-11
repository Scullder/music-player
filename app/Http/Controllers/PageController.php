<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Playlist;
use App\Models\Song;

class PageController extends Controller
{
  private function getStorageSongs()
  {
    $files = Storage::files('/public/songs');
    $songs = array();
    $id = 0;
    foreach($files as $file)
    {
      $songTitle = explode('/', $file)[2];
      $songUrl = asset('storage/songs/' . $songTitle);

      $songs[] = new Class($songTitle, $songUrl, 1)
                 {
                   public function __construct(public $title, public $url, public $playlist){}
                 };
    }

    return $songs;
  }

  public function main()
  {
    return view('main', ['songs' => $this->getStorageSongs()]);
  }

  public function home()
  {
    $songs = $this->getStorageSongs();
    $songs = array_slice($songs, 4);
    return view('pages.home', ['homeSongs' => $songs]);
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

  public function setPlaylist(Request $request)
  {
    $response = ['url' => $request->url, 'newPlaylist' => array_slice($this->getStorageSongs(), 5)];
    return json_encode($response);
  }
}
