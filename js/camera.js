jQuery(function(){
			
	jQuery('#camera_wrap_1').camera({
		thumbnails: false,
		pagination: false,
		loader: 'bar'
	});

	jQuery('#camera_wrap_2').camera({
		height: '400px',
		loader: 'bar',
		pagination: false,
		thumbnails: true
	});
});