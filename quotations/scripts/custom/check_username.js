function checkUsername() {
	var username = $('#username').val();
	if(username.length > 0) {
		$.ajax({
			url: global_base_url + "register/check_username",
			type: "get",
			data: {
				"username" : username
			},
			success: function(msg) {
				$('#username_check').html(msg);
			}
		});
	} else {
		$('#username_check').html('');
	}
}

$(document).ready(function() {
	$('#username').change(function() {
		checkUsername();
	});
});