currentSongIndex = null;
currentPlaylist = null;
currentPlaylistId = null;
audio = new Audio;

$(document).ready(function(){
  $('.change-song').click(function(){
    changeSong($(this).val());
  });

  // next song
  $('#custom-next').on('click', function(){
    nextSong();
  });
  // previus song
  $('#custom-prev').on('click', function(){
    prevSong();
  });
  // play-pause
  $('#custom-play').on('click', function(){
    playPause($(this));
  });
  // end of song
  $('#player').on('ended', function(){
    nextSong();
  });


  $.ajax({
    type: "get",
    url: '/public/update-playlist',
    success: function(response)
    {
      response = JSON.parse(response);
      console.log(response);
      currentPlaylist = JSON.parse(response.songs);
      currentSongIndex = response.lastSong;
      swichSong(currentPlaylist[currentSongIndex], false);
    }
  });

});

function swichSong(song, play){
  changeSong(song.url, play);
  changePlayerInfo(song.title, song.poster);
}

function changeSong(songUrl, play){
  audio.src = songUrl;
  if(play != false)
    audio.play();
  console.log('song changed');
}

function changePlayerInfo(title, src){
  infoDiv = $('#player-div');
  infoDiv.find('#h').text(title);
  infoDiv.find('#img').attr('src', src);

  console.log(infoDiv.find('#h').text());
  console.log(src);

  console.log('playlist info changed');
}

function playPause(button){
  if(audio.paused){
    audio.play();
    button.text('playing');
  }
  else{
    audio.pause();
    button.text('paused');
  }
}

function prevSong(){
  if(currentSongIndex > 0){
    currentSongIndex -= 1;
    swichSong(currentPlaylist[currentSongIndex]);
  }
  console.log(currentSongIndex);
}

function nextSong(){
  if(currentSongIndex < currentPlaylist.length - 1){
    currentSongIndex += 1;
    swichSong(currentPlaylist[currentSongIndex]);
  }
  else{
    currentSongIndex = 0;
    swichSong(currentPlaylist[currentSongIndex]);
  }
  console.log(currentSongIndex);
}
