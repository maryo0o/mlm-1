$(function() {
	$(".alert").fadeTo(2000, 500).slideUp(1200, function(){
		$(".alert").alert('close');
	});


	/*FORM VALIDATION EVENTS*/
	$('body').on('focusin', '.form-group.has-error', function () {
		var t = $(this);
		t.removeClass('has-error');
		t.find('p').remove();
	});

	$('body').on('focusout', '[data-validate]', function () {
		validate($(this));
	});

	$('body').on('submit', '[data-form]', function () {
		var t = $(this);
		t.find('[data-validate]').each(function () {
			$(this).closest('.form-group').removeClass('has-error');
			$(this).siblings('p').remove();
			validate($(this));
		});
		return false;
	});

	function validate(t) {
		var fields = t.data('validate').split('|');
		var test_others = false;
		var index = in_array('required', fields);
		if(index != null) {
			if(t.val().length == 0)
				set_error(t, 'Field must not be empty.');
			else
				test_others = true;
			fields.splice(index, index+1);
		}
		else
			test_others = true;

		if(test_others)	{
			for (var i in fields) {
				field = fields[i].trim();
				switch(field) {
					case 'username':
						var regex = /^[a-z0-9_-]{6,18}$/;
						if(t.val().length < 6 | t.val().length > 18)
							set_error(t, 'Username must be between 6 and 18 characters.');
						else if(!regex.test(t.val()))
							set_error(t, 'Username must contain only letters, numbers, and underscores.');
						break;
					case 'password':
						var regex = /^[a-z0-9_-]{6,18}$/;
						if(t.val().length < 6 | t.val().length > 18)
							set_error(t, 'Password must be between 6 and 18 characters.');
						else if(!regex.test(t.val()))
							set_error(t, 'Password must contain only letters, numbers, and underscores.');
						break;
					case 'confirm-password':
						if(t.val() != $(t.data('password')).val())
							set_error(t, '\'Confirm password\' and \'Password\' do not match.');
						break;
					case 'email':
						var regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
						if(!regex.test(t.val()))
							set_error(t, 'Invalid email address.');
						break;
				}
			}
		}
	}

	function set_error(e, message) {
		e.closest('.form-group').addClass('has-error');
		e.after('<p>' + message + '</p>');
	}

	function isset(e) {
		if(typeof(e) != "undefined" && e !== null)
			return true;
		return false;
	}

	function in_array(needle, haystack) {
		for(var i in haystack)
			if(haystack[i] == needle)
				return i;
		return null;
	}

	jQuery.extend({
		request_action: function(vars) {
			var result = null;
			if(!isset(vars['async']))
				vars['async'] = true;
			$.ajax({
				url: vars['url'],
				type: 'POST',
				async: vars['async'],
				data: vars['data'],
				success: function(data) {
					result = data;
				}
			});
			return result;
		}
	});
	/*END FORM VALIDATION EVENTS*/

});