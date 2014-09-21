<style type="text/css">
	.col-md-1 {
		padding-left: 0;
	}

	.glyphicon {
		margin-top: 6px;
		cursor: pointer;
	}
</style>

<?php echo $this->element('admin_plans_navbar'); ?>

<h4>Set Commission Levels</h4>
<form id="set-commissions" action="<?php echo $this->webroot."admin/set_commissions"; ?>" method="POST">
	<div class="row">
		<div id="membership" class="col-md-6 form-horizontal" role="form">
			<h4>Membership: <?php echo $membership['MlmType']['name']; ?></h4>
			<?php if(!count($membership_levels)): ?>
				<div class="form-group commission-field">
					<label class="col-md-3 control-label">Level 1</label>
					<div class="col-md-8">
						<input type="text" class="form-control input-sm" name="membership_commission[]" placeholder="Commission Percentage" data-validate="required|percentage|limit">
					</div>
					<div class="col-md-1">
						<i class="glyphicon glyphicon-remove"></i>
					</div>
				</div>
			<?php else: ?>
				<?php foreach ($membership_levels as $level): ?>
					<div class="form-group commission-field">
						<label class="col-md-3 control-label">Level 1</label>
						<div class="col-md-8">
							<input type="text" class="form-control input-sm" name="membership_commission[]" placeholder="Commission Percentage" data-validate="required|percentage|limit" value="<?php echo $level['Commission']['percent']; ?>">
						</div>
						<div class="col-md-1">
							<i class="glyphicon glyphicon-remove"></i>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<div class="form-group">
				<label class="col-md-4 control-label"></label>
				<div class="col-md-8">
					<button id="add-new-membership-level" class="pull-right btn btn-primary btn-sm">Add New Level</button>
				</div>
			</div>
		</div>
		<div id="product" class="col-md-6 form-horizontal" role="form">
			<h4>Product Ordering: <?php echo $product['MlmType']['name']; ?></h4>
			<?php if(!count($product_levels)): ?>
				<div class="form-group commission-field">
					<label class="col-md-3 control-label">Level 1</label>
					<div class="col-md-8">
						<input type="text" class="form-control input-sm" name="product_commission[]" placeholder="Commission Percentage" data-validate="required|percentage|limit">
					</div>
					<div class="col-md-1">
						<i class="glyphicon glyphicon-remove"></i>
					</div>
				</div>
			<?php else: ?>
				<?php foreach ($product_levels as $level): ?>
					<div class="form-group commission-field">
						<label class="col-md-3 control-label">Level 1</label>
						<div class="col-md-8">
							<input type="text" class="form-control input-sm" name="product_commission[]" placeholder="Commission Percentage" data-validate="required|percentage|limit" value="<?php echo $level['Commission']['percent']; ?>">
						</div>
						<div class="col-md-1">
							<i class="glyphicon glyphicon-remove"></i>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<div class="form-group">
				<label class="col-md-4 control-label"></label>
				<div class="col-md-8">
					<button id="add-new-product-level" class="pull-right btn btn-primary btn-sm">Add New Level</button>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label"></label>
				<div class="col-md-8">
					<input type="submit" class="btn btn-primary btn-sm pull-right" value="Set Commission Levels">
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	validate.add_rule(
		'percentage', function(e) {
			return ((/^[0-9]*(|\.[0-9]+)$/).test(e.val()) | e.val().length == 0);
		}, "This field must be a valid decimal number."
	);

	validate.add_rule(
		'limit', function(e) {
			return (!(/^[0-9]*(|\.[0-9]+)$/).test(e.val()) | e.val().length == 0 | (e.val() > 0 && e.val() < 100));
		}, "This field must be between 0 and 100."
	);

	$(function() {
		var form = $('#set-commissions');
		form.validate();
		var limit_level = 10;
		var membership_commission_field = $('#membership .commission-field:first-of-type()')[0].outerHTML;
		var product_commission_field = $('#product .commission-field:first-of-type()')[0].outerHTML;
		set_leveling('#membership');
		set_leveling('#product');

		$('body').on('click', '#add-new-membership-level', function() {
			if($('#membership .commission-field').length < limit_level) {
				var clearfix_div = $(this).closest('.form-group');
				clearfix_div.before(membership_commission_field);
				clearfix_div.prev('.commission-field').find('input').val('');
				set_leveling('#membership');
			}
			return false;
		});

		$('body').on('click', '#add-new-product-level', function() {
			if($('#product .commission-field').length < limit_level) {
				var clearfix_div = $(this).closest('.form-group');
				clearfix_div.before(product_commission_field);
				clearfix_div.prev('.commission-field').find('input').val('');
				set_leveling('#product');
			}
			return false;
		});

		$('body').on('click', '#membership i.glyphicon-remove', function() {
			if($('#membership .commission-field').length > 1) {
				$(this).closest('.commission-field').remove();
				set_leveling('#membership');
			}
		});

		$('body').on('click', '#product i.glyphicon-remove', function() {
			if($('#product .commission-field').length > 1) {
				$(this).closest('.commission-field').remove();
				set_leveling('#product');
			}
		});

		function set_leveling(type) {
			$(type).find('.commission-field').each(function(index, el) {
				$(this).find('label').text('Level ' + (index + 1));
			});

			if($(type).find('.commission-field').length == 1) {
				$(type).find('.form-group:first-of-type .glyphicon').css('opacity', '0.5');
			}
			else {
				$(type).find('.form-group:first-of-type .glyphicon').css('opacity', '1');
			}

			if($(type).find('.commission-field').length == limit_level) {
				$(type).find('button').css('opacity', '0.5');
			}
			else {
				$(type).find('button').css('opacity', '1');
			}
		}
	});
</script>
