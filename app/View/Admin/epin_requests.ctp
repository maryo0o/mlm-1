<style type="text/css">
	#requests-container {
		position: relative;
	}
</style>
<?php echo $this->element('admin_epins_navbar'); ?>

<h4>EPin Requests</h4>
<div id="requests-container"></div>

<script type="text/javascript">
	$(function() {
		get_requests({});

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
				get_requests(params);
			}
			return false;
		});

		$('body').on('click', '[data-approve]', function() {
			var t = $(this).closest('td');
			var params = {};
			params.id = t.data('id');
			params.count = t.data('count');
			params.amount = t.data('amount');
			params.user_id = t.data('user-id');
			$.ajax({
				url: '<?php echo $this->webroot; ?>admin/ajax_approve_epin_request',
				type: 'POST',
				data: params,
				beforeSend: function() {
					$('#requests-container').append(ajax_loader);
				},
				success: function (result) {
					result_o = result;
					result = JSON.parse(result);
					$('.ajax-loader').remove();
					if(result['success']) {
						get_requests({});
						show_alerts({alerts: get_alert('success', 'Transaction saved.'), anchor: $('#content'), insert_type: 'prepend'});
					}
					else if(!result['success']){
						show_alerts({alerts: get_alert('error', 'There are not enough epins. Generate epins first.'), anchor: $('#content'), insert_type: 'prepend'});
					}
					else {
						show_alerts({alerts: get_alert('error', 'Something went wrong.'), anchor: $('#content'), insert_type: 'prepend'});
						console.log(result_o);
					}
				}
			});
			return false;
		});

		function get_requests(params) {
			$.ajax({
				url: '<?php echo $this->webroot; ?>admin/ajax_epin_requests',
				type: 'POST',
				data: params,
				beforeSend: function() {
					$('#requests-container').append(ajax_loader);
				},
				success: function (result) {
					$('#requests-container').html(result);
				}
			});
		}
	});
</script>
