$(document).ready(function() {

  $('#home').click(function(){ include('home') });
  $('#playlist').click(function(){ include('playlist') });

});

function include(page)
{
  $.ajax({
    type: "get",
    url: '/public/' + page,
    success: function(response){
      console.log(response);
      $('#page').html('');
      $('#page').append(response);
    }
    
  });
}
