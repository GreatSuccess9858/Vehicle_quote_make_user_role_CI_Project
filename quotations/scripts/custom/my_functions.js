$.validator.setDefaults({
	errorPlacement: function(error, element) {
		// Add the `help-block` class to the error element
		error.addClass("help-block");

		// Add `has-feedback` class to the parent div.form-group
		// in order to add icons to inputs
		point_error = $(element).closest(".point-error");

		if (point_error.length > 0) {
			element.closest(".point-error").addClass("has-feedback");

		} else {
			element.closest(".form-group").addClass("has-feedback");
		}


		if (element.prop("type") === "checkbox") {
			///	error.insertAfter(element.parent("label"));
		} else {
			///		error.insertAfter(element);
		}

		// Add the span element, if doesn't exists, and apply the icon classes to it.
		if (!element.next("span")[0]) {
			////	$("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
		}
	},
	success: function(label, element) {
		// Add the span element, if doesn't exists, and apply the icon classes to it.
		if (!$(element).next("span")[0]) {
			//$("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
		}
	},
	highlight: function(element, errorClass, validClass) {
		point_error = $(element).closest(".point-error");

		if (point_error.length > 0) {
			$(element).closest(".point-error").addClass("has-error").removeClass("has-success");
		} else {
			$(element).closest(".form-group").addClass("has-error").removeClass("has-success");
		}
		$(element).addClass('error');
		/*	$(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");*/
	},
	unhighlight: function(element, errorClass, validClass) {
		point_error = $(element).closest(".point-error");
		if (point_error.length > 0) {
			$(element).closest(".point-error").addClass("has-success").removeClass("has-error");
		} else {
			$(element).closest(".form-group").addClass("has-success").removeClass("has-error");
		}
		$(element).removeClass('error');
		/*$(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");*/
	}

});

function _format_number(n, currency) {
	//var n=1234.567
	console.log("NUMBER: n=[" + n + "]");
	n = parseFloat(n);
	var parts = n.toFixed(_decimals).split(".");
	var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
		(parts[1] ? "." + parts[1] : "");

	//currency = 'USD';
	currency_html = "<span class='currency_cotizacion'>" + currency + "</span>"
	return currency_html + num;
}
//Función para validar una CURP
function curpValida(curp) {
	var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
		validado = curp.match(re);

	if (!validado) //Coincide con el formato general?
		return false;

	//Validar que coincida el dígito verificador
	function digitoVerificador(curp17) {
		//Fuente https://consultas.curp.gob.mx/CurpSP/
		var diccionario = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
			lngSuma = 0.0,
			lngDigito = 0.0;
		for (var i = 0; i < 17; i++)
			lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
		lngDigito = 10 - lngSuma % 10;
		if (lngDigito == 10) return 0;
		return lngDigito;
	}

	if (validado[2] != digitoVerificador(validado[1]))
		return false;

	return true; //Validado
}
jQuery.validator.addMethod("curprequired", function(value, element) {
	select_paises = jQuery(element).closest('.row-custom').find("select.paises option:selected").val();

	console.log("PAISES " + select_paises);
	if (select_paises == 1) {
		return jQuery.validator.methods.required.call(this, $.trim(value), element)
	} else {
		return true;
	}
	//return this.optional(element) || (parseFloat(value) > 0);
}, "* Ingrese un numero válido.");


function _helper_trigger(custom, b) {
	console.log("pre call event:" + custom);
	jQuery("body").trigger(custom, b);
	console.log("post call event:" + custom);
}

function _helper_trigger_element(custom, b, c) {
	console.log("pre call event:" + custom);
	jQuery(b).trigger(custom, c);
	console.log("post call event:" + custom);
}
jQuery(function() {

	_init_form();

});

