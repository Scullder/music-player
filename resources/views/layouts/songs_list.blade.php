<div id="songs-list-div">
  <ul id="songs-list">
    @foreach($songs as $song)
      <li>
        <form class="song" method='get'>
          @csrf
          <input type="text" name="song_id" value="{{ $song->id }}" hidden>
          <input type="text" name="url" value="{{ $song->url }}" hidden>
          <input type="text" name="playlist_id" value="{{ $song->pivot->playlist_id }}" hidden>
          <input type="submit" class="play_small" value="">
        </form>

        <div class="song-title">{{ stristr($song->title, strrchr($song->title, '.'), true) }}</div>
      </li>
    @endforeach
  </ul>
</div>

<script>
$('.song').submit(function(e){
  e.preventDefault();
  playlistId = $(this).find('input[name="playlist_id"]').val();

  $.ajax({
    type: "post",
    url: '/public/set-playlist',
    data: $(this).serialize(),
    success: function(response)
    {
      response = JSON.parse(response);
      currentSongIndex = response.index;
      //changePlayerInfo(response.title, response.poster);
      if(playlistId != currentPlaylistId)
      {
        currentPlaylistId = playlistId;
        currentPlaylist = JSON.parse(response.songs);
      }
      swichSong(currentPlaylist[response.index]);
    }
  });

})
</script>
