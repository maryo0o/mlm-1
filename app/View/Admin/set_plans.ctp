<?php echo $this->element('admin_plans_navbar'); ?>

<h4>Set Plan Types</h4>
<form id="set-plans" action="<?php echo $this->webroot."admin/set_plans"; ?>" method="POST">
	<div class="row">
		<div class="col-md-6 form-horizontal" role="form">
			<h4>Membership</h4>
			<div class="form-group">
				<label class="col-md-4 control-label">Plan Type</label>
				<div class="col-md-8">
				<?php
					foreach ($membership_types as $membership_type) {
						echo
							"<div class='radio'>
								<label>
									<input type='radio' name='membership_type' value='{$membership_type['MlmType']['id']}'".(isset($params['membership_type']) ? ($params['membership_type'] == $membership_type['MlmType']['id'] ? " checked" : "") : ($membership_type['MlmType']['active'] ? " checked" : "")).">
									{$membership_type['MlmType']['name']}
								</label>
							</div>";
					}
				?>
				</div>
			</div>
		</div>
		<div class="col-md-6 form-horizontal" role="form">
			<h4>Product Ordering</h4>
			<div class="form-group">
				<label class="col-md-4 control-label">Plan Type</label>
				<div class="col-md-8">
				<?php
					foreach ($product_types as $product_type) {
						echo
							"<div class='radio'>
								<label>
									<input type='radio' name='product_type' value='{$product_type['MlmType']['id']}'".(isset($params['product_type']) ? ($params['product_type'] == $product_type['MlmType']['id'] ? " checked" : "") : ($product_type['MlmType']['active'] ? " checked" : "")).">
									{$product_type['MlmType']['name']}
								</label>
							</div>";
					}
				?>
				</div>
			</div>
			<button class="btn btn-primary btn-sm pull-right">Set Plan Type</button>
		</div>
	</div>
</form>
