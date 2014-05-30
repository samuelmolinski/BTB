// Get params on init
var scripts = document.getElementsByTagName('script');
var myScript = scripts[ scripts.length - 1 ];
var queryString = myScript.src.replace(/^[^\?]+\??/,'');
var mint_prettyPhoto = parseQuery( queryString );


jQuery(function() {
	// and use them on dom ready
	var template = (mint_prettyPhoto === undefined) ? "pp_default" : mint_prettyPhoto.template;
	if (template == "default") template = "pp_default";
	var s = jQuery('.colorbox, .gallery .gallery-icon a, .zh-escroll a').attr('rel', 'prettyPhoto[pp_gal]').prettyPhoto({
		theme : template
	});
	
});