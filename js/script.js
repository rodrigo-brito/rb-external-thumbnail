jQuery(document).ready(function ($) {
	var image = $('input[name="thumbnail_external"]').val();
	var content = $('#thumbnail_external .inside').append('<figure id="external_thumbnail_preview"><img src="'+image+'"></figure>');

	$( 'input[name="thumbnail_external"]' ).change(function() {
		image = $('input[name="thumbnail_external"]').val();
		$('#external_thumbnail_preview img').attr("src", image);
	});
});