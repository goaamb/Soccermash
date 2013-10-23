/*******************************************************************************
 * 
 * PHP and jQuery Image Resizer/Cropper http://www.theninjaofweb.com/tools/ All
 * rights reserved!
 * 
 * Free for personal use!
 * 
 * For commercial use you need to purchase this script! For example if you sell
 * it as a part of a package or website, implement it for a client�s website,
 * etc.
 * 
 ******************************************************************************/

jQuery.fn.cropper = function() {
	// get arguments
	var args = arguments[0] || {};
	var image = args.image;

	// load image
	$.editor = $(this);
	$.editor.css('background-image', 'url(' + image + ')');

	// set crop area
	$('#crop_area').resizable(
			{
				containment : 'parent',
				minHeight : 20,
				minWidth : 20,
				resize : function(event, ui) {
					// get size
					$('#crop_width').val($('#crop_area').width());
					$('#crop_height').val($('#crop_area').height());
					if (onResizing) {
						onResizing($('#crop_area').width(), $('#crop_area')
								.height());
					}
				},
				stop : function(event, ui) {
					// get size
					$('#crop_width').val($('#crop_area').width());
					$('#crop_height').val($('#crop_area').height());
					if (onResizeStop) {
						onResizeStop($('#crop_area').width(), $('#crop_area')
								.height());
					}
				}
			});
	$('#crop_area').draggable({
		containment : 'parent',
		drag : function(event, ui) {
			// get position
			var croparea = $('#crop_area').position();
			$('#crop_offset_top').val(croparea.top);
			$('#crop_offset_left').val(croparea.left);
			if (onDragging) {
				onDragging(croparea.left, croparea.top);
			}
		},
		stop : function(event, ui) {
			// get position
			var croparea = $('#crop_area').position();
			$('#crop_offset_top').val(croparea.top);
			$('#crop_offset_left').val(croparea.left);
			if (onDragStop) {
				onDragStop(croparea.left, croparea.top);
			}
		}
	});
	$('#crop_area').css('position', 'absolute');
	$('#crop_area').css('border', '1px solid white');
	// get size
	// autoset editor size by the image
	var image_w = '0';
	var image_h = '0';
	var img = new Image();
	img.onload = function() {
		$.editor.css('width', this.width);
		$.editor.css('height', this.height);
		image_w = this.width;
		image_h = this.height;
		$('.tip').append(image_w + 'px * ' + image_h + 'px');
	}
	img.src = image;

	// autocalc w,h for resizer
	$('#rs_width').keyup(function() {
		autocalc_h(image_w, image_h);
	});

	$('#rs_height').keyup(function() {
		autocalc_w(image_w, image_h);
	});

	// manual crop inputs
	$('#crop_width').keyup(function() {
		$('#crop_area').width($('#crop_width').val() + 'px');
	});

	$('#crop_height').keyup(function() {
		$('#crop_area').height($('#crop_height').val() + 'px');
	});

	$('#crop_offset_top').keyup(function() {
		$('#crop_area').css('top', $('#crop_offset_top').val() + 'px');
	});

	$('#crop_offset_left').keyup(function() {
		$('#crop_area').css('left', $('#crop_offset_left').val() + 'px');
	});
}

function autocalc_h(iw, ih) {
	// calc height
	var nu_w = $('#rs_width').val();
	var nu_h = Math.round(nu_w / (iw / ih));
	$('#rs_height').val(nu_h);
}

function autocalc_w(iw, ih) {
	var nu_h = $('#rs_height').val();
	var nu_w = Math.round((iw / ih) * nu_h);
	$('#rs_width').val(nu_w);
}

