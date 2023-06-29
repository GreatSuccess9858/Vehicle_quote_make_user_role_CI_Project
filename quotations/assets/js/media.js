$(function(){
	function toggleUpload(event) {
		$('#upload-container').toggle();
		$('.dz-preview').remove();
	}

	$('#show-upload, #upload-close').click(toggleUpload);
	
	function toggleSelected(event) {
		event.preventDefault();
		$(this).toggleClass('selected');
	}

	function removeSelected(event) {
		$(this).removeClass('selected');
	}

	function toggleFocus(event) {
		$('.media-lib-grid').removeClass('focus');
		$(this).addClass('focus');
	}

	function toggleAction() {
		$('#upload-container').hide();
		$('.dz-preview').remove();
		$('.media-lib-action').toggle();
		$('.media-lib-select').toggle();
		$('.media-lib-container').toggleClass('bulk-select');
		if ($('.media-lib-container').hasClass('bulk-select')) {
			$('.media-lib-grid').removeAttr('data-toggle').removeClass('normal').removeClass('focus').addClass('bulk');
		} else {
			$('.media-lib-grid').attr('data-toggle', 'modal').addClass('normal').removeClass('selected bulk');
		}
	}

	// Action select
	$('#bulk-select').click(toggleAction);

	$('#cancel-select').click(toggleAction);

	$('.media-lib-container')
		.on('click', '.bulk', toggleSelected)
		.on('click', '.normal', toggleFocus);

	function itemThumb(url) { 
		var element = $('.media-lib-grid:first').clone(true);
		element.find('img').attr('src', url);
		element.removeAttr('style');
		return element;
	}

	// Load more
	function loadMore(event) {
		var count = $('.media-lib-grid').length;
		$.get(site + '/media/loadMore?start=' + count, function(data) {
			$('#load-more').attr('disabled', 'disabled');
			$('#load-more').html('Loading...');
			$.each(data.image, function(index, val) {
				var element = itemThumb(val.src);
				element.attr('data-id', val.id);
				element.attr('data-file', val.file);
				element.attr('data-name', val.name);
				element.attr('data-date', val.uploaded_at);
				element.attr('data-user', val.username);
				element.attr('data-ext', val.ext);
				element.insertBefore('#load-more');
			});
			if ($('.media-lib-grid').length == data.count) {
				$('#load-more').hide();
			}
		}).done(function(){
			$('#load-more').removeAttr('disabled');
			$('#load-more').html('Load more');
		});
	}

	$('#load-more').click(loadMore);

	$('#search-media').keyup(function(event) {
		var cacheElement = itemThumb('none');
		var cacheBtn = $('#load-more').clone(true);
		$('.media-lib-container').html('<h2>Loading..</h2>');
	});

	$("#upload-zone").dropzone({ 
		url: $(this).attr('action'),
		maxFiles: 20,
		maxFilesize: 2,
		acceptedFiles: 'image/*',
		createImageThumbnails: false,
		processing: function () {
			$('#progress').parent().show();
		},
		uploadprogress: function(file, progress, bytesSent) {
			$('#progress').css('width', progress + '%');
		},
		success: function(file, response) {
			var element = itemThumb(base + 'assets/uploads/image/' + response.thumbnail);
			element.attr('data-id', response.id);
			element.attr('data-file', response.data.file);
			element.attr('data-name', response.data.name);
			element.attr('data-date', response.data.uploaded_at);
			element.attr('data-user', response.username);
			element.attr('data-ext', response.data.ext);
			element.insertBefore('.media-lib-grid:first');
			$('.title-none').remove();
			$('#progress').parent().hide();
		}
	});

	$('.media-lib-grid').click(function(event) {
		var id = $(this).data('id');
		var file = base + $(this).data('file');
		var name = $(this).data('name');
		var date = $(this).data('date');
		var user = $(this).data('user');
		var ext = $(this).data('ext');

		$('.media-lib-image').attr('src', file);
		$('.media-lib-url').attr('value', file);
		$('.media-lib-name').html(name);
		$('.media-lib-date').html(date);
		$('.media-lib-user').html(user);

		$('#media-input-id').val(id);
		$('#media-input-name').val(name);
		$('#media-input-ext').val(ext);
	});

	function deleteOne(event) {
		event.preventDefault();
		var id = $('#media-input-id').val();

		$.ajax({
			url: $(this).attr('action'),
			type: 'POST',
			data: $(this).serialize(),
		}).done(function(data) {
			if (data) {
				$('#modal-id').modal('hide');
				$('.media-lib-grid[data-id="' + id + '"]').remove();
				noneImage();
			}
		});
	}

	$('#form-delete').submit(deleteOne);

	function multiDelete(event) {
		var multi = [];
		var selector = '';
		$('.media-lib-grid.selected').each(function(index, el) {
			var id = $(this).data('id');
			multi.push({
				id: id,
				name: $(this).data('name'),
				ext: $(this).data('ext')
			});
			if (index !== 0) {
				selector += ', ';
			}
			selector += '.media-lib-grid[data-id="' + id + '"]';
		});
		var json = JSON.stringify(multi);

		$.ajax({
			url: site + '/media/multiDelete',
			type: 'POST',
			data: {
				multi: json
			}
		}).done(function(data) {
			if (data) {
				$(selector).remove();
				noneImage();
			}
		});
	}

	$('#delete-select').click(multiDelete);

	function noneImage() {
		if (typeof($('.media-lib-grid')[0]) == "undefined") {
			var title = '<h2 class="title-none text-center">There is no files uploaded.</h2>';
			var element = '<a data-toggle="modal" href="#modal-id" data-id="" data-file="" data-name="" data-date="" data-user="" class="media-lib-grid normal" style="display: none;"><img src="" alt="Image"><div class="selected-check"><i class="fa fa-check-circle"></i></div></a>';
			$(title).insertBefore('#load-more');
			$(element).insertBefore('#load-more');
		}
	}

	$('#all-select').click(function(event) {
		$('.media-lib-grid').toggleClass('selected');
	});
});