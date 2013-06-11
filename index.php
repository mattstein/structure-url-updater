<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Structure URL Updater</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/bootstrap-responsive.css" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>

		<?php if ( ! empty($_POST['structure_hash'])): ?>

		<?php

		$hash         = $_POST['structure_hash'];
		$decoded      = base64_decode($_POST['structure_hash']);
		$unserialized = unserialize($decoded);
		$uris         = $unserialized[1]['uris'];
		$new_uris     = [];

		foreach($uris as $index => $uri)
		{
			$new_uris[$index] = str_replace('_', '-', $uri);
		}

		$new_unserialized            = $unserialized;
		$new_unserialized[1]['uris'] = $new_uris;
		$new_hash                    = base64_encode(serialize($new_unserialized));

		?>

		<div class="container">
			<h1>Structure URL Updater Results</h1>

			<ul class="nav nav-tabs">
				<li class="active"><a href="#hash" data-toggle="tab">Updated Hash</a></li>
				<li><a href="#changes" data-toggle="tab">Change Detail</a></li>
				<li><a href="#array" data-toggle="tab">Array Value</a></li>
				<li><a href="#sql" data-toggle="tab">SQL Insert</a></li>
				<li><a href="#original" data-toggle="tab">Original Hash</a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="hash">
					<textarea style="width: 98%; height: 10em;"><?php echo $new_hash; ?></textarea>
				</div>
				<div class="tab-pane" id="changes">
					<table class="table table-striped">
						<thead>
							<th>Original URI</th>
							<th>New URI</th>
						</thead>
						<tbody>
						<?php foreach($uris as $index => $uri): ?>
							<tr>
								<td><?php echo $uri; ?></td>
								<td><?php echo $new_uris[$index]; ?></td>
							</tr>
						<?php endforeach; ?>								
						</tbody>
					</table>
				</div>
				<div class="tab-pane" id="array">
				<?php
					echo '<pre>';
					print_r($unserialized);
					echo '</pre>';
				?>
				</div>
				<div class="tab-pane" id="sql">
					<pre>UPDATE exp_sites SET site_pages = '<?php echo $new_hash; ?>' WHERE site_id = 1</pre>
				</div>
				<div class="tab-pane" id="original">
					<pre><?php echo $hash; ?></pre>
				</div>
			</div>

		</div>

		<?php else: ?>
		<div class="container">

			<h1>Structure URL Updater</h1>

			<form action="" method="post">
				<label>Paste Your site_pages Hash Here <a class="help"><small>Huh?</small></a></label>
				<textarea name="structure_hash" style="width: 98%; height: 10em;"></textarea>

				<input type="checkbox" name="hyphenate" disabled checked /> Replace underscores with hyphens

				<div class="form-actions">			
					<button class="btn btn-primary">Do It</button>
				</div>				
			</form>

		</div>
		<?php endif; ?>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

	</body>
</html>