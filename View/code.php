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
        <div id="code" class="">
          <textarea name="name" rows="20" cols="40"></textarea>
        </div>
      </div>
      <div class="columns medium-6 output-hidden">
        <div id="output" class="console-background">
          <textarea class="console" name="name" rows="20" cols="20" disabled></textarea>
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
