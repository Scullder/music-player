<ul class="songs-list">
  @foreach($songsList as $song)
    <li>
      <form class="form" method='post'>
        @csrf
        <input type="text" name="url" value="{{ $song->url }}">
        <input type="text" name="playlist" value="{{ $song->playlist }}">
        <input type="submit" value="отправить">
      </form>
    </li>
  @endforeach
</ul>

<script>
$('.form').submit(function(e){
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
