<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Song;
use App\Models\Playlist;

class DataController extends Controller
{
  public function createData()
  {
    $directories = Storage::directories('/public/songs');
    $songs = array();

    foreach($directories as $dir)
    {
      // плейлист(он же 'жанр' также) с именем папки
      $playlist = new Playlist;
      $foldersDir = explode('/', $dir);
      $playlist->title = $foldersDir[count($foldersDir) - 1];
      $playlist->description = ' ';
      $playlist->save();

      // новая песня в БД для каждого файла в папке
      $songs = array();
      $files = Storage::files($dir);

      foreach($files as $file)
      {
        $song = new Song;
        $folders = explode('/', $file);
        $song->title = $folders[count($folders) - 1];
        $song->url = asset("storage/songs/$playlist->title/$song->title");
        $song->save();

        $song->playlists()->attach($playlist);
        $songs[] = $song;
      }
      //$playlist->songs()->attach($songs);

    }
  }
}