function apply_resize() {
	var image = $.editor.css('background-image').replace('url("', '');
	image = image.replace('")', '');
	image = image.replace('url(', '');
	image = image.replace(')', '');

	if ($('#rs_width').val() != '' && $('#rs_width').val() != '0'
			&& $('#rs_height').val() != '' && $('#rs_height').val() != '0') {
		// display processing gif
		$('#resize_button')
				.append(
						'<img src="loading.gif" style="float: left; margin-left: 10px;" />');

		// ajax call php resize
		var d = new Date();
		var nufile = 'wnt_tmp_img' + d.getTime() + '.jpg';
		$.ajax({
			url : 'imageresize.php?width=' + $('#rs_width').val() + '&height='
					+ $('#rs_height').val() + '&file=' + image + '&nufile='
					+ nufile,
			success : function() {
				var ow = $.editor.css('width'); // original image width
				var oh = $.editor.css('height'); // original image height

				// remove loading gif
				$('#resize_button img').remove();

				// replace image, resize editor div
				$.editor.css('width', $('#rs_width').val());
				$.editor.css('height', $('#rs_height').val());
				$.editor.css('background-image', 'url(' + nufile + ')');

				// add undo button, remove resize
				$('#resize_button a').remove();
				$('#resize_button').append(
						'<a href="javascript: undo_rs(\'' + ow + '\',\'' + oh
								+ '\',\'' + image
								+ '\');" id="undo_rs">Undo</a>');

			}
		});

	}

}

function undo_rs(ow, oh, oi) {
	// replace original image, resize editor
	$.editor.css('width', ow);
	$.editor.css('height', oh);
	$.editor.css('background-image', 'url(' + oi + ')');

	// remove undo button, add resize
	$('#undo_rs').remove();
	$('#resize_button').append(
			'<a href="javascript: apply_resize();">Resize</a>');
}

function apply_crop() {
	var croparea = $('#crop_area').position();

	var image = $.editor.css('background-image').replace('url("', '');
	image = image.replace('")', '');
	image = image.replace('url(', '');
	image = image.replace(')', '');

	// display processing gif
	$('#crop_button')
			.append(
					'<img src="loading.gif" style="float: left; margin-left: 10px;" />');

	// ajax call php to crop
	var d = new Date();
	var nufile = 'wnt_tmp_img' + d.getTime() + '.jpg';
	$.ajax({
		url : 'imagecrop.php?width=' + $('#crop_area').width() + '&height='
				+ $('#crop_area').height() + '&offset_top=' + croparea.top
				+ '&offset_left=' + croparea.left + '&file=' + image
				+ '&nufile=' + nufile,
		success : function() {
			var ow = $.editor.css('width'); // original image width
			var oh = $.editor.css('height'); // original image height

			// replace image, resize editor div
			$.editor.css('width', $('#crop_width').val());
			$.editor.css('height', $('#crop_height').val());
			$.editor.css('background-image', 'url(' + nufile + ')');

			// reset values, crop area
			$('#crop_width').val('50');
			$('#crop_height').val('50');
			$('#crop_offset_top').val('0');
			$('#crop_offset_left').val('0');
			$('#crop_area').width('50px');
			$('#crop_area').height('50px');
			$('#crop_area').css('top', '0px');
			$('#crop_area').css('left', '0px');
			$('#crop_area').css('position', 'absolute');

			// remove loading gif
			$('#crop_button img').remove();

			// add undo button, remove crop
			$('#crop_button a').remove();
			$('#crop_button').append(
					'<a href="javascript: undo_cr(\'' + ow + '\',\'' + oh
							+ '\',\'' + image + '\');" id="undo_cr">Undo</a>');
		}
	});

}

function undo_cr(ow, oh, oi) {
	// replace original image, resize editor
	$.editor.css('width', ow);
	$.editor.css('height', oh);
	$.editor.css('background-image', 'url(' + oi + ')');

	// remove undo button, add resize
	$('#undo_cr').remove();
	$('#crop_button').append('<a href="javascript: apply_crop();">Crop</a>');
}

function save_editing() {
	$('#save_button span').remove();
	var image = $.editor.css('background-image').replace('url("', '');
	image = image.replace('")', '');
	image = image.replace('url(', '');
	image = image.replace(')', '');

	// ajax php call to save tmp file
	var filename = $('#filename').val();
	// ajax call php save stuff in text db
	$
			.ajax({
				type : 'POST',
				url : 'save.php',
				data : 'tmpfile=' + image + '&nufile=' + filename,
				success : function(txt) {
					if (txt == '-1') {
						// error, display error
						$('#save_button')
								.append(
										'<span style="color: red; float: left; line-height: 30px;">Error during save! Incorrect path or filename?</span>');
					} else {
						$('#save_button')
								.append(
										'<span style="color: #aaa; float: left; line-height: 30px;">File is saved!</span>');
					}
				}
			});

}