<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

  public function playlist()
  {
    return view('pages.playlist');
  }

  public function setPlaylist(Request $request)
  {
    $response = ['url' => $request->url, 'newPlaylist' => array_slice($this->getStorageSongs(), 5)];
    return json_encode($response);
  }
}
