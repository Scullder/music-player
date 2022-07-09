<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrackController extends Controller
{
  public function getTracks()
  {
    /*
    $files = Storage::files('/public/tracks');
    $tracks = array();

    foreach($files as $file)
    {
      $trackTitle = explode('/', $file)[2];
      $trackUrl = asset('storage/tracks/' . $trackTitle);
      $tracks[] = new class($trackTitle, $trackUrl)
      {
        public $title;
        public $url;

        public function __construct($title, $url)
        {
          $this->title = $title;
          $this->url = $url;
        }
      };
    }
    */
    return view('main');
  }
}
