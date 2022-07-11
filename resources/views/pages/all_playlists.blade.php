<h3>list of all music</h3>

@foreach($playlists as $playlist)
  <div class="playlist">
    {{ $playlist->title }}
    <input type="text" value="{{ $playlist->id }}" hidden>
  </div>
@endforeach


<script>
$('.playlist').click(function(){
  id = $(this).find('input').attr('value');
  include('playlist/' + id);
});
</script>
