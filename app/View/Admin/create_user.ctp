<?php
	echo $this->element('admin_users_navbar');
	$new_countries = array('' => 'Country');
	foreach ($countries as $country)
		$new_countries[$country['Country']['id']] = $country['Country']['name'];
?>

<h4>Create a New User</h4>
<form id="create-user" action="<?php echo $this->webroot."admin/create_user"; ?>" method="POST">
	<div class="row">
		<div class="col-md-6 form-horizontal" role="form">
			<h4>Account Information</h4>
			<?php
				$inputs = array(
					'username' => array('label-class' => 'col-md-4 control-label', 'name' => 'Username', 'div-class' => 'col-md-8', 'input-type' => 'text', 'attributes' => array('data-validate' => 'alphanumeric_underscore|required|limit_length')),
					'password' => array('label-class' => 'col-md-4 control-label', 'name' => 'Password', 'div-class' => 'col-md-8', 'input-type' => 'password', 'attributes' => array('data-validate' => 'alphanumeric_underscore|required|limit_length')),
					'confirm-password' => array('label-class' => 'col-md-4 control-label', 'name' => 'Confirm Password', 'div-class' => 'col-md-8', 'input-type' => 'password', 'attributes' => array('data-validate' => 'confirm_password|required', 'data-password' => '#password')),
					'email' => array('label-class' => 'col-md-4 control-label', 'name' => 'Email', 'div-class' => 'col-md-8', 'input-type' => 'text', 'attributes' => array('data-validate' => 'email|required'))
				);
				echo $this->element('horizontal_form', array('inputs' => $inputs, 'params' => (isset($params) ? $params : array()), 'errors' => (isset($errors) ? $errors : array())));
			?>
		</div>
		<div class="col-md-6 form-horizontal" role="form">
			<h4>Personal Information</h4>
			<?php
				$inputs = array(
					'first_name' => array('label-class' => 'col-md-4 control-label', 'name' => 'First Name', 'div-class' => 'col-md-8', 'input-type' => 'text', 'attributes' => array('data-validate' => 'required')),
					'last_name' => array('label-class' => 'col-md-4 control-label', 'name' => 'Last Name', 'div-class' => 'col-md-8', 'input-type' => 'text', 'attributes' => array('data-validate' => 'required')),
					'address' => array('label-class' => 'col-md-4 control-label', 'name' => 'Address', 'div-class' => 'col-md-8', 'input-type' => 'text', 'attributes' => array('data-validate' => 'required')),
					'country' => array('label-class' => 'col-md-4 control-label', 'name' => 'Country', 'div-class' => 'col-md-8', 'input-type' => 'select', 'attributes' => array('data-validate' => 'required'), 'options' => $new_countries)
				);
				echo $this->element('horizontal_form', array('inputs' => $inputs, 'params' => (isset($params) ? $params : array()), 'errors' => (isset($errors) ? $errors : array())));
			?>
			<button class="btn btn-primary btn-sm pull-right">Create User</button>
		</div>
	</div>
</form>

<script type="text/javascript">
	validate.add_rule(
		'confirm_password', function(e) {
			return e.val() == $(e.data('password')).val() | e.val().length == 0;
		}, "'Confirm password' and 'Password' do not match."
	);

	validate.add_rule(
		'limit_length', function(e) {
			return (e.val().length > 6 && e.val().length < 16) | (e.val().length == 0);
		}, "This field must be between 6 and 18 characters."
	);

	$(function () {
		var form = $('#create-user');
		form.validate();
	});
</script>
