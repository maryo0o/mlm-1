<?php
	echo $this->element('admin_users_navbar');
	$new_countries = array('' => 'Country');
	foreach ($countries as $country)
		$new_countries[$country['Country']['id']] = $country['Country']['name'];
?>

<h4>Create a New User</h4>
<form data-form action="<?php echo $this->webroot."admin/create_user"; ?>" method="POST">
	<div class="row">
		<div class="col-md-6 form-horizontal" role="form">
			<h4>Account Information</h4>
			<?php
				$inputs = array(
					array('field' => 'username', 'label-class' => 'col-md-4 control-label', 'name' => 'Username', 'div-class' => 'col-md-8', 'input-type' => 'text', 'attributes' => array('data-validate' => 'alphanumeric_underscore|required|limit_length')),
					array('field' => 'password', 'label-class' => 'col-md-4 control-label', 'name' => 'Password', 'div-class' => 'col-md-8', 'input-type' => 'password', 'attributes' => array('data-validate' => 'alphanumeric_underscore|required|limit_length')),
					array('field' => 'confirm-password', 'label-class' => 'col-md-4 control-label', 'name' => 'Confirm Password', 'div-class' => 'col-md-8', 'input-type' => 'password', 'attributes' => array('data-validate' => 'confirm_password|required', 'data-password' => '#password')),
					array('field' => 'email', 'label-class' => 'col-md-4 control-label', 'name' => 'Email', 'div-class' => 'col-md-8', 'input-type' => 'text', 'attributes' => array('data-validate' => 'email|required'))
				);
				echo $this->element('horizontal_form', array('inputs' => $inputs, 'params' => (isset($params) ? $params : array())));
			?>
		</div>
		<div class="col-md-6 form-horizontal" role="form">
			<h4>Personal Information</h4>
			<?php
				$inputs = array(
					array('field' => 'first-name', 'label-class' => 'col-md-4 control-label', 'name' => 'First Name', 'div-class' => 'col-md-8', 'input-type' => 'text', 'attributes' => array('data-validate' => 'required')),
					array('field' => 'last-name', 'label-class' => 'col-md-4 control-label', 'name' => 'Last Name', 'div-class' => 'col-md-8', 'input-type' => 'text', 'attributes' => array('data-validate' => 'required')),
					array('field' => 'address', 'label-class' => 'col-md-4 control-label', 'name' => 'Address', 'div-class' => 'col-md-8', 'input-type' => 'text', 'attributes' => array('data-validate' => 'required')),
					array('field' => 'country', 'label-class' => 'col-md-4 control-label', 'name' => 'Country', 'div-class' => 'col-md-8', 'input-type' => 'select', 'attributes' => array('data-validate' => 'required'), 'options' => $new_countries)
				);
				echo $this->element('horizontal_form', array('inputs' => $inputs, 'params' => (isset($params) ? $params : array())));
			?>
			<button class="btn btn-primary pull-right">Create User</button>
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
		var form = $('[data-form]');
		form.validate();
	});
</script>