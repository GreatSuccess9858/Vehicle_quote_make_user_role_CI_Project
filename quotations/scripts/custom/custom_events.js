jQuery("body").on('custom__close_instancia_alumno', function(event, form, divparams) {

	console.log(form);
	jQuery(form).html('');

	event.preventDefault();
	/* Act on the event */
});

jQuery("body").on('custom__table', '#table', function(event) {

	main.table__informe_cotizaciones_update();
	/* Act on the event */
});
jQuery("body").on('custom__show_info', function(event, form, divparams, response) {
	//event.preventDefault();
	/* Act on the event */
	jQuery(".page-1").hide();
	jQuery(".page-2").hide();
	jQuery(".page-3").show();
	jQuery(".page-3").html(response.html);
	jQuery(form).trigger("reset");

});
//custom__form_costos
jQuery("body").on('custom__reload_costos', function(event) {
	main.init__reload_costos();
	console.log("Hacemos un update ne la tabla de costos");
	event.preventDefault();
	/* Act on the event */
});
jQuery("body").on('custom__form_costos', function(event, form, divparams, response) {

	console.log("log....");
	is_update = response.is_update;

	if (is_update) {} else {
		jQuery(form).trigger('reset');
	}
	_helper_trigger("custom__reload_costos");
	event.preventDefault();
	/* Act on the event */
});

jQuery("body").on('custom__reload_cotizacion', function(event) {
	main.init__reload_cotizaciones();
	/* Act on the event */
});
jQuery("body").on('custom__form_add_cotizacion', function(event, form, divparams, response) {
	modal = jQuery(form).closest('.modal');

	jQuery(modal).modal("hide");
	main.init__reload_cotizaciones();
	/* Act on the event */
});


jQuery("body").on('custom__reload_table_links', function(event, form, divparams, response) {

	grid.bootgrid('reload');
	jQuery(form).find("#reset").trigger('click');
	jQuery(form).find("select").each(function(index, el) {
		jQuery(this).val("").trigger('change');
	});

	/* Act on the event */
});

/******************************************************/
/*****************************************************/

jQuery("body").on('custom__new_line', function(event) {

	main.custom__init_numbers();
	main.init_cotizacion_form__productos();

	/* Act on the event */
});

jQuery("body").on('custom__update_row', function(event, element) {

	main.update_row_cotizacion(element);
	/* Act on the event */
});


jQuery("body").on('custom__update_form_cotizacion', function(event, form, params, response) {

	main.custom__update_form_cotizacion(form, params, response);
	/* Act on the event */
});

jQuery("body").on('custom__finish_add_proyectos', function(event, form, params, response) {


	/* vamos a redireccionar a la pagina de edicion*/
	if (response.proyectos_id > 0) {

		document.location.href = _site_url + '/proyectos/detalles/' + response.proyectos_id
	}
	/* Act on the event */
});