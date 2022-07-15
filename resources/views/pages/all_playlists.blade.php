<div id='playlist-div'>
  <table id='playlists'>
    @php ($columns = 0)
    <tr>
      @foreach($playlists as $playlist)
        <td>
          <img src="{{ $playlist->image }}"><br>
          {{ $playlist->title }}
          <input type="text" value="{{ $playlist->id }}" hidden>
        </td>
        @if(++$columns == 6)
          </tr><tr>
          @php ($columns = 0)
        @endif
      @endforeach
    </tr>
  </table>
</div>


<script>
$('#playlists td img').click(function(){
  id = $(this).parent().find('input').attr('value');
  include('playlist/' + id);
});
</script>
