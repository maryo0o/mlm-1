<style type="text/css">
	#request-epins-form .form-group {
		margin-right: 15px;
		vertical-align: top;
	}

	#request-epins-form .form-group label {
		margin-right: 5px;
	}

	#request-epins-form #count {
		width: 100px;
	}

	#buy-epins-form {
		display: none;
	}
</style>

<?php echo $this->element('home_stories'); ?>
<hr>
<div class="row">
	<div class="col-md-3">
		<?php echo $this->element('home_site_links'); ?>
	</div>
	<div class="col-md-9">
		<h4>Buy Pins</h4>
		<form id="request-epins-form" class="form-inline">
			<fieldset>
				<?php
					$inputs = array(
						'count' => array('label-class' => '', 'name' => 'How Many', 'input-type' => 'text', 'attributes' => array('data-validate' => 'number|required'))
					);
					echo $this->element('inline_form', array('inputs' => $inputs, 'params' => (isset($params) ? $params : array()), 'errors' => (isset($errors) ? $errors : array())));
				?>
				<button class="btn btn-default btn-sm" data-loading-text="Processing">Process</button>
			</fieldset>
		</form>
		<div id="buy-epins-form" class="form-inline">
			<p></p>
			<button id="proceed-buy" class="btn btn-primary btn-sm" data-loading-text="Sending Request...">Proceed</button>
			<button id="cancel-buy" class="btn btn-primary btn-sm">Cancel</button>
		</div>
	</div>
</div>

<script type="text/javascript">
	validate.add_rule(
		'number', function(e) {
			return ((/^[0-9]*$/).test(e.val()) | e.val().length == 0);
		}, "This field must be a valid number."
	);

	$(function() {
		var request_epins_form = $('#request-epins-form');
		request_epins_form.validate();
		var buy_epins_form = $('#buy-epins-form');
		buy_epins_form.validate();
		var payment_details;

		$('body').on('submit', request_epins_form, function() {
			set_total_price();
			return false;
		});

		function set_total_price() {
			var params = {};
			var inputs = request_epins_form.serializeArray();
			$.each(inputs, function (i, input) {
				params[input.name] = input.value;
			});
			$.ajax({
				url: '<?php echo $this->webroot; ?>pages/ajax_calculate_buy_pins',
				type: 'POST',
				data: params,
				beforeSend: function() {
					request_epins_form.find('fieldset').attr('disabled', 'disabled');
					request_epins_form.find('button').button('loading');
				},
				success: function (result) {
					result = JSON.parse(result);
					request_epins_form.find('button').button('reset');
					buy_epins_form.find('p').html('Buying for ' + result.count + ' epins will cost you <b>Php ' + result.total + '</b>. Clicking proceed will send a request to the admin for your pins.');
					buy_epins_form.slideDown();
					payment_details = result;
				}
			});
		}

		$('body').on('click', '#proceed-buy', function() {
			var t = $(this);
			$.ajax({
				url: '<?php echo $this->webroot; ?>pages/ajax_request_buy_pins',
				type: 'POST',
				data: payment_details,
				beforeSend: function() {
					t.button('loading');
				},
				success: function (result) {
					window.location = "<?php echo $this->webroot; ?>buy_pins";
				}
			});
		});

		$('body').on('click', '#cancel-buy', function() {
			request_epins_form.find('fieldset').removeAttr('disabled');
			request_epins_form[0].reset();
			buy_epins_form.fadeOut();
			return false;
		});
	});
</script>
