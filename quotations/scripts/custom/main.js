var grid;
var informe_cotizaciones__pie, informe_cotizaciones__pie_config;


jQuery.validator.addMethod("cantidadminima", function(value, element) {
	cantidad_1 = jQuery(element).closest('tr').attr("data-cantidad-1");

	cantidad_1 = parseInt(cantidad_1);

	return this.optional(element) || (value >= cantidad_1);
}, "* ");


function format(state) {
	var originalOption = state.element;

	console.log(state);

	html = '<div> <strong>' + state.text + '</strong></div>';
	return '';
}


var main = {
	/* incio main ********************/
	verifica: function() {

		t = jQuery("#form-ingreso").valid();

		if (t) {
			return confirm('Esta seguro de realizar el registro?');
		} else {
			return false;
		}
	},
	init: function() {
		/* activando date */
		$('#datetimepicker3').datetimepicker({ format: 'YYYY-MM-DD' });
		$('#datetimepicker4').datetimepicker({ format: 'YYYY-MM-DD' });
		/* evento para el   checkbox maniobras */
		jQuery("body").on('change', '#maniobras', function(event) {
				event.preventDefault();
				if(jQuery(this).is(":checked")){
					jQuery('#maniobras_importe').removeAttr("disabled");
				}else{
					jQuery('#maniobras_importe').attr("disabled","disabled");
				}
				/* Act on the event */
			});
		/*init evento imagen de vehiculo*/
		jQuery("body").on('change', '#vehiculos_id', function(event) {
		 	event.preventDefault();
			id = jQuery(this).val();
		 	$.ajax({
		 		url: _site_url+'/config/vehiculo_image/',
		 		type: 'post',
		 		dataType: 'html',
		 		data: {id: id},
		 	})
		 	.done(function(html) {
				  jQuery(".vehiculo-image").html(html);
		 	})
		 	.fail(function() {
		 		console.log("error");
		 	})
		 	.always(function() {
		 		console.log("complete");
		 	});
		 	
		 	/* Act on the event */
		 });
		$('.numeric').numeric();
		jQuery("body").on('click', '.js-ingreso', function(event) {


			jQuery(".page-1").hide();
			jQuery(".page-2").show();
			jQuery(".page-3").hide();
			event.preventDefault();
			/* Act on the event */
		});

		jQuery("body").on('click', '.js-cancelar', function(event) {


			jQuery(".page-1").show();
			jQuery(".page-2").hide();
			jQuery(".page-3").hide();
			event.preventDefault();
			/* Act on the event */
		});

		/* validate para las SEDES EN EL REGISTER*/
		$(document).ready(function() {

			$('#js-validation--custom-1').validate({ // initialize the plugin
				rules: {
					'sedes[]': {
						required: true,

					}
				},
				messages: {
					'sedes[]': {
						required: "",

					}
				}
			});

		});

		$.each($('form.js-validation'), function(index, el) {
			console.log(" append.. data validate loaded ");
			jQuery(this).attr("data-validate-loaded", 1);
			$(this).validate();



		});

		/**/
		this.init_table_cotizacion();
		this.init_cotizacion_form();
		this.init_button_delete();


		this.init_button_submit();
	},
	init_button_submit: function() {
		jQuery("body").on('click', '.js-submit', function(event) {
			id = jQuery(this).attr("data-target");
			jQuery(this).closest(".modal").find(id).trigger("click");
			//jQuery(id).trigger("click");
			event.preventDefault();
			/* Act on the event */
		});
	},
	init_button_delete: function() {
		jQuery("body").on('click', '.btn-tr-delete', function(event) {

			jQuery(this).closest('tr').fadeOut('fast', function() {
				jQuery(this).remove();
			});
			/* Act on the event */
		});
	},
	init_table_instancias_tutor: function() {

	},
	init_cotizacion_form: function() {
		this.init_cotizacion_form_empresas();
		this.init_cotizacion_form_clientes();
		this.init_cotizacion_form__productos();
		this.init_change_cantidad();
		this.init_input_cantidad();
		this.init_form_impuesto();
		this.custom__init_numbers();
		this.init_table_proyectos();
	},
	custom__init_numbers: function() {
		//$('.money').simpleMoneyFormat();
		$('.money.not-load').removeClass('not-load').addClass("loaded").number(true, 4);

	},
	custom__update_form_cotizacion: function(form, params, response) {

		if (response.cotizacion_id > 0) {

			location.href = _site_url + "/cotizacion/operacion/" + response.cotizacion_id;
			jQuery("#cotizacion_id").val(response.cotizacion_id);
			jQuery("#title-update").html("Actualizar Cotización #" + response.cotizacion_id).show();
			jQuery("#title-update").removeClass('hidden');
			jQuery("#title-create").addClass('hidden');
			jQuery(".btn-cotizacion-preview").removeAttr('disabled').removeProp('disabled');
			jQuery(".btn-cotizacion-send").removeAttr('disabled').removeProp('disabled');
		} else {
			jQuery("#title-create").removeClass('hidden');
			jQuery("#title-update").addClass('hidden');
		}


	},
	init_table__informe_cotizaciones: function() {
		/* este plugin no  e smuy versatil */
		/*$('.table-cotizaciones').excelTableFilter({
			columnSelector: '.apply-filter', // (optional) if present, will only select <th> with specified class
			sort: true, // (optional) default true
			search: true // (optional) default true
			//captions: Object                    // (optional) default { a_to_z: 'A to Z', z_to_a: 'Z to A', search: 'Search', select_all: 'Select All' }
		});
		*/
	},
	init_cotizacion_form_empresas: function() {
		jQuery("body").on('change', '#empresas_id', function(event) {
			event.preventDefault();
			empresas_id = jQuery(this).val();
			$.ajax({
					url: _site_url + '/cotizacion/get_clientes',
					type: 'POST',
					dataType: 'json',
					data: {
						empresas_id: empresas_id
					},
				})
				.done(function(data) {
					console.log("success");
					jQuery("#clientes_id").html(data.html);
					/* si existe la variable se setea en automatico*/
					if (clientes_id > 0) {

						jQuery("#clientes_id").val(clientes_id);
						jQuery("#clientes_id").trigger('change');
					}

				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});

			/* Act on the event */
		});

		/* si  existe la variable se setea el valor.*/
		if (typeof cotizacion_id !== 'undefined' && cotizacion_id > 0) {
			jQuery("#empresas_id").trigger('change');
		}
		/*  formulario de envio*/

		jQuery("#emails").tagThis({
			email: true,
			noDuplicates: true,
			callbacks: {
				afterAddTag: function() {
					tags = jQuery("#emails").data("tags");
					_temp = '';
					$.each(tags, function(index, el) {
						console.log(this.text);
						_temp = _temp + ',' + this.text;

					});
					jQuery("#lista-emails").val(_temp);
				},
				afterRemoveTag: function() {
					tags = jQuery("#emails").data("tags");
					_temp = '';
					$.each(tags, function(index, el) {
						console.log(this.text);
						_temp = _temp + ',' + this.text;

					});
					jQuery("#lista-emails").val(_temp);
				}
			}
		});
	},
	init_cotizacion_form_clientes: function() {
		jQuery("body").on('change', '#clientes_id', function(event) {
			event.preventDefault();
			clientes_id = jQuery(this).val();
			$.ajax({
					url: _site_url + '/cotizacion/get_cliente',
					type: 'POST',
					dataType: 'json',
					data: {
						clientes_id: clientes_id
					},
				})
				.done(function(data) {
					console.log("success");
					jQuery("#js-info-cliente").html(data.html)
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});

			/* Act on the event */
		});
	},
	init_cotizacion_form__productos: function() {
		/*
		$.fn.select2.amd.require([
			'select2/data/array',
			'select2/utils'
		], function(select2ArrayData, select2Utils) {

			var CustomData = function($element, options) {
				CustomData.__super__.constructor.call(this, $element, options);
			};

			select2Utils.Extend(CustomData, select2ArrayData);

			CustomData.prototype.current = function(callback) {
				var $element = this.$element;
				var currentVal = $element.val();
				// - do whatever you need to load the data needed to create data objects

				// callback with array of data objects
				callback([{
					id: '1',
					text: 'result 1'
				}, {
					id: '3',
					text: 'result 3'
				}]);
			};

			CustomData.prototype.query = function(params, callback) {
				var searchTerm = params.term;
				var page = params.page || 1;

				// - do whatever you need to get your data -

				var resp = {
					// these are your results
					results: [{
						id: '1',
						text: 'result 1'
					}, {
						id: '2',
						text: 'result 2'
					}],
					pagination: {
						// this means there are additional pages to load, set to false if not
						more: true
					}
				};

				callback(resp);
			};

		});

		*/

		$.fn.select2.amd.require(['select2/data/array', 'select2/utils'], function(ArrayData, Utils) {
			function CustomData($element, options) {
				CustomData.__super__.constructor.call(this, $element, options);
			}
			Utils.Extend(CustomData, ArrayData);
			CustomData.prototype.current = function(callback) {
				var data = [];
				var currentVal = this.$element.val();
				if (!this.$element.prop('multiple')) {
					currentVal = [currentVal];
				}
				for (var v = 0; v < currentVal.length; v++) {
					data.push({
						id: currentVal[v],
						text: currentVal[v]
					});
				}
				callback(data);
			};
			/*$(".js-select2-form").select2({
				dataAdapter: CustomData
			});*/
		});

		function processData(data) {
			if (data.length <= 0) {
				return {
					results: null
				};
			}
			var mapdata = $.map(data, function(obj) {
				/*obj.id = obj.id;
				obj.text = '[' + obj.Code + '] ' + obj.Description;*/
				return obj;
			});
			return {
				results: mapdata
			};
		}
		jQuery(".js-select2-form").not(".load").each(function(index, el) {
			console.log(index + " = add... new select2");
			_this = this;
			init = jQuery(_this).attr("data-init");
			console.log(init);
			if (typeof init === "undefined") {
				t = {
					id: -100,
					codigo: '',
					text: 'Seleccione'
				};
			} else {
				t = JSON.parse(init);
			}

			jQuery(this).addClass('load').select2({
				//dataAdapter: CustomData,
				data: processData([t]).results,
				width: '100%',
				templateResult: function(response) {
					console.log(response);
					if (!response.id) return response.text;

					data = response;


					this.description =
						"<div class='card-producto'>" +
						"<div class='title'> [" + data.codigo + "] " + data.text + "</div>" +
						"<div>" +
						"<img src='/productos/" + data.imagen + "'>" +

						"<div class='description'  > " + data.descripcion + " </div>" +
						"</div>" +
						'</div>';
					return this.description;
				},
				templateSelection: function(response) {
					data = response;
					jQuery(response.element).closest('tr').attr("data-precio-1", data.precio_1);
					jQuery(response.element).closest('tr').attr("data-precio-2", data.precio_2);
					jQuery(response.element).closest('tr').attr("data-precio-3", data.precio_3);
					jQuery(response.element).closest('tr').attr("data-precio-4", data.precio_4);
					jQuery(response.element).closest('tr').attr("data-precio-5", data.precio_5);


					jQuery(response.element).closest('tr').attr("data-cantidad-1", data.cantidad_1);
					jQuery(response.element).closest('tr').attr("data-cantidad-2", data.cantidad_2);
					jQuery(response.element).closest('tr').attr("data-cantidad-3", data.cantidad_3);
					jQuery(response.element).closest('tr').attr("data-cantidad-4", data.cantidad_4);
					jQuery(response.element).closest('tr').attr("data-cantidad-5", data.cantidad_5);



					jQuery(response.element).closest('tr').find('.fila-cantidad').attr("title", "Minimo aceptado " + data.cantidad_1);
					jQuery(response.element).closest('tr').find('.fila-cantidad').attr('data-original-title', "Minimo aceptado " + data.cantidad_1);

					jQuery(response.element).closest('tr').find('.fila-cantidad').tooltip();

					setTimeout(function() {
						_helper_trigger("custom__update_row", response.element);
					}, 500);

					if (typeof data.imagen === 'undefined') {
						img = '';
					} else {
						img = "<img src='/productos/" + data.imagen + "'>";
					}
					return "<div class='card-producto-selected'>" +
						"<div>" +


						img +
						"<div class='title'> [" + data.codigo + "] " + data.text + "</div>" +

						//"<div class='description'  > " + data.descripcion + " </div>" +
						"</div>" +
						'</div>';
				},
				escapeMarkup: function(m) {
					return m;
				},
				dropdownCssClass: "bigdrop",
				ajax: {
					dataType: 'json',
					url: _site_url + '/productos/get_ajax',

					quietMillis: 250,
					current: function() {
						console.log(55555);
					},

				},

			});


		});



	},
	table__informe_cotizaciones_data: function() {
		tr = jQuery("#table tbody tr:visible");
		var a = 0,
			b = 0,
			c = 0;
		jQuery.each(tr, function(index, val) {

			//iterate through array or object
			a = a + parseInt(jQuery(this).find('td').eq(1).text());
			b = b + parseInt(jQuery(this).find('td').eq(2).text());
			c = c + parseInt(jQuery(this).find('td').eq(3).text());
			console.log([a, b, c]);
		});
		return [a, b, c];
	},
	table__informe_cotizaciones_update: function() {

		//informe_cotizaciones__pie_config.data.datasets.data = main.table__informe_cotizaciones_data();

		informe_cotizaciones__pie_config.data.datasets.forEach(function(dataset) {
			dataset.data = main.table__informe_cotizaciones_data();
		});

		informe_cotizaciones__pie.update()
	},
	table__informe_cotizaciones: function() {

		informe_cotizaciones__pie_config = {
			"type": "doughnut",
			"data": {
				"labels": ["Pendiente", "Aprobados", "Rechazado"],
				"datasets": [{
					"label": "Cotizaciones",
					"data": main.table__informe_cotizaciones_data(),
					"backgroundColor": ["orange", "green", "red"]
				}]
			},
			options: {
				cutoutPercentage: 0,
				legend: {
					display: true,

				},

				tooltips: {
					callbacks: {
						label: function(tooltipItem, data) {
							var dataset = data.datasets[tooltipItem.datasetIndex];
							var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
								return previousValue + currentValue;
							});
							var currentValue = dataset.data[tooltipItem.index];
							var precentage = Math.floor(((currentValue / total) * 100) + 0.5);
							str = "(" + currentValue + "  cotizaciones)"
							if (currentValue == 1) {
								str = "(" + currentValue + " cotizacion )";
							}
							return precentage + "% " + str;
						}
					}
				},
				plugins: {
					labels: {
						render: 'percentage',
						fontColor: ['white', 'white', 'white'],
						precision: 2
					}
				},
			}
		};

		window.onload = function() {



			ctx = jQuery("#myChart");
			informe_cotizaciones__pie = new Chart(ctx, informe_cotizaciones__pie_config);

		};

	},
	update_row_cotizacion: function(element) {
		var _temp = [];
		console.log("update row producto....");
		var subtotal = 0;
		_tipo_cambio = jQuery("#tipo_cambio").val();
		if (_tipo_cambio == '') {
			_tipo_cambio = 1;
		}
		jQuery("table#tabla_productos tr").each(function(index, el) {

			cantidad = jQuery(this).find(".fila-cantidad").val();
			descuento = jQuery(this).find('.control-descuento').val();
			//descuento=descuento
			//jQuery(this).find(".fila-cantidad").valid();
			if (cantidad != '' && cantidad > 0) {


				data = jQuery(this).find("select.fila-producto-id").select2("data")[0];
				console.log("ITERANDO....");
				//console.log(data);
				precio = 0;
				cantidad = parseInt(cantidad);
				descuento = parseFloat(descuento);
				if (typeof data != "undefined") {
					if (data.cantidad_1 <= cantidad && cantidad < data.cantidad_2) {
						precio = data.precio_1;
					}
					if (data.cantidad_2 <= cantidad && cantidad < data.cantidad_3) {
						precio = data.precio_2;
					}
					if (data.cantidad_3 <= cantidad && cantidad < data.cantidad_4) {
						precio = data.precio_3;
					}
					if (data.cantidad_4 <= cantidad && cantidad < data.cantidad_5) {
						precio = data.precio_4;
					}
					if (data.cantidad_5 <= cantidad) {
						precio = data.precio_5;
					}

					//if (data.cantidad_1 > cantidad) {
					//error
					//campo = jQuery(element).closest('tr').find('.fila-cantidad');


					jQuery(this).find(".fila-cantidad").attr("title", "Minimo aceptado " + data.cantidad_1);
					jQuery(this).find(".fila-cantidad").attr('data-original-title', "Minimo aceptado " + data.cantidad_1);

					/*jQuery(campo).tooltip('show');
					_temp[index] = jQuery(campo);
					setTimeout(function() {
						_temp[index].tooltip('hide');

					}, 2000, index);
						*/
					if (data.cantidad_1 > cantidad) {
						//jQuery(this).find(".fila-cantidad").addClass('error');
					} else {
						//jQuery(this).find(".fila-cantidad").removeClass('error');
					}

					//}
				}

				if (descuento > 0) {


					nuevo_precio = (parseFloat(descuento).toFixed(_decimals)) * parseFloat(cantidad).toFixed(_decimals);
				} else {

					nuevo_precio = parseFloat(precio).toFixed(_decimals) * parseFloat(cantidad).toFixed(_decimals);

				}



				jQuery(this).find('.fila-precio').html(_format_number(precio, 'USD'));
				subtotal = parseFloat(subtotal);
				subtotal = nuevo_precio + subtotal;


				jQuery(this).find('.fila_total').html(_format_number(nuevo_precio.toFixed(_decimals), "USD"));
			}
		});

		/********************************************************/

		impuesto = (jQuery("#impuesto").val());

		if (impuesto == "" || impuesto == 0) {
			impuesto = 0;
		} else {
			impuesto = impuesto.trim();
			impuesto = parseFloat(impuesto)

		}
		impuesto_original = impuesto;
		impuesto_total = subtotal * impuesto_original / 100;

		impuesto = impuesto + 100;
		total = subtotal * impuesto / 100

		jQuery("#subtotal").html(_format_number(subtotal.toFixed(_decimals), "USD"));
		jQuery("#impuesto_total").html(_format_number(impuesto_total.toFixed(_decimals), "USD"));
		jQuery("#total").html(_format_number(total.toFixed(_decimals), "USD"));

		/**/
		if (_tipo_cambio != 1) {
			subtotal_2 = subtotal * _tipo_cambio;
			impuesto_total_2 = impuesto_total * _tipo_cambio;
			total_2 = total * _tipo_cambio;

			_moneda_id = jQuery("#moneda_id").val();
			jQuery("#subtotal_2").html(_format_number(subtotal_2.toFixed(_decimals), _moneda_id));
			jQuery("#impuesto_total_2").html(_format_number(impuesto_total_2.toFixed(_decimals), _moneda_id));
			jQuery("#total_2").html(_format_number(total_2.toFixed(_decimals), _moneda_id));
		} else {
			jQuery("#subtotal_2").html('');
			jQuery("#impuesto_total_2").html('');
			jQuery("#total_2").html('');
		}

		/********************************************************/
	},
	init_change_moneda_id: function() {
		jQuery("body").on('change', '#moneda_id', function(event) {
			_val = jQuery(this).val();
			_tipo_cambio = devises['USD' + _val];
			jQuery("#tipo_cambio").val(_tipo_cambio);
			_helper_trigger("custom__update_row", this);
			event.preventDefault();
			/* Act on the event */
		});
	},
	init_change_cantidad: function() {
		_self_ = this;
		jQuery("body").on('keypress input keyup ', '.fila-cantidad', function(event) {


			_this = jQuery(this);
			_helper_trigger("custom__update_row", _this);
			/* Act on the event */
		});


		jQuery("body").on('keypress input keyup ', '.control-descuento', function(event) {


			_this = jQuery(this);
			_helper_trigger("custom__update_row", _this);
			/* Act on the event */
		});
		//tipo_cambio
		jQuery("body").on('keypress input keyup ', '#tipo_cambio', function(event) {


			_this = jQuery(this);
			_helper_trigger("custom__update_row", _this);
			/* Act on the event */
		});
		jQuery("body").on('click', '.btn-clear-precio-descuento', function(event) {


			jQuery(this).closest("div").find("input").val(0.00000);

			_this = jQuery(this);
			_helper_trigger("custom__update_row", _this);


		});

		$(".fila-cantidad").each(function(index, el) {
			$(this).tooltip({}); //.tooltip('show');
		});
	},
	init_input_cantidad: function() {



		jQuery("body").on('keypress input keyup', 'input.fila-cantidad', function(evt) {

			var theEvent = evt || window.event;

			// Handle paste
			if (theEvent.type === 'paste') {
				key = event.clipboardData.getData('text/plain');
			} else {
				// Handle key press
				var key = theEvent.keyCode || theEvent.which;
				key = String.fromCharCode(key);
			}
			var regex = /[0-9]/;
			if (!regex.test(key)) {
				theEvent.returnValue = false;
				if (theEvent.preventDefault) theEvent.preventDefault();
			}
		});

	},
	init_form_impuesto: function() {
		jQuery("body").on('change', '#impuesto', function(event) {
			_this = jQuery(this);
			_helper_trigger("custom__update_row", _this);
			/* Act on the event */
		});
	},
	init_table_cotizacion: function() {
		$("#grid-data").bootgrid({
			ajax: true,
			post: function() {
				/* To accumulate custom parameter with the request object */
				return {
					id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
				};
			},
			url: _site_url + "/cotizacion/ajax_list",
			formatters: {
				"link": function(column, row) {
					return "<a href=\"" + _site_url + "/cotizacion/operacion/" + row.cotizacion_id + "\" class='btn btn-primary btn-xs js-detalles'>" + " Detalles" + " </a>";
				},
				"status": function(column, row) {
					switch (row.status_row) {
						case "0":
							text = "Pendiente";
							label = 'warning';
							break;
						case "1":
							text = "APROBADO";
							label = 'success';
							break;
						case "-1":
							text = "Observado";
							label = 'danger';
							break;
						case "2":
							text = "DENEGADO";
							label = 'danger';
							break;

						case "3":
							text = "Aprobado";
							label = 'success';
							break;
						default:
							text = "-";
							label = 'warning';
							break;



					}
					return '<label class="label label-' + label + '">' + '' + '  ' + text + '</label>';
				}
			}
		});
	},
	init_finalizar_proyecto: function() {


		jQuery("body").on('click', '.js-finalizar-proyecto', function(event) {

			$.confirm({
				title: "Confirmar",
				content: "si usted finaliza este proyecto, solo podra ser re-abierto por un administrador. ¿Desea finalizar el proyecto?",
				buttons: {
					Ok: {
						text: 'Ok',
						btnClass: 'btn-blue',
						keys: ['enter', 'shift'],
						action: function() {

							$.ajax({
									url: _site_url + '/proyectos/finalizar_proyecto/',
									type: 'POST',
									dataType: 'json',
									data: {
										proyectos_id: jQuery("#global_proyectos_id").val()
									},
								})
								.done(function(data) {

									if (data.error == 1) {
										alert(data.message)
									} else {
										alert(data.message)
										location.reload();
									}

								})
								.fail(function() {
									console.log("error");
								})
								.always(function() {
									console.log("complete");
								});


						}
					},
					cancel: function() {

					},

				}
			});


			/* Act on the event */
		});

		jQuery("body").on('click', '.js-reabrir-proyecto', function(event) {

			$.confirm({
				title: "Confirmar",
				content: "  ¿Desea Re-abrir el proyecto?",
				buttons: {
					Ok: {
						text: 'Ok',
						btnClass: 'btn-blue',
						keys: ['enter', 'shift'],
						action: function() {

							$.ajax({
									url: _site_url + '/proyectos/finalizar_proyecto/1',
									type: 'POST',
									dataType: 'json',
									data: {
										proyectos_id: jQuery("#global_proyectos_id").val()
									},
								})
								.done(function(data) {

									if (data.error == 1) {
										alert(data.message)
									} else {
										alert(data.message)
										location.reload();
									}

								})
								.fail(function() {
									console.log("error");
								})
								.always(function() {
									console.log("complete");
								});


						}
					},
					cancel: function() {

					},

				}
			});


			/* Act on the event */
		});

	},
	init_table_proyectos: function() {
		$("#grid-data-proyectos").bootgrid({
			ajax: true,
			post: function() {
				/* To accumulate custom parameter with the request object */
				return {
					id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
				};
			},
			url: _site_url + "/proyectos/ajax_list",
			formatters: {
				"link": function(column, row) {
					return "<a href=\"" + _site_url + "/proyectos/detalles/" + row.proyectos_id + "\" class='btn btn-primary btn-xs js-detalles'>" + " Detalles" + " </a>";
				},
				"status": function(column, row) {
					switch (row.status_row) {
						case "0":
							text = "INICIADO";
							label = 'warning';
							break;
						case "1":
							text = "Entregado y cobrado";
							label = 'default';
							break;
						case "2":
							text = "En produccion";
							label = 'success';
							break;
						case "3":
							text = "Entregado por cobrar";
							label = 'warning';
							break;

						case "4":
							text = "Con inconvenientes";
							label = 'danger';
							break;
						default:
							text = "-";
							label = 'warning';
							break;



					}
					return '<label class="label label-' + label + '">' + '' + '  ' + text + '</label>';
				}
			}
		});
	},
	init_js_atender: function() {
		console.log("init_js_atender....");
		/*
		jQuery("body").on('click.rs.jquery.bootgrid', 'a.js-atender', function(event) {
			console.log("hola-..");
			$.confirm({
				title: "Confirmar",
				content: "¿Desea atender esta solicitud?"
			});


			event.preventDefault();
			 
		});*/
	},
	init_js_flag: function() {
		grid = jQuery("body").on('change', '.js_flag', function(event) {

			id = jQuery(this).attr("name");
			if (id == "status") {
				if (jQuery(this).is(':checked')) {

					jQuery(this).closest('form').find(".flag_datos").prop('checked', false);
					jQuery(this).closest('form').find(".flag_foto").prop('checked', false);
					jQuery(this).closest('form').find(".flag_partida").prop('checked', false);
				}
			}
			if (id == "flag_datos" || id == "flag_foto" || id == "flag_partida") {
				if (jQuery(this).is(':checked')) {

					jQuery(this).closest('form').find(".status").prop('checked', false);

				}
			}
			//jQuery(this).closest('form').find()
			jQuery(this).closest('form').find("button#submit").trigger('click');
			//event.preventDefault();
			/* Act on the event */
		});
	},
	init_table_proyectos_gestor: function() {
		grid = $("#grid-data").bootgrid({
			ajax: true,
			post: function() {
				/* To accumulate custom parameter with the request object */
				name = jQuery("#_token").attr("name");
				value = jQuery("#_token").val();
				_extra_post = {};
				_extra_post[name] = value;
				return _extra_post;
			},
			url: _site_url + "/proyectos/ajax_list",
			formatters: {
				"tutor_datos": function(column, row) {
					return row.tutor_nombres + ' ' + row.tutor_apellidos;
				},
				"usuario_datos": function(column, row) {

					if (row.usuario_nombres == null) {

						return '<label class="label label-success">' + 'Libre' + '  </label>';

					} else {

						return '<label class="label label-warning">' + row.usuario_nombres + ' ' + row.usuario_apellidos + '  </label>';

					}

				},
				"link": function(column, row) {
					return "<a href=\"" + _site_url + "/proyectos/detalles/" + row.id + "\" class='btn btn-primary btn-xs js-detalles'>" + " Detalles" + " </a>";
				},
				"status": function(column, row) {
					switch (row.status) {
						case "0":
							text = "Pendiente";
							label = 'warning';
							break;
						case "1":
							text = "En progreso";
							label = 'warning';
							break;
						case "-1":
							text = "Observado";
							label = 'danger';
							break;
						case "2":
							text = "Corregido";
							label = 'warning';
							break;

						case "3":
							text = "Aprobado";
							label = 'success';
							break;
						default:
							text = "-";
							label = 'warning';
							break;



					}
					return '<label class="label label-' + label + '">' + '' + '  ' + text + '</label>';
				}
			}
		}).on("loaded.rs.jquery.bootgrid", function() {
			/* Executes after data is loaded and rendered */
			grid.find(".js-detalles").on("click", function(e) {
				/*href = jQuery(this).attr("href");
				$.confirm({
					title: "Confirmar",
					content: "¿Dese atender esta instancia?",
					buttons: {
						Ok: {
							text: 'Ok',
							btnClass: 'btn-blue',
							keys: ['enter', 'shift'],
							action: function() {

								location.href = href;
							}
						},
						cancel: function() {
							//$.alert('Canceled!');
						},

					}
				});
				e.preventDefault();*/
				//alert("You pressed edit on row: " + $(this).data("row-id"));
			}).end().find(".command-delete").on("click", function(e) {
				alert("You pressed delete on row: " + $(this).data("row-id"));
			});
		});
	},
	init_time: function() {

		jQuery(".next_time").each(function(index, el) {
			$(this).datetimepicker({
				format: 'Y-M-D HH:mm:ss '
			});
		});
		jQuery(".custom-date").each(function(index, el) {
			supdiv = jQuery(this).closest('div');
			div = jQuery(this).closest('.div-custom-date');
			if (div.length <= 0) {
				div = jQuery("<div class='div-custom-date'> <i class='fa fa-calendar'></i></div>");
				jQuery(this).appendTo(div);
				jQuery(div).appendTo(supdiv);
			}
			$(this).datetimepicker({
				format: 'Y-M-D',

			});
		});

	},
	init_table_links_gestor: function() {
		grid = $("#grid-data").bootgrid({
			ajax: true,
			post: function() {
				/* To accumulate custom parameter with the request object */
				name = jQuery("#_token").attr("name");
				value = jQuery("#_token").val();
				_extra_post = {};
				_extra_post[name] = value;
				return _extra_post;
			},
			url: function() {
				proyectos_id = jQuery("#grid-data").attr("data-proyectos_id");
				return _site_url + "/proyectos/ajax_list_links/" + proyectos_id;
			},
			formatters: {
				"tutor_datos": function(column, row) {
					return row.tutor_nombres + ' ' + row.tutor_apellidos;
				},

				"link": function(column, row) {
					//links = "<a href=\"" + _site_url + "/links/forzar/" + row.id + "\" class='btn btn-primary btn-xs js-forzar'>" + " <span class='glyphicon glyphicon-refresh'></span>" + " </a>";
					links = '';
					links += " <a href=\"" + _site_url + "/links/ajax_delete/" + row.id + "\" class='btn btn-primary btn-xs js-delete'>" + " <span class='glyphicon glyphicon-trash'></span> " + " </a>";
					return links;

				},
				"status": function(column, row) {
					switch (row.status) {
						case "0":
							text = "Pendiente";
							label = 'warning';
							break;
						case "1":
							text = "En progreso";
							label = 'warning';
							break;
						case "-1":
							text = "Observado";
							label = 'danger';
							break;
						case "2":
							text = "Corregido";
							label = 'warning';
							break;

						case "3":
							text = "Aprobado";
							label = 'success';
							break;
						default:
							text = "-";
							label = 'warning';
							break;



					}
					return '<label class="label label-' + label + '">' + '' + '  ' + text + '</label>';
				}
			}
		}).on("loaded.rs.jquery.bootgrid", function() {
			/* Executes after data is loaded and rendered */
			grid.find(".js-forzar").on("click", function(e) {
				href = jQuery(this).attr('href');

				name = jQuery("#_token").attr("name");
				value = jQuery("#_token").val();
				_extra_post = {};
				_extra_post[name] = value;
				_extra_post;

				_loading_show();
				jQuery.ajax({
						url: href,
						type: 'POST',
						dataType: 'json',
						data: _extra_post,
					})
					.done(function(data) {
						console.log("success");
						$('#grid-data').bootgrid('reload');
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						_loading_hide();
						console.log("complete");
					});

				/*href = jQuery(this).attr("href");
				$.confirm({
					title: "Confirmar",
					content: "¿Dese atender esta instancia?",
					buttons: {
						Ok: {
							text: 'Ok',
							btnClass: 'btn-blue',
							keys: ['enter', 'shift'],
							action: function() {

								location.href = href;
							}
						},
						cancel: function() {
							//$.alert('Canceled!');
						},

					}
				});
				*/
				e.preventDefault();
				//alert("You pressed edit on row: " + $(this).data("row-id"));
			}).end().find(".js-delete").on("click", function(e) {
				//alert("You pressed delete on row: " + $(this).data("row-id"));
				_this = jQuery(this);
				$.confirm({
					title: "Confirmar",
					content: "¿Dese quitar el producto de este proyecto?",
					buttons: {
						Ok: {
							text: 'Ok',
							btnClass: 'btn-blue',
							keys: ['enter', 'shift'],
							action: function() {

								/***************************/
								href = jQuery(_this).attr('href');

								name = jQuery("#_token").attr("name");
								value = jQuery("#_token").val();
								_extra_post = {};
								_extra_post[name] = value;
								_extra_post;

								_loading_show();
								jQuery.ajax({
										url: href,
										type: 'POST',
										dataType: 'json',
										data: _extra_post,
									})
									.done(function(data) {

										$('#grid-data').bootgrid('reload');
									})
									.fail(function() {
										console.log("error");
									})
									.always(function() {
										_loading_hide();
										console.log("complete");
									});
								/***************************/
							}
						},
						cancel: function() {
							//$.alert('Canceled!');
						},

					}
				});
				e.preventDefault();
			});
		});
	},
	init_table_links_bases: function() {
	 
	},

	init_select2_form_agregar_link: function() {
		jQuery(".ajax_select2_sites").each(function(index, el) {

			jQuery(this).select2({
				ajax: {
					dataType: 'json',
					url: function(params) {

						url = jQuery(this).attr('data-url');

						//console.log(jQuery(this).attr('data-url'));
						//console.log(params);
						return url;
					}
				}
			});

		});
	},

	init_modal_agregar_link: function() {

		jQuery("body").on('shown.bs.modal', '#link-agregar', function(event) {
			var button = $(event.relatedTarget)
			modal_body = jQuery("#link-agregar .modal-body");
			_url = jQuery(button).attr("data-href");
			jQuery.ajax({
					url: _url,
					type: 'GET',
					dataType: 'html',
					data: {
						param1: 'value1'
					},
				})
				.done(function(data) {
					jQuery(modal_body).html(data);
					main.init_select2_form_agregar_link();
					_init_form();

				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});

			//event.preventDefault();
			/* Act on the event */
		});
	},
	init__reload_cotizaciones: function() {

		$.ajax({
				url: _site_url + '/proyectos/get_cotizaciones',
				type: 'POST',
				dataType: 'json',
				data: {
					proyectos_id: jQuery("#global_proyectos_id").val()
				},
			})
			.done(function(data) {
				jQuery("#js-panel-cotizaciones").html(data.html);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
	},
	init__reload_costos: function() {


		$.ajax({
				url: _site_url + '/proyectos/get_costos',
				type: 'POST',
				dataType: 'json',
				data: {
					proyectos_id: jQuery("#global_proyectos_id").val()
				},
			})
			.done(function(data) {
				jQuery("#js-panel-costos").html(data.html);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});

	},
	init_detalles__view_cotizacion: function() {
		jQuery("body").on('click', '.js-view-cotizacion', function(event) {


			id = jQuery(this).attr("data-id");

			$.ajax({
					url: _site_url + '/proyectos/view_cotizacion',
					type: 'post',
					dataType: 'json',
					data: {
						cotizacion_id: id,

					},
				})
				.done(function(data) {

					jQuery("#modal-js-view-cotizacion").find('.modal-body').html(data.html);
					/*
										$('.switch-button').bootstrapToggle()
										 
										_this_.custom__init_numbers();
										_this_.init_time();
										_init_form();
										
										*/

					jQuery("#modal-js-view-cotizacion").modal();
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});



			/* Act on the event */
		});
	},
	init_detalles__form_add_cotizacion: function() {

		jQuery("body").on('click', '#js-add-cotizacion', function(event) {


			$.ajax({
					url: _site_url + '/proyectos/form_add_cotizacion',
					type: 'post',
					dataType: 'json',
					data: {
						proyectos_id: jQuery("#global_proyectos_id").val()
					},
				})
				.done(function(data) {

					jQuery("#modal-js-add-cotizacion").find('.modal-body').html(data.html);

					$('.switch-button').bootstrapToggle()
					/* init detalles*/
					_this_.custom__init_numbers();
					_this_.init_time();
					_init_form();
					jQuery("#modal-js-add-cotizacion").modal();
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});



			/* Act on the event */
		});

	},
	init_detalles__delete_costos: function() {

		jQuery("body").on('click', '.js-delete-costo', function(event) {

			costos_id = jQuery(this).attr('data-id');
			proyectos_id = jQuery("#global_proyectos_id").val();
			$.confirm({
				title: 'Confirmar',
				content: 'Desea eliminar este registro de costos del proyecto?',
				buttons: {
					Confirmar: function() {
						$.ajax({
								url: _site_url + '/proyectos/delete_costo',
								type: 'POST',
								dataType: 'json',
								data: {
									costos_id: costos_id,
									proyectos_id: proyectos_id
								},
							})
							.done(function(response) {

								_alert(response.message, 0);
								_helper_trigger('custom__reload_costos');
								console.log("success");
							})
							.fail(function() {
								console.log("error");
							})
							.always(function() {
								console.log("complete");
							});

					},
					Cancelar: function() {

					},

				}
			});
			event.preventDefault();
			/* Act on the event */
		});
	},
	init_detalles__delete_cotizaciones: function() {

		jQuery("body").on('click', '.js-delete-cotizacion', function(event) {

			id = jQuery(this).attr('data-id');
			proyectos_id = jQuery("#global_proyectos_id").val();
			$.confirm({
				title: 'Confirmar',
				content: 'Desea quitar la cotización?',
				buttons: {
					Confirmar: function() {
						$.ajax({
								url: _site_url + '/proyectos/delete_cotizacion',
								type: 'POST',
								dataType: 'json',
								data: {
									cotizacion_id: id,
									proyectos_id: proyectos_id
								},
							})
							.done(function(response) {

								_alert(response.message, 0);
								_helper_trigger('custom__reload_cotizacion');
								console.log("success");
							})
							.fail(function() {
								console.log("error");
							})
							.always(function() {
								console.log("complete");
							});

					},
					Cancelar: function() {

					},

				}
			});
			event.preventDefault();
			/* Act on the event */
		});
	},
	init_detalles_change_status: function() {
		jQuery("body").on('click', '.js-change-status', function(event) {

			status = jQuery(this).attr('data-status');
			proyectos_id = jQuery('#global_proyectos_id').val();

			document.location.href = _site_url + '/proyectos/change_status/' + status + '/' + proyectos_id
			event.preventDefault();
			/* Act on the event */
		});
	},
	init_detalles: function() {
		_this_ = this;
		jQuery("body").on('click', '#js-add-costo', function(event) {


			$.ajax({
					url: _site_url + '/proyectos/form_costos',
					type: 'post',
					dataType: 'json',
					data: {
						proyectos_id: jQuery("#global_proyectos_id").val()
					},
				})
				.done(function(data) {

					jQuery("#modal-js-add-costos").find('.modal-body').html(data.html);

					$('.switch-button').bootstrapToggle()
					/* init detalles*/
					_this_.custom__init_numbers();
					_this_.init_time();
					_init_form();
					jQuery("#modal-js-add-costos").modal();
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});



			/* Act on the event */
		});
		/****************************************************************/
		jQuery("body").on('click', '.js-edit-costo', function(event) {


			costos_id = jQuery(this).attr("data-value");

			$.ajax({
					url: _site_url + '/proyectos/form_costos',
					type: 'post',
					dataType: 'json',
					data: {
						proyectos_id: jQuery("#global_proyectos_id").val(),
						costos_id: costos_id,
					},
				})
				.done(function(data) {

					jQuery("#modal-js-add-costos").find('.modal-body').html(data.html);

					$('.switch-button').bootstrapToggle()
					/* init detalles*/
					_this_.custom__init_numbers();
					_this_.init_time();
					_init_form();
					jQuery("#modal-js-add-costos").modal();
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});



			/* Act on the event */
		});

		/****************************************************************
		 *****************************************************************/
		jQuery("body").on('change', '#costos_categorias_id', function(event) {
			id = jQuery(this).val();
			jQuery("option.option-costos-item").hide();
			jQuery('.option-costos-item[data-parent="' + id + '"]').show();
			jQuery("#costos_items_id").val('').trigger('change');
			event.preventDefault();
			/* Act on the event */
		});

		/*****************************************************************/
		/*****************************************************************/

		_this_.init__reload_costos();
		_this_.init__reload_cotizaciones();
		_this_.init_detalles__view_cotizacion();
		_this_.init_detalles__form_add_cotizacion();
		_this_.init_detalles__delete_costos();
		_this_.init_detalles__delete_cotizaciones();
		_this_.init_detalles_change_status();
	}

};
/* fin de main************************/

jQuery(function() {


	main.init();
	switch (_controller) {

		case "proyectos":
			switch (_action) {
				case "detalles":

					main.init_table_links_gestor();

					main.init_select2_form_agregar_link();

					main.init_modal_agregar_link();

					main.init_detalles();
					main.init_finalizar_proyecto();
					main.init_time();

					break;
				case "index":
					main.init_table_proyectos_gestor();
					main.init_js_atender();
					break;
				case 'operacion':
					main.init_time();
					break;
			}

			break;
		case "informe_cotizaciones":

			switch (_action) {
				case 'index':
					main.init_table__informe_cotizaciones();
					main.table__informe_cotizaciones();
					break;

			}
		case "cotizacion":
			switch (_action) {
				case "operacion":
					main.init_change_moneda_id();
					break;
			}
			break;

		case "bases":
			switch (_action) {
				case "admin":
					main.init_table_links_bases();
					break;
				case "configurar":
					main.init_time();
					break;

			}
			break;
	}


});

/**/

function success_message(data) {
	$('#list-report-success').slideUp('fast');
	$('#list-report-success').html(data);
	$('#list-report-success').slideDown('normal');
}