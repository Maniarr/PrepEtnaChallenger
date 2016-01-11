<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php $this->asset('css/normalize.css') ?>" charset="utf-8">
    <link rel="stylesheet" href="<?php $this->asset('css/foundation.min.css') ?>" charset="utf-8">
    <link rel="stylesheet" href="<?php $this->asset('css/app.css') ?>" charset="utf-8">
    <title></title>
  </head>
  <body>

    <div id="code" class="">
      <textarea name="name" rows="8" cols="40"></textarea>
      <button type="button" name="button">Execute</button>
    </div>

    <div id="output" class="">

    </div>


    <script type="text/javascript">
      var url = '<?php $this->url(''); ?>';
    </script>
    <script src="<?php $this->asset('js/jquery-2.1.4.js') ?>" charset="utf-8"></script>
    <script src="<?php $this->asset('js/code.js') ?>" charset="utf-8"></script>
  </body>
</html>
