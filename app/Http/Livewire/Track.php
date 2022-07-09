<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;


class Track extends Component
{
  public $tracks;
  public $src;

  public function mount()
  {
    $files = Storage::files('/public/tracks');
    $tracks = array();

    foreach($files as $file)
    {
      $trackTitle = explode('/', $file)[2];
      $trackUrl = asset('storage/tracks/' . $trackTitle);
      $tracks[] = $trackUrl;
    }
    $this->tracks = $tracks;
    $this->src = $tracks[0];

    //$this->src = 'Hello there';
    //$this->tracks = [['a', 111], ['b', 222], ['c', 333], ['d', 444]];
  }

  public function swich($url)
  {
    $this->src = $url;
  }


  public function render()
  {
    return view('livewire.track');
  }

}
