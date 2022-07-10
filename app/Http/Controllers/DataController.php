<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
  public function createData()
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
}
