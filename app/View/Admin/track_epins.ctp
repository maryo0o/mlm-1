<style type="text/css">
	#epins-container {
		position: relative;
	}

	#epins-search-form .form-group {
		margin-right: 20px;
		vertical-align: top;
	}

	#epins-search-form .form-group p {
		width: 172px;
	}
</style>

<?php echo $this->element('admin_epins_navbar'); ?>

<h4>Track EPins</h4>
<form id="epins-search-form" class="form-inline">
	<h4 class="pull-left">Search</h4>
	<?php
		$inputs = array(
			'pin' => array('label-class' => 'sr-only', 'name' => 'EPin Number', 'input-type' => 'text', 'attributes' => array()),
			'status' => array('label-class' => 'sr-only', 'name' => 'EPin Status', 'input-type' => 'text', 'attributes' => array()),
			'owner' => array('label-class' => 'sr-only', 'name' => 'Owned by', 'input-type' => 'text', 'attributes' => array()),
			'user' => array('label-class' => 'sr-only', 'name' => 'Used by', 'input-type' => 'text', 'attributes' => array())
		);
		echo $this->element('inline_form', array('inputs' => $inputs, 'params' => (isset($params) ? $params : array()), 'errors' => (isset($errors) ? $errors : array())));
	?>
	<button class="btn btn-primary btn-sm">Search</button>
</form>
<div id="epins-container"></div>

<script type="text/javascript">
	$(function() {
		var filter_form = $('#epins-search-form');
		filter_form.validate();
		get_epins();
		var filters;

		$('body').on('submit', filter_form, function() {
			get_epins();
			return false;
		})

		$('body').on('click', '.ajax-pagination a', function() {
			page_url = $(this).attr('href');
			if(page_url != null) {
				var params = {};
				var url_filters = page_url.split('/');
				$.each(url_filters, function (key, value) {
					if(value.indexOf(':') > -1) {
						param_parts = value.split(':');
						params[param_parts[0]] = param_parts[1];
					}
				});
				$.each(filters, function (key, value) {
					if(value != '')
						params[key] = value;
				});
				$.ajax({
					url: '<?php echo $this->webroot; ?>admin/ajax_track_epins',
					type: 'POST',
					data: params,
					beforeSend: function() {
						$('#epins-container').append(ajax_loader);
					},
					success: function (result) {
						$('#epins-container').html(result);
					}
				});
			}
			return false;
		});

		function get_epins() {
			var params = {};
			var inputs = filter_form.serializeArray();
			$.each(inputs, function (i, input) {
				params[input.name] = input.value;
			});
			filters = params;
			$.ajax({
				url: '<?php echo $this->webroot; ?>admin/ajax_track_epins',
				type: 'POST',
				data: params,
				beforeSend: function() {
					$('#epins-container').append(ajax_loader);
				},
				success: function (result) {
					$('#epins-container').html(result);
				}
			});
		}
	});
</script>
