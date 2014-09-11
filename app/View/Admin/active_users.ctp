<?php echo $this->element('admin_users_navbar'); ?>
<h4>View Active Users</h4>
<form id="users-search-form" class="form-inline">
	<h4 class="pull-left">Search</h4>
	<?php
		$inputs = array(
			'username' => array('label-class' => 'sr-only', 'name' => 'Username', 'input-type' => 'text', 'attributes' => array('data-validate' => 'alphanumeric_underscore|limit_length')),
			'email' => array('label-class' => 'sr-only', 'name' => 'Email', 'input-type' => 'text', 'attributes' => array('data-validate' => 'email')),
			'name' => array('label-class' => 'sr-only', 'name' => 'Name', 'input-type' => 'text', 'attributes' => array()),
			'sponsor_id' => array('label-class' => 'sr-only', 'name' => 'Sponsor Username', 'input-type' => 'text', 'attributes' => array('data-validate' => 'alphanumeric_underscore'))
		);
		echo $this->element('inline_form', array('inputs' => $inputs, 'params' => (isset($params) ? $params : array()), 'errors' => (isset($errors) ? $errors : array())));
	?>
	<button class="btn btn-primary input-sm">Search</button>
</form>