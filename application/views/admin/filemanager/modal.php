
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<div class="d-flex">
				<div class="input-icon mr-1 d-block">
			      	<span class="input-icon-addon">
				         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
			     	</span>
			      	<input type="text" value="<?= $filter_name ?>" name="search" class="form-control" placeholder="Enter Filename">
			   	</div>
				<button type="button" class="btn btn-secondary mr-1 btn-icon" data-href='<?= $parent ?>' id='button-parent'>
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-sm"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
				</button>
				<button type="button" class="btn btn-secondary mr-1 btn-icon" id='button-folder'>
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-sm"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg>
					
				</button>
				<button type="button" class="btn btn-secondary btn-icon mr-1" id='button-refresh'>
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-sm"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
					
				</button>
				<button type="button" id="button-upload" class="btn btn-secondary btn-icon  mr-1">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-sm"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
					
				</button>
				<button type="button" id="button-delete" class="btn btn-danger btn-icon mr-1">
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-sm"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
					
				</button>
			</div>
			<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
		</div>

		<div class="modal-body">
			<div class="row">
				<?php foreach ($images as $image) { ?>
					<div class="col-sm-4 col-lg-2">
						<div class="card card-sm">
							<?php if ($image['type'] == 'directory') { ?>
								<div class="image directory" data-href='<?= $image['href'] ?>'>
									<label class="form-check form-check-inline delete-check">
								         <input class="form-check-input bg-success border-success" type="checkbox" name="path[]" value='<?= $image['path'] ?>'>
								         <span class="form-check-label"></span>
							      	</label>
									<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
									<div class="name"><?= $image['name'] ?></div>
								</div>
							<?php } ?>
							<?php if ($image['type'] == 'image') { ?>
								<div class="image thumbnail">
									<label class="form-check form-check-inline delete-check">
								         <input class="form-check-input bg-success border-success" type="checkbox" name="path[]" value='<?= $image['path'] ?>'>
								         <span class="form-check-label"></span>
							      	</label>
									<div class="bg-image" data-path='<?= $image['path'] ?>' style="background-image: url(<?php echo $image['thumb']; ?>);"></div>
									<div class="name"><?= $image['name'] ?></div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>					
			</div>
		</div>
		<?php if($pagination){ ?>
			<div class="modal-footer">
				<div><?php echo $pagination; ?></div>
			</div>
		<?php } ?>
	</div>
</div>



<script type="text/javascript"><!--

<?php if ($target) { ?>
$('.image.thumbnail').on('click', function(e) {
	e.preventDefault();
	$card = $(this).parents("card");

	var img = $(this).find('.bg-image').css('background-image');
	img = img.replace('url(','').replace(')','').replace(/\"/gi, "");

	$('#<?php echo $target; ?>').find('.image').attr("src", img);
	$('#<?php echo $target; ?>').find('input').val($(this).find('.bg-image').attr("data-path"));
	$('#modal-image').modal('hide');	
});

<?php } ?>

$('.image.directory').on('click', function(e) {
	e.preventDefault();
	$('#modal-image').load($(this).attr('data-href'));
});

$('.pagination a').on('click', function(e) {
	e.preventDefault();
	$('#modal-image').load($(this).attr('href'));
});

$('#button-parent').on('click', function(e) {
	e.preventDefault();
	$('#modal-image').load($(this).attr('data-href'));
});

$('#button-refresh').on('click', function(e) {
	e.preventDefault();
	$('#modal-image').load('<?= $refresh ?>');
});

$('input[name=\'search\']').on('keydown', function(e) {
	if (e.which == 13) {
		var url = '<?= route("admin.filemanager.index") ?>?directory=<?php echo $directory; ?>';
		var filter_name = $('input[name=\'search\']').val();

		if (filter_name) {
			url += '&filter_name=' + encodeURIComponent(filter_name);
		}

		<?php if ($thumb) { ?>
		url += '&thumb=' + '<?php echo $thumb; ?>';
		<?php } ?>

		<?php if ($target) { ?>
		url += '&target=' + '<?php echo $target; ?>';
		<?php } ?>

		$('#modal-image').load(url);
	}
});

$('#button-upload').on('click', function() {
	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file[]" value="" multiple="multiple" /></form>');

	$('#form-upload input[name=\'file[]\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file[]\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: '<?= route("admin.filemanager.filemanager_upload") ?>?directory=<?php echo $directory; ?>',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
					$('#button-upload').prop('disabled', true);
				},
				complete: function() {
					$('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
					$('#button-upload').prop('disabled', false);
				},
				success: function(json) {
					if (json['error']) {
						alert(json['error']);
					}

					if (json['success']) {
						$('#button-refresh').trigger('click');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});

$('#button-folder').popover({
	html: true,
	placement: 'bottom',
	trigger: 'click',
	title: 'Folder',
	content: function() {
		html  = '<div class="input-group">';
		html += '  <input type="text" name="folder" value="" placeholder="Enter Folder Name.." class="form-control">';
		html += '  <span class="input-group-append"><button type="button" title="Folder" id="button-create" class="btn btn-primary"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class=""><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></button></span>';
		html += '</div>';

		return html;
	}
}).on("click", function (e) {
    e.stopPropagation();
});



$('#button-folder').on('shown.bs.popover', function() {
	$('#button-create').on('click', function() {
		$('.popover').popover('hide', function() { $('.popover').remove(); });

		$.ajax({
			url: '<?= route("admin.filemanager.filemanager_folder") ?>?directory=<?php echo $directory; ?>',
			type: 'post',
			dataType: 'json',
			data: 'folder=' + encodeURIComponent($('input[name=\'folder\']').val()),
			beforeSend: function() {
				$('#button-create').prop('disabled', true);
			},
			complete: function() {
				$('#button-create').prop('disabled', false);
			},
			success: function(json) {
				if (json['error']) {
					alert(json['error']);
				}

				if (json['success']) {
					$('#button-refresh').trigger('click');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
});

$("#modal-image .delete-check").on("click",function(e){
	e.stopPropagation();
	if($(this).find("input").prop("checked")){
		$(this).addClass("checked");
	} else{
		$(this).removeClass("checked");
	}

	if($('input[name^=\'path\']:checked').length > 0){
		$("#button-delete").show();
	} else{
		$("#button-delete").hide();
	}
})

$('#modal-image #button-delete').on('click', function(e) {
	if (confirm('Are you sure?')) {
		$.ajax({
			url: '<?= route("admin.filemanager.filemanager_delete") ?>',
			type: 'post',
			dataType: 'json',
			data: $('input[name^=\'path\']:checked'),
			beforeSend: function() {$('#button-delete').prop('disabled', true);},
			complete: function() {$('#button-delete').prop('disabled', false);},
			success: function(json) {
				if (json['success']) {
					$('#button-refresh').trigger('click');
				}
			},
		});
	}
});
//--></script>