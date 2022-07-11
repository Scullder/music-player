<ul class="songs-list">
  @foreach($songs as $song)
    <li>
      <form class="song" method='post'>
        @csrf
        <input type="text" name="title" value="{{ $song->title }}">
        <input type="text" name="url" value="{{ $song->url }}" hidden>
        <input type="text" name="playlist" value="{{ $playlist->id }}" hidden>
        <input type="submit" value="play">
      </form>
    </li>
  @endforeach
</ul>

<script>
$('.song').submit(function(e){
  e.preventDefault();
  $.ajax({
    type: "post",
    url: '/public/set-playlist',
    data: $(this).serialize(),
    success: function(response){
      response = JSON.parse(response);
      $('#player').attr('src', response.url);
      currentPlaylist = response.newPlaylist;
      console.log(currentPlaylist);
    }
  });

})
</script>
