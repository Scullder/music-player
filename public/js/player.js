currentSongIndex = null;
currentPlaylist = null;

$(document).ready(function(){
  $('.change-song').click(function(){
    changeSong($(this).val());
  });

});

function changeSong(songUrl){
  $('#player').attr('src', songUrl);
}
