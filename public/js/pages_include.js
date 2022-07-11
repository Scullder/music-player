$(document).ready(function() {

  $('#home').click(function(){ include('home') });
  $('#list').click(function(){ include('playlists') });

});

function include(page, data)
{
  $.ajax({
    type: "get",
    url: '/public/' + page,
    data: data,
    success: function(response){
      console.log(response);
      $('#page').html('');
      $('#page').append(response);
    }

  });
}
