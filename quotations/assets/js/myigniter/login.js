; 'use strict';
$(document).ready(function() {
	var loginBtn = $('#loginBtn');
	loginBtn.click(function () {
		var response = grecaptcha.getResponse();
		if (response.length == 0) {
            //recaptcha failed validation
            alertify.alert("Gulden Trader Alert: ", "please check I'm not a robot box");
            return false;
        }
    });

    $('input').iCheck({ checkboxClass: 'icheckbox_square-blue' });
});