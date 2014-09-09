<form class="form-horizontal" role="form" action="<?php echo $this->webroot; ?>admin/ajax_login" method="POST">
	<div class="form-group">
		<label for="input-username" class="col-sm-2 col-sm-offset-2 control-label">Username</label>
		<div class="col-sm-6">
			<input type="text" name="username" class="form-control" id="input-username" placeholder="Username">
		</div>
	</div>
	<div class="form-group">
		<label for="input-password" class="col-sm-2 col-sm-offset-2 control-label">Password</label>
		<div class="col-sm-6">
			<input type="password" name="password" class="form-control" id="input-password" placeholder="Password">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-6">
			<button type="submit" class="btn btn-default">Sign in</button>
		</div>
	</div>
</form>