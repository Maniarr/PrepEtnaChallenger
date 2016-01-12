<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php $this->asset('css/normalize.css') ?>" charset="utf-8">
    <link rel="stylesheet" href="<?php $this->asset('css/foundation.min.css') ?>" charset="utf-8">
    <link rel="stylesheet" href="<?php $this->asset('css/app.css') ?>" charset="utf-8">
    <title>Prep'ETNA Challenger</title>
	<style>
		.callout {
			margin-top: 20px;

		}
		h2 {
			text-align: center;
		}
		h3 {
			text-align: center;
		}
		table {
			width: 100%;
		}
	</style>
  </head>
  <body>

<div class="top-bar">
	<h3>Prep'ETNA Challenger</h3>
</div>

<div class="row">
	<div class="callout">
		<div class="row">
			<h2>Classement Projet No-X</h2>
			<hr>
		</div>
		<div class="row">
			<div class="large-8 columns">
				<div class="button-group">
					<button top=5 class="button top">Top 5</button>
					<button top=10 class="button top disabled">Top 10</button>
					<button top=20 class="button top">Top 20</button>
				</div>
			</div>
			<div class="large-4 columns">
				<div class="row collapse">
					<div class="small-8 columns">
						<input id="name" type="text" placeholder="Name">
					</div>
					<div class="small-4 columns">
						<button id="search" class="warning button expanded">Search</button>
					</div>
				</div>
			</div>
			<hr>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<table>
					<thead>
						<tr>
							<th>Position</th>
							<th>Name</th>
							<th>DP/MP</th>
							<th>DP/MG</th>
							<th>DG/MP</th>
							<th>DG/MG</th>
							<th>Score</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns" style="text-align: center">
				<button id="challenge" class="success large button">Challenge !</button>
			</div>
		</div>
	</div>
</div>

<?php
echo $_GET['name'];
?>

<script type="text/javascript">
var url = '<?php $this->url(''); ?>';
</script>
<script src="<?php $this->asset('js/jquery-2.1.4.js') ?>" charset="utf-8"></script>
<script src="<?php $this->asset('js/code.js') ?>" charset="utf-8"></script>
<script src="<?php $this->asset('js/score.js') ?>" charset="utf-8"></script>
</body>
</html>
