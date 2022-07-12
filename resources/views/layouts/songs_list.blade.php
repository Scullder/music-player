<div id="songs-list-div">
  <h3>{{ $playlist->title }}</h3>
  <ul id="songs-list">
    @foreach($songs as $song)
      <li>
        <div class="song-title">{{ stristr($song->title, strrchr($song->title, '.'), true) }}</div>

        <form class="song" method='post'>
          @csrf
          <input type="text" name="song_id" value="{{ $song->id }}" hidden>
          <input type="text" name="url" value="{{ $song->url }}" hidden>
          <input type="text" name="playlist_id" value="{{ $playlist->id }}" hidden>
          <input type="submit" class="play_small" value="">
        </form>
      </li>
    @endforeach
  </ul>
</div>

<script>
$('.song').submit(function(e){
  e.preventDefault();
  $.ajax({
    type: "post",
    url: '/public/set-playlist',
    data: $(this).serialize(),
    success: function(response){
      response = JSON.parse(response);
      currentSongIndex = response.index;
      currentPlaylist = response.playlist;
      changeSong(response.url);
      console.log(response);
    }
  });

})
</script>
