$(document).ready(function()
{

  $('button[name=submit]').click(function()
  {
    if ($('textarea').val() != '')
      set_code();
  });

  function set_code()
  {
    $.ajax({
       url: url + 'code',
       method: 'POST',
       dataType: 'json',
       data: {code: $('textarea').val()},
       success: function(data)
       {
         write_output(data);
       }
     });
  }

  function write_output(data)
  {
    console.log(data);
    $('#output textarea').empty();
    $('#output textarea').val(data.output);
  }

});
