; 'use strict';
$(function() {

	// ui
	$('.chosen-container').css({'width': '100%',});
	$('.check').iCheck({checkboxClass: 'icheckbox_square-blue',});

	// events
	$('.delete_table').click(deleteTableOnclick);
	$('#createTableBtn').click(createTableOnclick);
	$('#add-filed-row').click(newField);
	$('.delete-field').click(deleteField);
	$('.migrateTable').click(migrateTable);
	$('body').on('ifChecked','.check',{val:1}, setCheckVal);
	$('body').on('ifUnchecked','.check',{val:0}, setCheckVal);

	// functions
	function newField(event) {
		var clone = $('.row_field:first').clone(true);
		clone.show();
		clone.find('.chosen').chosen({'width': '100%'});
		clone.insertAfter('.row_field:last');
		clone.iCheck({checkboxClass: 'icheckbox_square-blue'});
	}

	function deleteField(event) {
		$(this).parents('tr').remove();
	}

	// sync with the hidden fields
	function setCheckVal(event){
		var $this = $(this),
		nextHiddenInput = $this.parent().next();
		nextHiddenInput.val(event.data.val); 
	}

	function deleteTableOnclick(event) {
		event.preventDefault();

		var $this = $(this),
		confirmMsg;

		confirmMsg = '<i class="fa fa-warning fa-1x text-danger"></i>  Are you sure you need to delete <b class="text-danger">' + $this.data('name') + '</b> table ?';
		confirmMsg += '<p class="text-danger"><small>Please be sure that you not using this table in other places before delete</small></p>';
		alertify.confirm(confirmMsg, deleteTableRow);

		function deleteTableRow() {
			// php
			$.ajax({
				url: site + '/myigniter/delete_table',
				type: 'POST',
				dataType: 'json',
				data: {
					table_name: $this.data('name')
				},
			})
			.done(function() {
				$this.parent().parent().fadeOut('fast');
			})
			.fail(function() {
				console.log("error");
			});
		}
	}

	function createTableOnclick(event) {
		event.preventDefault();

		var $this = $(this),
		creatTblForm = $('#creatTblForm');
		// php
		$.ajax({
			url: site + '/myigniter/add_table',
			type: 'POST',
			data: creatTblForm.serialize(),
		})
		.done(function(res) {
			if(res.state === '1'){
				alertify.notify(res.message, 'success', 1, function(){  location.reload(); });
				$('#formCreateTable').modal('hide');
			}else{
				alertify.error(res.message);
			}
		})
		.fail(function() {
		});
	}

	function migrateTable(event) {
		event.preventDefault();
		var $this = $(this);
		alertify.defaults.glossary.ok = 'Generate Migrate File';
		// confirm message popup
		var dialog = '<label><input class="check" type="checkbox" id="migrateData" value="1" /> Also migrate this table data.</label>';
		alertify.confirm('Confirm', dialog, function() { 
	    	$.ajax({
	    		url: site + '/myigniter/generate_migration_file',
	    		type: 'POST',
	    		dataType: 'json',
	    		data: {
	    			table_name: $this.data('name'),
	    			migrate_data: $('#migrateData:checked').length
	    		},
	    	})
	    	.done(function(res) {
	    		alertify.success('Migration Generator successfully generate class for table '+res.table_name+' in this path application/migrations');
	    	})
	    	.fail(function() {
	    		console.log("error");
	    	});
		}, function() {
			// Nothing
		});
		$('.check').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue'
		});
	}
});