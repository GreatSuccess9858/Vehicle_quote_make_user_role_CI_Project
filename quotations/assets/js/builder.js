hljs.initHighlightingOnLoad();

$(function() {
	// start initialize area (do this on load)
	//#########################################################################


	// main vars
	var validationInputs = ['max_length', 'min_length', 'regex', 'exact_length', 'less_than', 'less_than_equal_to', 'greater_than', 'greater_than_equal_to', 'matches', 'differs', 'in_list', 'allowed_extensions', 'max_width', 'max_height', 'max_size'], // name of classes
	defaultAnimationSpeed = 200,
	placeHolders = {
		exact_length: '0 - 99999*',
		differs: 'Any field',
		matches: 'Any field'
	},
	tableConfig = {};
	//	tableConfig['r_n_n'] = [];

	if ($('#table_config_field_box').length) {
		appendCrudTemplate(); // Ajax append crud table
	}

	if (segment[2] != 'crud_builder') {
		var builder = 'table';
		$('<a href="#exportPHP" style="margin-left: 10px" data-id="0" data-builder="' + builder + '" data-toggle="modal" class="btn-php btn btn-success btn-flat"><i class="fa fa-code"></i> Generate Module</a>').insertAfter('#save-and-go-back-button');
	}

	new Clipboard('.copy');

	$('.check').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue'
	});

	// add selected data to table Config
	// add rules to json on add validation
	// hide the textarea
	//#########################################################################

	// Events default
	$('#addBreadcrumb').click(add_breadcrumb); // Breadceumb script
	$('.remove-crumb').click(remove_crumb); // Breadceumb script
	$('.btn-php').click(export_php); // Ajax export to PHP
	$('#create-module').click(create_module); // create module

	// Events for html load from javascript
	$('body').on('change', '#field-table_name', get_fields_name); // Ajax get list field
	$('body').on('change', '.type', changeFieldType);
	$('body').on('change', '.table-reff', changeFieldTable);
	$('body').on('change', '#RNNRelationalTable', changeRNNRelationalTable); // relation_n_n
	$('body').on('change', '#RNNSelectionTable', changeRNNSelectionTable); // relation_n_n
	$('body').on('change', '#RNNFieldName,#RNNRelationalTable,#RNNSelectionTable,#RNNPrimaryKeyAliasToThisTable,#RNNPrimaryKeyAliasToSelectionTable', liveCheck); // relation_n_n
	$('body').on('click', '#addRNNBtn', clickaddRNNBtn); // relation_n_n
	$('body').on('change', '.validation', {
		extra: tableConfig
	}, addValidation);
	$('body').on('click', '.delete', remove_rules); // remove rules btn
	$('body').on('click', '.removeTableRow', removeTableRow); // // relation_n_n
	$('body').on('keyup', '.validationInputs', validation_inputs);
	$('body').on('keyup click change', '#table_config', update_table_config); // update json data
	$('body').on('ifChecked', '.check-config', {
		val: 1
	}, update_actions);
	$('body').on('ifUnchecked', '.check-config', {
		val: 0
	}, update_actions);
	$('body').on('keyup', '.alias', update_alias);
	$('body').on('change', '.table-reff', update_select_data);
	$('body').on('change', '.field-reff', update_field_reff);
	$('body').on('change', '.label-reff', update_label_reff);
	$('body').on('click', '#form-button-save', update_table_config);
	$('body').on('click', '#save-and-go-back-button', update_table_config);

	function update_field_reff(event) {
		var $this = $(this),
		fieldName = $this.data('field');
		tableConfig[fieldName].selectData.fieldReff = $this.val();
	}

	function update_label_reff(event) {
		var $this = $(this),
		fieldName = $this.data('field');
		tableConfig[fieldName].selectData.labelReff = $this.val();
	}

	function update_select_data(event) {
		var $this = $(this),
		fieldName = $this.data('field');
		tableConfig[fieldName].selectData.table = $this.val();
	}

	function update_alias(event) {
		var value = $(this).val();
		var fieldName = $(this).data('field');
		tableConfig[fieldName].alias = value;
	}

	function update_actions(event) {
		var value = event.data.val,
		$this = $(this);
		tableConfig[$this.data('field')].actions[$this.data('action')] = value;
		update_table_config();
	}

	function validation_inputs(event) {

		var validationObj = {},
		ruleExist = false,
		$this = $(this),
		ruleName = $this.data('name'),
		fieldName = $this.data('field');

		if ($this.val() != "") {
			validationObj[ruleName] = $this.val();

			tableConfig[fieldName].validation.forEach(function(element, index) {
				// statements
				if (typeof(element[ruleName]) !== 'undefined') {
					ruleExist = true;
					tableConfig[fieldName].validation[index] = validationObj; // update
				}
			});

			if (ruleExist === false) { // push
				tableConfig[fieldName].validation.push(validationObj);
			}
		}
	}

	// load this when table_config.php loaded
	function load_json() {
		var fieldsNames = $('.fieldsNames');

		if ($('#field-table_config').text() !== '') {
			tableConfig = JSON.parse($('#field-table_config').text());
		} else {
			fieldsNames.each(get_values);
		}
	}

	function get_values() {
		var fieldData, column, add, edit, details, type, $this = $(this),
			fieldName = $this.val(); // return the field name

			column = $("input[name='table[" + fieldName + "][column]']:checked").val();
			add = $("input[name='table[" + fieldName + "][add]']:checked").val();
			edit = $("input[name='table[" + fieldName + "][edit]']:checked").val();
			details = $("input[name='table[" + fieldName + "][details]']:checked").val();
			type = $("select[name='table[" + fieldName + "][type]']").val();

			column = fix_undefined(column);
			add = fix_undefined(add);
			edit = fix_undefined(edit);
			details = fix_undefined(details);

			fieldData = {
				actions: {
					"column": parseInt(column),
					"add": parseInt(add),
					"edit": parseInt(edit),
					"details": parseInt(details)
				},
				type: type,
				selectData: {},
				selectMultipleData: {},
				validation: []
			};

			tableConfig[fieldName] = fieldData;
		}

		function fix_undefined(data) {
			if (data === undefined) {
				return 0;
			} else {
				return data;
			}
		}

		function add_breadcrumb() {
			var breadcrumbItem = $('.form-breadcrumb:last').clone();
			breadcrumbItem.children().children().val('');
			breadcrumbItem.insertAfter('.form-breadcrumb:last');
			$('.remove-crumb').click(function() {
				$(this).parent().parent().remove();
			});
		}

		function remove_crumb() {
			$(this).parent().parent().remove();
		}

	// Ajax get and append crud template
	function appendCrudTemplate() {
		$.get(site + '/myigniter/columns_callback', function(data) {
			$('#table_config_field_box').after(data);
			$('#columns_field_box').next().remove(); // remove next <br>
		}).complete(function() {
			if ($('#field-table_name').val()) {
				get_fields_name();
			}
		});
	}

	function addValidation() {

		var $this = $(this),
		value = $this.val(),
		parent = $this.parent(),
		output = '',
		fieldName = $this.data('name'),
			selectedOption = $('option:selected', this); // sync with field type

			$this.val('');
			$this.trigger('chosen:updated');

		if (parent.find('.validation-name:contains("' + value + '")').length === 0) { // check if this rule already selected

			output = '<div class="box-validation ' + selectedOption.prop('class') + '">';
			output += '<label><div class="validation-name">' + value + '</div></label>';

			if ($.inArray(value, validationInputs) > -1) {
				output += '<input type="text" data-field="' + fieldName + '" data-name="' + value + '" value="" class="small-input validationInputs"/>';
			} else {
				tableConfig[fieldName].validation.push(value); // validation string
			}

			output += '<a class="delete" data-field="' + fieldName + '" data-name="' + value + '"><i class="fa fa-trash"></i></a>';
			output += '</div>';
			parent.append(output);

		}
	}

	// relation_n_n
	function removeTableRow(){
		var $this = $(this);

		$this.parents('tr').fadeOut(defaultAnimationSpeed,function(){
			$this.parent('tr').remove();
			tableConfig['r_n_n'].splice($this.attr('id'),1);
			update_table_config();
		});
	}

	function remove_rules() {
		var $this = $(this),
		ruleName = $this.data('name'),
		fieldName = $this.data('field');

		$this.parent('.box-validation').fadeOut(defaultAnimationSpeed, function() {
			$(this).remove();
		});
		// remove item from array
		tableConfig[fieldName].validation.forEach(function(element, index) {
			// statements
			if (typeof element === 'object') {
				if (ruleName in element) {
					tableConfig[fieldName].validation.splice(index, 1); // update
				}
			} else {
				if (element === ruleName) {
					tableConfig[fieldName].validation.splice(index, 1); // update
				}
			}

		});
	}

	function changeFieldType(event) {
		// main vars
		var $this = $(this),
		relation = $.inArray($this.val(), ['select', 'select_multiple', 'checkbox']),
			// relation_n_n = $.inArray($this.val(), ['select_multiple']),
			parent = $this.parents('td'),
			validation = $this.parent().next('td').find('.validation'),
			rules = $this.parent().next('td').find('.box-validation'),
			fieldName = $this.data('field');

		// process happen when select/select multiple
		if (relation >= 0) {
			parent.find('.container-table-reff').show();
		} else {
			parent.find('.container-table-reff').hide();
			parent.find('.container-field-reff').hide();
			parent.find('.container-label-reff').hide();
			tableConfig[fieldName].selectData = {};
		}

		// For custom fields
		// if (relation_n_n >= 0 ) {
		// 	parent.find('.container-select-multiple').show();
		// } else {
		// 	parent.find('.container-select-multiple').hide();
		// 	tableConfig[fieldName].selectMultipleData = {};
		// }

		// loop on all validation options
		validation.find('option').each(function() {
			var $option = $(this);

			// make option hide if true
			if ($option.hasClass($this.val()) === false) {
				$option.addClass('hidden');
			} else {
				$option.removeClass('hidden');
			}

			if ($option.val() === 'required') {
				$option.removeClass('hidden');
			} // fix required visability

		});

		// update the rules and clean unnecessary 
		rules.each(function() {
			$rule = $(this);

			if ($rule.hasClass($this.val()) === false) {
				$rule.remove();
			}
		});

		// update chosen
		validation.trigger('chosen:updated');

		// update json
		tableConfig[fieldName].type = $this.val();
	}

	function changeFieldTable(event) {
		var $this = $(this),
		parent = $this.parents('td');

		parent.find('.container-field-reff').show();
		parent.find('.container-label-reff').show();

		$.get(site + '/myigniter/getFields/' + $this.val(), function(data) {
			parent.find('.field-reff').html('<option value></option>');
			parent.find('.label-reff').html('<option value></option>');
			$.each(data, function(index, val) {
				var selected = '';
				if (val.primary_key) {
					selected = 'selected';
					tableConfig[$this.data('field')].selectData.fieldReff = val.name;
					tableConfig[$this.data('field')].selectData.labelReff = val.name;
					update_table_config();
				}
				parent.find('.field-reff').append('<option ' + selected + ' value="' + val.name + '">' + val.name + '</option>');
				parent.find('.label-reff').append('<option ' + selected + ' value="' + val.name + '">' + val.name + '</option>');
			});
			parent.find('.field-reff').trigger('chosen:updated');
			parent.find('.label-reff').trigger('chosen:updated');

		});
	}

	function changeRNNRelationalTable(event) {
		var $dropdown = $('#RNNPrimaryKeyAliasToThisTable,#RNNPriority,#RNNPrimaryKeyAliasToSelectionTable'),
		$this = $(this);

		$.get(site + '/myigniter/getFields/' + $this.val(), function(data) {
			var selected = ''; 
			if(data.length > 0){
				$dropdown.empty();
				$.each(data, function(index, val) {
					var selected = '';
					$dropdown.append('<option ' + selected + ' value="' + val.name + '">' + val.name + '</option>');
				});
				$dropdown.trigger('chosen:updated');
			}
		});
	}

	function changeRNNSelectionTable(event) {
		var $dropdown = $('#RNNTitleField'),
		$this = $(this);

		$.get(site + '/myigniter/getFields/' + $this.val(), function(data) {
			var selected = ''; 
			if(data.length > 0){
				$dropdown.empty();
				$.each(data, function(index, val) {
					var selected = '';
					$dropdown.append('<option ' + selected + ' value="' + val.name + '">' + val.name + '</option>');
				});
				$dropdown.trigger('chosen:updated');
			}
		});
	}

	function clickaddRNNBtn(event){
		var relationNNForm = $('#relationNNForm'), // input
		RNNFieldName = $('#RNNFieldName'), // input
		RNNRelationalTable = $('#RNNRelationalTable'), // input
		RNNSelectionTable = $('#RNNSelectionTable'), // input
		RNNPrimaryKeyAliasToThisTable = $('#RNNPrimaryKeyAliasToThisTable'), // input
		RNNPrimaryKeyAliasToSelectionTable = $('#RNNPrimaryKeyAliasToSelectionTable'), // input
		RNNTitleField = $('#RNNTitleField'), // input
		RNNPriority = $('#RNNPriority'), // input
		RNNColumn = $('#RNNColumn:checked').length, // input
		RNNAdd = $('#RNNAdd:checked').length, // input
		RNNEdit = $('#RNNEdit:checked').length, // input
		RNNDetails = $('#RNNDetails:checked').length, // input
		output = '',
		tableRows = $('#advance-fields'),
		isValid = true,
		RNNTemplate = $('#RNNTemplate'),
		RNNVLabelName = $('#RNNTemplate .RNNVLabelName'), // output
		RNNVRelationTable = $('#RNNTemplate .RNNVRelationTable'), // output
		RNNVSelectionTable = $('#RNNTemplate .RNNVSelectionTable'), // output
		RNNVPriKeyAliasR = $('#RNNTemplate .RNNVPriKeyAliasR'), // output
		RNNVPriKeyAliasS = $('#RNNTemplate .RNNVPriKeyAliasS'), // output
		RNNVPriority = $('#RNNTemplate .RNNVPriority'), // output
		RNNVTitle = $('#RNNTemplate .RNNVTitle'), // output
		RNNVInColumn = $('#RNNTemplate .RNNVInColumn'), // output
		RNNVInAdd = $('#RNNTemplate .RNNVInAdd'), // output
		RNNVInEdit = $('#RNNTemplate .RNNVInEdit'), // output
		RNNVInDetails = $('#RNNTemplate .RNNVInDetails'); // output

		isValid = runRNNValidation();

		if(!isValid){ return false;}

	    // repare data in json
	    if(!tableConfig.hasOwnProperty("r_n_n")){
	    	tableConfig['r_n_n'] = []; 
	    }

	    tableConfig['r_n_n'].push({
	    	RNNFieldName:RNNFieldName.val(),
	    	RNNRelationalTable:RNNRelationalTable.val(),
	    	RNNSelectionTable:RNNSelectionTable.val(),
	    	RNNPrimaryKeyAliasToThisTable:RNNPrimaryKeyAliasToThisTable.val(),
	    	RNNPrimaryKeyAliasToSelectionTable:RNNPrimaryKeyAliasToSelectionTable.val(),
	    	RNNPrimaryKeyAliasToSelectionTable:RNNPrimaryKeyAliasToSelectionTable.val(),
	    	RNNPriority:RNNPriority.val(),
	    	RNNTitleField:RNNTitleField.val(),
	    	RNNColumn:RNNColumn,
	    	RNNAdd:RNNAdd,
	    	RNNEdit:RNNEdit,
	    	RNNDetails:RNNDetails
	    });

	   // append html
	   RNNVLabelName.text(RNNFieldName.val());
	   RNNVRelationTable.text(RNNRelationalTable.val());
	   RNNVSelectionTable.text(RNNSelectionTable.val());
	   RNNVPriKeyAliasR.text(RNNPrimaryKeyAliasToThisTable.val());
	   RNNVPriKeyAliasS.text(RNNPrimaryKeyAliasToSelectionTable.val());
	   RNNVPriority.text(RNNPriority.val());
	   RNNVTitle.text(RNNTitleField.val());
	   RNNVInColumn.text((RNNColumn == '1')?'yes':'no');
	   RNNVInAdd.text((RNNAdd == '1')?'yes':'no');
	   RNNVInEdit.text((RNNEdit == '1')?'yes':'no');
	   RNNVInDetails.text((RNNDetails == '1')?'yes':'no');
	   output = RNNTemplate.clone(true);
	   tableRows.append(output.removeClass('hidden').attr('id',tableConfig['r_n_n'].length));

	   $('.check').iCheck({
	   	checkboxClass: 'icheckbox_square-blue',
	   	radioClass: 'iradio_square-blue'
	   });

	   alertify.success('Data has been Saved successfully');
	   $('#relationNNForm').modal('hide');
	}

	/**
	 * vaidation relation_n_n form inputs
	 */
	 function runRNNValidation(){
	 	var relationNNForm = $('#relationNNForm'),
	 	RNNFieldName = $('#RNNFieldName'),
	 	RNNRelationalTable = $('#RNNRelationalTable'),
	 	RNNSelectionTable = $('#RNNSelectionTable'),
	 	RNNPrimaryKeyAliasToThisTable = $('#RNNPrimaryKeyAliasToThisTable'),
	 	RNNPrimaryKeyAliasToSelectionTable = $('#RNNPrimaryKeyAliasToSelectionTable'),
	 	RNNTitleField = $('#RNNTitleField'),
	 	isValid = true;

	 	$("input,select").filter(function () {
	 		return $.trim($(this).val()).length == 0
	 	}).length == 0;

		// rules 
		isValid = requiredRule(RNNFieldName);
		isValid = requiredRule(RNNRelationalTable);
		isValid = requiredRule(RNNSelectionTable);
		isValid = requiredRule(RNNPrimaryKeyAliasToThisTable);
		isValid = requiredRule(RNNPrimaryKeyAliasToSelectionTable);
		isValid = requiredRule(RNNTitleField);
		return isValid;
	}

	function requiredRule(element){
		if(element.val() === ''){
			element.parent().addClass('has-error');
			element.prev().html('<i class="fa fa-times-circle-o"></i> required!').removeClass('hidden');	
			return false;
		}else{
			element.parent().removeClass('has-error');
			element.prev().addClass('hidden');
			return true;
		}
	}

	/**
	 * live validation inputs while typing
	 */
	 function liveCheck(event){
	 	var $this = $(this);
	 	requiredRule($this);
	 }

	 function get_fields_name() {
	 	var element = $('#field-table_name'),
	 	advaceFields = $('#advance-fields'),
	 	idTable = '',
	 	overlay = $('.overlay'),
	 	url = window.location.href;

	 	url = url.split('edit/');
	 	if (typeof(url[1]) != 'undefined') {
	 		idTable = '?id=' + url[1];
	 	}

		// add preloader
		$('#field_table_name_chosen').after('<i class="fa fa-circle-o-notch fa-spin text-primary fa-fw fa-1x table-name-spinner"></i>');
		overlay.removeClass('hidden');

		$.get(site + '/myigniter/get_list_fields/' + element.val() + idTable, function(data) {
			advaceFields.html(data).find('.check').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue'
			});
			$('#advance-fields').find(".chosen").chosen();
			$('.chosen-container').css('width', '100%');
			$('#columns_field_box').removeClass('hidden');
			load_json();
		}).complete(function () {
			$('.table-name-spinner').remove();
			overlay.addClass('hidden');
		});
	}

	function update_table_config() {
		$('#field-table_config').val(JSON.stringify(tableConfig));
	}

	function export_php() {
		var id = $(this).data('id'),
		builder = $(this).data('builder');
		if (id) {
			$.get(site + '/myigniter/export_php/' + id + '/' + builder, function(data) {
				$('#PHPCode').html(hljs.highlightAuto(data).value);
				$('#create-module').data('id', id);
			});
		} else {
			$.ajax({
				url: site + '/myigniter/export_php/' + 0 + '/' + builder,
				type: 'POST',
				data: $('#crudForm').serialize(),
			}).done(function(data) {
				$('#PHPCode').html(hljs.highlightAuto(data).value);
				$('#create-module').data('id', id);
			}).fail(function() {
				alertify.alert("Something wrong try again!");
			});
		}
	}

	function create_module() {
		var id = $(this).data('id');
		$.ajax({
			url: site + '/myigniter/createModule',
			type: 'POST',
			data: {
				id: id
			},
		}).done(function(data) {
			if (data.status) {
				alertify.alert("Module created, can be access via path : <pre>/" + data.table + "/crud" + ucfirst(data.table) + "</pre> Controller can be found in : <pre>/applcation/modules/" + data.table + "/controllers/" + ucfirst(data.table) + ".php</pre> <br><a href='" + site + "/" + data.table + "/crud" + ucfirst(data.table) + "'>Go to module</a>");
			} else {
				alertify.alert("Module alredy exist!");
			}
		}).fail(function() {
			alertify.alert("This features can be use only in development mode!");
		});
	}

	function ucfirst(str) {
		var firstLetter = str.substr(0, 1);
		return firstLetter.toUpperCase() + str.substr(1);
	}
});