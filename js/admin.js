jQuery(function() {

	var MintAdmin = {
		maps : {
			apikey : "AIzaSyBpkDQC8jb8lUOuFvqCUIpT4bFSLlYdehQ"
		}
	};

	// Load Google Map API
	
	/* (function () {
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        //s.src = "https://maps.googleapis.com/maps/api/js?v=3.exp&key="+MintAdmin.maps.apikey+"&sensor=false";
        //s.src = "https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false";
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    })();*/

	// Make preview icons for Visual Composer in all browsers (Chrome)
	jQuery('body').on('change keypress keyup', '.wpb_bootstrap_modals .icon.wpb-select', function(e) {
		
		var ic = jQuery(this).find('option:selected').val();

		jQuery('#ic-preview').remove();
		jQuery('<span>').attr('class', ic).attr('id', 'ic-preview').insertAfter( jQuery(this).parent().prev() );
	});


	// Let users enter their address and get an iframe link in return
	jQuery('body').on('click', '#mint-vc-gmap', function() {
		var input =  jQuery(this).parent().prev();
		input.val( "https://maps.google.com/maps?q="+encodeURI(input.val())+"&output=embed" );
	
		/*
		var val = input.val();
		var gc = new google.maps.Geocoder();
		var el = jQuery(this);
		el.text('Loading ...');
		gc.geocode( {address: val }, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK)
			{	
				var coords = results[0].geometry.location;
				input.val("https://maps.google.com/maps?ll="+coords.d+","+coords.e+"&spn=0.012719,0.033023&t=m&z=16&iwloc=near&lci=com.panoramio.all");
				console.log( results[0] );
				el.text('Get Link');
			}
		});
		*/
	});

});