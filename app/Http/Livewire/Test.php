<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{
  public $data = 'Say hello';

  public function render()
  {
    return view('livewire.test', ['data' => $this->data]);
  }

  public function like()
  {
    $this->data = 'to my litle friend';
  }
}
