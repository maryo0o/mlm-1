<style type="text/css">
	#epins-container {
		position: relative;
	}
</style>
<?php echo $this->element('home_stories'); ?>
<hr>
<div class="row">
	<div class="col-md-3">
		<?php echo $this->element('home_site_links'); ?>
	</div>
	<div class="col-md-9">
		<h4>My Account</h4>
		<div id="epins-container"></div>
	</div>
</div>

<script type="text/javascript">
	$(function() {
		get_epins({});

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
				get_epins(params);
			}
			return false;
		});

		function get_epins(params) {
			$.ajax({
				url: '<?php echo $this->webroot; ?>pages/ajax_get_epins',
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
