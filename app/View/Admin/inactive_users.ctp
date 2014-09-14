<style type="text/css">
	#inactive-users-container {
		position: relative;
	}

	#users-search-form .form-group {
		margin-right: 20px;
		vertical-align: top;
	}

	#users-search-form .form-group p {
		width: 172px;
	}
</style>
<?php echo $this->element('admin_users_navbar'); ?>
<h4>View Inactive Users</h4>
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
	<button class="btn btn-primary btn-sm">Search</button>
</form>
<div id="inactive-users-container"></div>

<script type="text/javascript">
	validate.add_rule(
		'limit_length', function(e) {
			return (e.val().length > 6 && e.val().length < 16) | (e.val().length == 0);
		}, "This field must be between 6 and 18 characters."
	);

	$(function() {
		var filter_form = $('#users-search-form');
		filter_form.validate();
		get_inactive_users();

		$('body').on('submit', filter_form, function() {
			get_inactive_users();
			return false;
		})

		$('body').on('click', '.ajax-pagination a', function() {
			$this = $(this);
			page_url = $(this).attr('href');
			if(page_url != null) {
				$.ajax({
					url: page_url,
					type: 'GET',
					beforeSend: function() {
						$('#inactive-users-container').append(ajax_loader);
					},
					success: function (result) {
						$('#inactive-users-container').html(result);
					}
				});
			}
			return false;
		});

		function get_inactive_users() {
			var params = {};
			var inputs = filter_form.serializeArray();
			$.each(inputs, function (i, input) {
				params[input.name] = input.value;
			});
			params['is_ajax'] = true;
			$.ajax({
				url: '<?php echo $this->webroot; ?>admin/ajax_inactive_users',
				type: 'POST',
				data: params,
				beforeSend: function() {
					$('#inactive-users-container').append(ajax_loader);
				},
				success: function (result) {
					$('#inactive-users-container').html(result);
				}
			});
		}
	});
</script>
