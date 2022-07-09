<div>
  @foreach($tracks as $url)
    {{ $url }}

    <button type="button" wire:click="swich('{{ $url }}')">swich</button>
    <br>
  @endforeach

  <br><br>
  {{$src}}

  <audio src="{{ $src }}" id="player"></audio>
  
  <button onclick="document.getElementById('player').play()">Play</button>
  <button onclick="document.getElementById('player').pause()">Pause</button>
  <button onclick="document.getElementById('player').volume += 0.1">Vol +</button>
  <button onclick="document.getElementById('player').volume -= 0.1">Vol -</button>

</div>
