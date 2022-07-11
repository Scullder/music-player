<div id="player-play">
  <h3>Player</h3>

  <div id="player-playlist">
    <ul>
      @foreach($songs as $song)
        <li>
          <input type="button" class="change-song" value="{{ $song->url }}">
        </li>
      @endforeach
    </ul>
  </div>


</div>

<audio src="" id="player" autoplay controls></audio>
