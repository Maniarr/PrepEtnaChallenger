<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php $this->asset('css/normalize.css') ?>" charset="utf-8">
    <link rel="stylesheet" href="<?php $this->asset('css/foundation.min.css') ?>" charset="utf-8">
    <link rel="stylesheet" href="<?php $this->asset('css/app.css') ?>" charset="utf-8">
    <title>Prep'ETNA Challenger</title>
  </head>
  <body>
    <div class="top-bar">
    	<h3>Prep'ETNA Challenger</h3>
    </div>

    <div class="row">
    	<div class="callout">
    		<div class="row">
    			<h2>Challenge Projet No-X</h2>
      	</div>
      </div>
    </div>
    <div class="row">
    <div class="columns medium-12">
      <p id="error" class="center" style="text-align: center; color: red">

      </p>
      <div class="center">
          <input type="text" name="login" value="" placeholder="login_l" required>
      </div>
    </div>
      <div class="columns medium-12">
        <div id="code" class="">
          <textarea name="name" rows="20" cols="40" required></textarea>
        </div>
      </div>
      <div class="columns medium-6 output-hidden" style="background-color: #fff;">
        <div id="output" class="console-background">
        </div>
        <div class="waiter center">
          <p  style="text-align: center;">
            Les tests peuvent durer jusqu'a 5 minutes.
          </p>
          <img src="<?php $this->asset('img/loader.gif') ?> " alt="" />
        </div>
      </div>
    </div>
      <div class="columns medium-12">
        <button class="large button centered" type="button" name="submit">Execute</button>
      </div>
    </div>

    <script type="text/javascript">
      var url = '<?php $this->url(''); ?>';
    </script>
    <script src="<?php $this->asset('js/jquery-2.1.4.js') ?>" charset="utf-8"></script>
    <script src="<?php $this->asset('js/code.js') ?>" charset="utf-8"></script>
  </body>
</html>
