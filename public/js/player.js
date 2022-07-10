currentSong = null;
currentPlaylist = null;

$(document).ready(function(){

  $('.change-song').click(function(){
    changeSong($(this).val());
    console.log(currentSong);
  });



});

function changeSong(songUrl){
  $('#player').attr('src', songUrl);
  currentSong = songUrl;
}
