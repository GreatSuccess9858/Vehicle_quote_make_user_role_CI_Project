var main_login = {
	/* incio main ********************/
	init: function() {},


	init_form_register_tutor: function() {

		jQuery(".bloque-facturacion").hide();
		jQuery(".bloque-colegio").hide();
		//if(jQuery("#factura_flag").is(":checked")

		jQuery("body").on('change', '#tipo_tutor', function(event) {
			console.log(321);
			if (jQuery(this).find("option:selected").val() == 2) {
				jQuery(".bloque-colegio").show();
			} else {
				jQuery(".bloque-colegio").hide();
			}
			//event.preventDefault();
			/* Act on the event */
		});

		jQuery("body").on('change', '#factura_flag', function(event) {
			console.log(123);
			if (jQuery(this).is(":checked")) {
				jQuery(".bloque-facturacion").show();
			} else {
				jQuery(".bloque-facturacion").hide();
			}
			//event.preventDefault();
			/* Act on the event */
		});
	}
	/* fin de main************************/
};


jQuery(function() {



	switch (_controller) {

		case "register_tutor":
			switch (_action) {
				case "index":
					main_login.init_form_register_tutor();
					break;
				case "index_gestor":

					break;
			}

			break;

		case "instancias":
			switch (_action) {
				case "atender_panel":

					break;
			}
			break;
	}


});