function _init_form() {

	$.each($('form.js-validation-mini'), function(index, el) {
		console.log(" append.. data validate loaded ");
		jQuery(this).attr("data-validate-loaded", 1);
		$(this).validate();



	});


	$.each($('form.js-validation-simple'), function(index, el) {
		console.log(" append.. data validate loaded ");
		jQuery(this).attr("data-validate-loaded", 1);
		$(this).validate({



			submitHandler: function(form) {
				$.ajax({
					url: form.action,
					type: form.method,
					data: $(form).serialize(),
					dataType: "json",
					success: function(response) {
						alert(response.message);
					}
				});
			}
		});



	});

	$.each($('form.js-validation-plus'), function(index, el) {
		console.log(" append.. data validate loaded ");
		jQuery(this).attr("data-validate-loaded", 1);
		$(this).validate({



			submitHandler: function(form) {
				//	var form = jQuery('form#builder-form')[0]; // You need to use standard javascript object here
				var formData = new FormData(form);

				_trigger = jQuery(form).attr("data-trigger");
				_divparams = jQuery(form).attr("data-divparams");

				$.ajax({
					url: form.action,
					type: form.method,
					data: formData,
					contentType: false,
					processData: false,
					dataType: "json",
					beforeSend: function() {
						// Handle the beforeSend event
						_loading_show();
					},
					complete: function() {
						// Handle the complete event
						_loading_hide();
					},
					success: function(response) {
						_loading_hide();

						if (response.error == '1') {
							//alert(response.message);
							_alert(response.message, 1);
						} else {

							if (response.hasOwnProperty("message") && response.message != '') {
								//alert(response.message);
								_alert(response.message, 0);

							}

							if (response.hasOwnProperty("redirect") && response.redirect != '') {
								location.href = response.redirect;
							}

							if (_trigger) {
								_helper_trigger(_trigger, [form, _divparams, response]);
								//jQuery("body").trigger(_trigger, [form, _divparams])
							}

						}

					}

				});


			}
		});



	});



}
jQuery(function() {

	$('[data-toggle="ajaxModal"]').on('click',
		function(e) {
			console.log(545);
			$('#ajaxModal').remove();
			e.preventDefault();
			var $this = $(this),
				$remote = $this.data('remote') || $this.attr('href'),
				$modal = $('<div class="modal" id="ajaxModal"><div class="modal-body"></div></div>');
			$('body').append($modal);
			/*$modal.modal({
				backdrop: 'static',
				keyboard: false
			});*/
			//$modal.load($remote);
			$modal.modal({
				show: true
			});
		}
	);

	jQuery('body').on('click', '.modal-ajax', function(e) {

		link = jQuery(this).attr("href");
		$('#modal-simple-info').find(".modal-body").load(link);
		$('#modal-simple-info').modal();
		e.preventDefault();
		/**/
		//$('#myInput').focus()
	});


});

function _status_text(status) {
	switch (status) {
		case 0:
			return 'Pendiente';
			break;
		case 1:
			return 'En progreso';
			break;

		case -1:
			return 'Observado';
			break;

		case 2:
			return 'Corregido';
			break;

		case 3:
			return 'Aprobado';
			break;
	}

}

function _status_label(status) {
	status = String(status);
	switch (status) {
		case "0":
			return 'warning';
			break;
		case "1":
			return 'info';
			break;

		case "-1":
			return 'danger';
			break;

		case "2":
			return 'warning';
			break;

		case "3":
			return 'success';
			break;
	}

}

function _alert($message, $tipo) {

	if ($tipo == "1" || $tipo == "error" || $tipo == 1) {
		_type = 'red';
		_icon = 'fas fa-exclamation-triangle';
	} else {
		_type = 'green';
		_icon = 'fas fa-check-circle';
	}
	$.alert({
		title: "Aviso",
		content: $message,
		typeAnimated: true,
		icon: _icon,
		type: _type
	});
}


var objGenPlugin = {
	fcPreloadShow: function(obj) {
		var optVar = {
			backgroundColor: '#f1f1f1',
			fadeInTime: 500,
			fadeLevel: 0.8,
			/*image: '../img/loader5.gif',
			style: 3,*/
			//style:"<div style='position:absolute;left:10px;bottom:10px;background:#000;color:#fff;padding:5px;border-radius:4px'>Loading...</div>",
			style: '<div style="background:#fff;width:30px;height:30px;margin:auto;position:absolute;top:0;left:0;bottom:0;right:0;"><div class="sk-spinner sk-spinner-cube-grid"><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div></div></div>',
			hideAfter: 1700
		}
		if (obj == "body") {
			optVar["wholeWindow"] = true;
			optVar["lockOverflow"] = true;
			optVar["backgroundColor"] = '#000';
			optVar["fadeInTime"] = 1000;
			optVar["fadeLevel"] = 0.4;
			/*optVar["image"] = '../img/loader4.gif';
			optVar["style"] = 1;*/
		}
		$(obj).oLoader(optVar);
	},
	fcPreloadHide: function(obj) {
		setTimeout(function() {
			$(obj).oLoader('hide');
		}, 2000)
	},
	fcPreloadFull: function() {
		var optVar = {
			backgroundColor: '#f1f1f1',
			fadeInTime: 500,
			fadeLevel: 0.8,
			/*image: '../img/loader5.gif',
			style: 3,*/
			//style:"<div style='position:absolute;left:10px;bottom:10px;background:#000;color:#fff;padding:5px;border-radius:4px'>Loading...</div>",
			style: '<div style="width:60px;height:60px;margin:auto;position:absolute;top:0;left:0;bottom:0;right:0;"><div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div> <div class="sk-cube sk-cube6"></div> <div class="sk-cube sk-cube7"></div> <div class="sk-cube sk-cube8"></div> <div class="sk-cube sk-cube9"></div></div></div>',
			hideAfter: 10000
		}
		optVar["wholeWindow"] = true;
		optVar["lockOverflow"] = true;
		optVar["backgroundColor"] = '#000';
		optVar["fadeInTime"] = 1000;
		optVar["fadeLevel"] = 0.4;
		//optVar["image"] = '../img/loader4.gif';
		//optVar["style"] = 1;
		$("body").oLoader(optVar);
	},
	fcPreloadFullHide: function() {
		setTimeout(function() {
			$('body').oLoader('hide');
		}, 1000)
	},
}

function _loading_show() {
	objGenPlugin.fcPreloadFull('body');
}

function _loading_hide() {
	objGenPlugin.fcPreloadFullHide();
}