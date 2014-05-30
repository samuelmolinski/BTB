/*
 * Twitter Search Plugin jquery.retina.js
 * https://github.com/tylercraft/jQuery-Retina
 *
 * Copyright (c) 2012 tylercraft.com
 * Author: Tyler Craft
 * Dual licensed under the MIT and GPL licenses.
 * https://github.com/tylercraft/jQuery-Retina
 *
 */
(function(e){e.fn.retina=function(t){var n={dataRetina:true,suffix:"",checkIfImageExists:false,customFileNameCallback:"",overridePixelRation:false};if(t){jQuery.extend(n,t)}var r=false;if(n.overridePixelRation||window.devicePixelRatio>=1.2){r=true}return this.each(function(){var t=e(this);t.addClass("retina-off");if(!r){return false}var i="";if(n.dataRetina&&t.attr("data-retina")){i=t.attr("data-retina")}if(n.suffix){if(!i){i=t.attr("src")}}if(n.suffix){var s=i.replace(/.[^.]+$/,"");var o=i.replace(/^.*\./,"");i=s+n.suffix+"."+o}if(n.customFileNameCallback){i=n.customFileNameCallback(t)}if(n.checkIfImageExists&&i){e.ajax({url:i,type:"HEAD",success:function(){t.attr("src",i);t.removeClass("retina-off");t.addClass("retina-on")}})}else if(i){t.attr("src",i);t.removeClass("retina-off");t.addClass("retina-on")}})}})(jQuery)