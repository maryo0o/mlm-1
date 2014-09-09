<?php echo $this->element('admin_users_navbar'); ?>
<h4>Create a New User</h4>
<form data-form>
	<div class="row">
		<div class="col-md-6 form-horizontal" role="form">
			<h4>Account Information</h4>
			<div class="form-group">
				<label for="username" class="col-md-4 control-label">Username</label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="username" placeholder="Username" data-validate="username|required">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-md-4 control-label">Password</label>
				<div class="col-md-8">
					<input type="password" class="form-control" id="password" placeholder="Password" data-validate="password|required">
				</div>
			</div>
			<div class="form-group">
				<label for="confirm-password" class="col-md-4 control-label">Confirm Password</label>
				<div class="col-md-8">
					<input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" data-validate="confirm-password|required" data-password="#password">
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-md-4 control-label">Email</label>
				<div class="col-md-8">
					<input type="email" class="form-control" id="email" placeholder="Email" data-validate="email|required">
				</div>
			</div>
		</div>
		<div class="col-md-6 form-horizontal" role="form">
			<h4>Personal Information</h4>
			<div class="form-group">
				<label for="first-name" class="col-md-4 control-label">First Name</label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="first-name" placeholder="First Name" data-validate="required">
				</div>
			</div>
			<div class="form-group">
				<label for="last-name" class="col-md-4 control-label">Last Name</label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="last-name" placeholder="Last Name" data-validate="required">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-md-4 control-label">Address</label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="address" placeholder="Address" data-validate="required">
				</div>
			</div>
			<div class="form-group">
				<label for="country" class="col-md-4 control-label">Country</label>
				<div class="col-md-8">
					<select id="country" class="form-control">
						<option>Country</option>
						<?php
							$countries = array();
							foreach ($countries as $country) {
								echo "<option value='".$country['Country']['id']."'>".$country['Country']['name']."</option>";
							}
						?>
					</select>
				</div>
			</div>
			<button class="btn btn-primary pull-right">Create User</button>
		</div>
	</div>
</form>