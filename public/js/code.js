$(document).ready(function()
{
  $('.waiter').hide();
  $('button[name=submit]').click(function()
  {
    if ($('textarea').val() != '' && $('input[name=login]').val() != '')
    {
      set_code();
      show_output();
      $('.waiter').show();
      $('#output textarea').hide();
      $('button[name=submit]').hide();
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
       data: {name: $('input[name=login]').val(),code: $('textarea').val()},
       success: function(data)
       {
         $('#output textarea').show();
         write_output(data);
         $('.waiter').hide();
       }
     });
  }

  function write_output(data)
  {
    console.log(data.output);
    $('#output textarea').empty();
    $('#output textarea').val(data.output);
  }

});
