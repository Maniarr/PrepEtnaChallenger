$(document).ready(function()
{
  $('button[name=submit]').click(function()
  {
    if ($('textarea').val() != '')
    {
      set_code();
      show_output();
    }
  });

  function show_output()
  {
    console.log('test');
    $('#code').attr('cols', '20');
    $('#code').parent().removeClass('medium-12');
    $('#code').parent().addClass('medium-6');
    $('#code').parent().addClass('code_anim');

    $('#output').parent().removeClass('output-hidden');
    $('#output').parent().addClass('output-show');
    $('#output textarea').addClass('output-wait');
  }

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
