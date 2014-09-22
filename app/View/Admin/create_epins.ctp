<style type="text/css">
	#create-epins .epin-fields {
		margin-bottom: 10px;
	}

	#create-epins .epin-fields .form-group:first-of-type {
		width: 230px;
	}

	#create-epins .epin-fields .form-group {
		vertical-align: top;
		width: 210px;
	}

	#create-epins .epin-fields .form-group:last-of-type {
		width: 225px;
	}

	#create-epins .epin-fields .form-group label {
		margin-right: 5px;
	}

	#create-epins .epin-fields .form-group input {
		width: 150px !important;
	}

	#create-epins .epin-fields .form-group input#pin {
		width: 180px !important;
	}

	#create-epins .epin-fields .form-group p {
		width: 221px;
	}

	#create-epins .btn {
		margin-left: 5px;
	}

	.glyphicon {
		margin-top: 6px;
		cursor: pointer;
	}
</style>
<?php echo $this->element('admin_epins_navbar'); ?>

<h4>Create New Epins</h4>
<form id="create-epins" class="form-inline" action="<?php echo $this->webroot."admin/create_epins"; ?>" method="POST">
	<div class="epin-fields">
		<div class="form-group">
			<label for="pin" class="">Epin</label>
			<input type="text" class="form-control input-sm" id="pin" name="pin[]" placeholder="Epin" data-validate="required" readonly>
		</div>
		<div class="form-group">
			<label for="value" class="">Value</label>
			<input type="text" class="form-control input-sm" id="value" name="value[]" placeholder="Value" data-validate="required|money" value="">
		</div>
		<div class="form-group">
			<label for="price" class="">Price</label>
			<input type="text" class="form-control input-sm" id="price" name="price[]" placeholder="Price" data-validate="required|money" value="">
		</div>
		<div class="form-group">
			<label for="purpose" class="">Purpose</label>
			<select class="form-control input-sm" id="purpose" name="purpose[]" data-validate="required">
				<option value="">Purpose</option>
				<option value="membership">Membership</option>
				<option value="product ordering">Product Ordering</option>
			</select>
		</div>
		<i class="glyphicon glyphicon-remove"></i>
	</div>
	<div class="clearfix">
		<input type="submit" class="pull-right btn btn-primary btn-sm" value="Save Epins">
		<button id="add-new-pin" class="pull-right btn btn-primary btn-sm">Add New Epin</button>
	</div>
</form>

<script type="text/javascript">
	validate.add_rule(
		'money', function(e) {
			return ((/^[1-9][0-9]*(|\.[0-9]+)$/).test(e.val()) | e.val().length == 0);
		}, "This field must be a valid decimal number."
	);

	$(function() {
		var form = $('#create-epins');
		form.validate();
		form.find('#pin').val(generate_epin());
		var epin_field = $('.epin-fields')[0].outerHTML;

		$('body').on('click', '#add-new-pin', function() {
			var clearfix_div = $(this).closest('div');
			clearfix_div.before(epin_field);
			clearfix_div.prev('.epin-fields').find('input[name*="pin"]').val(generate_epin());
			return false;
		});

		$('body').on('click', 'i.glyphicon-remove', function() {
			if($('.epin-fields').length > 1)
				$(this).closest('.epin-fields').remove();
		});

		function generate_epin() {
			var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			var result = '';
			for (var i = 17; i > 0; --i)
				result += chars[Math.round(Math.random() * (chars.length - 1))];
			return result;
		}
	});
</script>
