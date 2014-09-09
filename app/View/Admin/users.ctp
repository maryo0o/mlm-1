<?php
	$this->Js->request(
		array('controller' => 'admin', 'action' => 'active_users'),
		array(
			'data' => array('is_ajax' => true),
			'async' => true,
			'method' => 'POST'
		)
	);
	echo $this->Js->writeBuffer();
	echo $this->requestAction(
		array('controller' => 'admin', 'action' => 'active_users'),
		array('data' => array('is_ajax' => true))
	);
?>
hahahay
<script type="text/javascript">
	$(function() {
		$.ajax({
			url: '<?php echo $this->webroot; ?>admin/active_users',
			type: 'POST',
			data: {is_ajax: true},
			success: function (result) {
				$('#content').html(result);
			}
		});
	});
</script>