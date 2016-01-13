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
    $('#code').attr('cols', '20');
    $('#code').parent().removeClass('medium-12');
    $('#code').parent().addClass('medium-6');
    if ($('#code').parent().hasClass('code_anim_inverted'))
      $('#code').parent().removeClass('code_anim_inverted');
    $('#code').parent().addClass('code_anim');

    $('#output').parent().removeClass('output-hidden');
    $('#output').parent().addClass('output-show');
    $('#output textarea').addClass('output-wait');
    $('#output textarea').hide();
  }

  function set_code()
  {
    $.ajax({
       url: url + 'code',
       method: 'POST',
       //dataType: 'json',
       data: {name: $('input[name=login]').val(),code: $('textarea').val()},
       success: function(data)
       {
         $('#output textarea').show();
         write_output(data);
         $('.waiter').hide();

         if (data == 'false')
         {
           $('button[name=submit]').show();
           $('#code').parent().removeClass('medium-6');
           $('#code').parent().addClass('medium-12');
           $('#code').parent().removeClass('code_anim');
           $('#code').parent().addClass('code_anim_inverted');
           $('#error').text('Votre script PHP présente des erreurs !');
         }
         else
          $(location).attr('href', url + '?' + $('input[name=login]').val());
       }
     });
  }

  function write_output(data)
  {
    $('#output textarea').empty();
    $('#output textarea').val(data.output);
  }

});
