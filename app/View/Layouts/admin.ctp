<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title; ?></title>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<?php
		echo $this->HTML->css('bootstrap.min');
		echo $this->HTML->css('default');
		// echo $this->HTML->css('bootstrap-theme.min');
		echo $this->HTML->script('jquery-2.1.1.min');
		echo $this->HTML->script('bootstrap.min');
		echo $this->HTML->script('default');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div id="side-navbar" class="col-md-2 navbar navbar-default">
				<div class="navbar-header">
					<a href="<?php echo $this->webroot; ?>" class="navbar-brand">Bootstrap CDN</a>
				</div>
				<?php echo $this->Element('side_navbar'); ?>
			</div>
			<div id="content" class="col-md-10">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
