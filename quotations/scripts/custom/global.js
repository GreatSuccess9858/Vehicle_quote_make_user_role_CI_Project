function load_notifications() 
{
	
	$.ajax({
		url: global_base_url + "home/load_notifications",
		beforeSend: function () { 
		$('#loading_spinner_notification').fadeIn(10);
		$("#ajspinner_notification").addClass("spin");
	 	},
	 	complete: function () { 
		$('#loading_spinner_notification').fadeOut(10);
		$("#ajspinner_notification").removeClass("spin");
	 	},
		data: {
		},
		success: function(msg) {
			$('#notifications-scroll').html(msg);
		}

	});
	console.log("Done");
}

function load_notifications_unread() 
{
	$.ajax({
		url: global_base_url + "home/load_notifications_unread",
		beforeSend: function () { 
		$('#loading_spinner_notification').fadeIn(10);
		$("#ajspinner_notification").addClass("spin");
	 	},
	 	complete: function () { 
		$('#loading_spinner_notification').fadeOut(10);
		$("#ajspinner_notification").removeClass("spin");
	 	},
		data: {
		},
		success: function(msg) {
			$('#notifications-scroll').html(msg);
			return false;
		}

	});
	console.log("Done");
}


function load_notification_url(id) 
{
	window.location.href= global_base_url + "home/load_notification/" + id;
	return;
}

$(document).ready(function() {

	$('.dropdown-menu #noti-click-unread').click(function(e) {
	    e.stopPropagation();
	});
	if(navigator.appVersion.indexOf("Win")!=-1) {
		$('#notifications-scroll').niceScroll({touchbehavior: false, zindex: 9999999999});
	}
});