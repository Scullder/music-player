<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Song;
use App\Models\Playlist;

class DataController extends Controller
{
  // путь к музыки относительно драйвера хранилища
  private $songsPath = '/public/songs';
  // к изображениям плейлистов
  private $imagePath = '/public/posters';

  public function createData()
  {
    $directories = Storage::directories($this->songsPath);
    $songs = array();

    foreach($directories as $dir)
    {
      // плейлист(он же 'жанр' также) с именем папки
      $playlist = new Playlist;
      $foldersDir = explode('/', $dir);
      $playlist->title = $foldersDir[count($foldersDir) - 1];
      $playlist->description = ' ';
      // если запись с таким же названием уже существует
      if(Playlist::where('title', '=', $playlist->title)->exists())
        continue;
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
    }

  }

  public function updateImages()
  {
    $images = Storage::files($this->imagePath);
    foreach($images as $image)
    {
      $title = stristr($image, strrchr($image, '/'));
      $title = trim($title, '/');
      $url = asset("storage/posters/$title");
      $title = stristr($title, '.', true);

      $playlist = Playlist::where('title', '=', $title)->first();
      $playlist->image = $url;
      $playlist->save();
    }
  }

  public function updatePosters()
  {
    $rockPoster = asset("storage/songs/rock/poster.jpg");
    $popPoster = asset("storage/songs/pop/poster.jpg");
    $rock = Playlist::where('title', 'rock')->first()->songs()->update(['poster' => $rockPoster]);
    $rock = Playlist::where('title', 'pop')->first()->songs()->update(['poster' => $popPoster]);

    dd($rock);

  }
}
