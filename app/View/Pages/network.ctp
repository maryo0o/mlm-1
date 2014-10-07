<style type="text/css">
	#join-network-form .form-group {
		margin-right: 15px;
		vertical-align: top;
	}

	#join-network-form .form-group label {
		margin-right: 5px;
	}

	#join-network-form #count {
		width: 100px;
	}

	#cancel-join-network {
		text-align: center;
	}
</style>

<?php echo $this->element('home_stories'); ?>
<hr>
<div class="row">
	<div class="col-md-3">
		<?php echo $this->element('home_site_links'); ?>
	</div>
	<div class="col-md-9">
		<h4>My Network</h4>
		<?php if($auth['activated']): ?>
			<div id="epins-container">
				<?php echo json_encode($users); ?>
			</div>
		<?php else: ?>
			<?php if($request): ?>
				<p>Request to join the network is made. Please wait for the admin to approve your request.</p>
				<p>If you want to cancel your request, please press the button below.</p>
				<form id="cancel-join-network" action="<?php echo $this->webroot."pages/ajax_cancel_join_network" ?>" method="POST">
					<input type="hidden" class="btn btn-primary btn-sm" name="id" value="<?php echo $request['Request']['id']; ?>">
					<input type="submit" class="btn btn-primary btn-sm" value="Cancel">
				</form>
			<?php else: ?>
				<form id="join-network-form" class="form-inline" action="<?php echo $this->webroot."pages/ajax_join_network" ?>" method="POST">
					<fieldset>
						<?php
							$inputs = array(
								'pin' => array('label-class' => '', 'name' => 'EPin Code', 'input-type' => 'text', 'attributes' => array('data-validate' => 'required')),
								'username' => array('label-class' => '', 'name' => 'Sponsor', 'input-type' => 'text', 'attributes' => array('data-validate' => 'required'))
							);
							echo $this->element('inline_form', array('inputs' => $inputs, 'params' => (isset($params) ? $params : array()), 'errors' => (isset($errors) ? $errors : array())));
						?>
						<button class="btn btn-default btn-sm" data-loading-text="Processing">Join Network</button>
					</fieldset>
				</form>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	$(function() {
		var join_network_form = $('#join-network-form');
		join_network_form.validate();
	});
</script>
