// Mint Class
var Mint = function() {
  mint = this;
  this.init();
}

Mint.prototype = {
	init : function() {

    if(mint_options.header.sticky)
    {
      if(jQuery("body").width() > 820) // use sticky only on desktop version of the site
      {
        try { jQuery("header").waypoint('sticky'); }catch(err) {}
      }
    }

    this.initPinterest();
    this.initSlider();
    this.initMacBookSlider();
    this.initCarousel();
    this.fixAudioPlayerWidth();
    this.infiniteScroll();
    this.setPortfolio(); // on portfolio page
    this.retina();
    this.setFullwidth(); // use for set fullwidth on elements that have class .fullwidth
    this.toTop();
    this.menu();
    this.initSC();
    this.colorizeImg();
    this.ajaxTimeline();
    this.initGrayscale(); // adds support for IE
    this.initParallax();// add parallax effect
    this.alertMessages(); // handle close for alert messages

    // menu handler for responsive design
    if(mint_options.main.responsive)
    {
      MintMenu.init();

      // hide sliders on mobile devices
      if(MintMenu.isMobile)
      {
        if(mint_options.main.hide_sliders)
        {
          jQuery(".rev_slider_wrapper").css("display", "none");
          jQuery(".ls-wp-fullwidth-container").css("display", "none");
        }
      }

      MintResponsive.init();
      jQuery(window).resize(function() {
        MintResponsive.init();
        mint.setFullwidth(); // use for set fullwidth on elements that have class .fullwidth
        mint.toTop();
      });
    }

    // pinterest fix after the page is loaded.
    setTimeout(function() {
      mint.initPinterest();
    }, 1000);

    // init sliders
    var ms = new MintSliders();
    ms.quoteSlider(); // for quote sliders
  },

  initSC : function() {
    // counter
    jQuery(".mint-counter").each(function(index, el) {
      var number = jQuery(el).find(".mint-counter-number");
      var start = number.data("mint-start");
      var end = number.data("mint-end");
      var currentVal = start;

      function increment(){
          currentVal = currentVal + 1;
          number.text(currentVal);
          if(currentVal >= end){ _caf(increment); }
          else { _raf(increment); }
      }
      increment();
    });
  },

  initPinterest : function() {
    mint.getPinterest();
  },

  getPinterest : function() {
    if (jQuery().wookmark)
    {
        jQuery(".blog-pinterest article").wookmark({
            autoResize: false,
            offset: 20,
            outerOffset: 0,
            flexibleWidth : 360,
            container: jQuery('.blog-pinterest')
          });
    }
  },


  grayscale : function(src){
        var canvas = document.createElement('canvas');
		var ctx = canvas.getContext('2d');
        var imgObj = new Image();
		imgObj.src = src;
		canvas.width = imgObj.width;
		canvas.height = imgObj.height; 
		ctx.drawImage(imgObj, 0, 0); 
		var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
		for(var y = 0; y < imgPixels.height; y++){
			for(var x = 0; x < imgPixels.width; x++){
				var i = (y * 4) * imgPixels.width + x * 4;
				var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
				imgPixels.data[i] = avg; 
				imgPixels.data[i + 1] = avg; 
				imgPixels.data[i + 2] = avg;
			}
		}
		ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
		return canvas.toDataURL();
  },

  // fixes ie 
  initGrayscale : function() 
  {
  	jQuery('.mint-team-container img').each(function(){
		var el = jQuery(this);
		el.css({"position":"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass('img_grayscale').css({"position":"absolute","z-index":"998","opacity":"0"}).insertBefore(el).queue(function(){
			var el = jQuery(this);
			el.parent().css({"width":this.width,"height":this.height});
			el.dequeue();
		});
		this.src = mint.grayscale(this.src);
	});

	jQuery('.mint-team-container img').on('mouseover', function(){
			
			jQuery(this).stop().animate({opacity:1}, 300);
	});

		jQuery('.img_grayscale').mouseout(function(){
			jQuery(this).stop().animate({opacity:0}, 300);
		});	

  },

  initParallax : function() {
    jQuery('.mint-parallax-scene').parallax({
     calibrateX: false,
  calibrateY: true,
  invertX: false,
  invertY: true,
  limitX: false,
  limitY: 1000,
  scalarX: 0,
  scalarY: 8,
  frictionX: 0.2,
  frictionY: 0.8
    });
  },

  alertMessages : function() {
    jQuery(".mint-alert-close").on("click", function() {
      var parent = jQuery(this).closest(".mint-alert-messages");
      parent.fadeOut("fast", function() {
        jQuery(this).remove();
      });
      
      return false;
    });
  },

  initSlider : function() {
    var sliders = jQuery(".mint-slider");

    sliders.each(function(index, el) {
      var slider                = jQuery(el);
      var sliderMain            = slider.find(".mint-slider-main");
      var sliderArrowsContainer = slider.find(".mint-slider-arrows");
      var sliderPager           = slider.next(".mint-slider-pager");
      var sliderBullets         = slider.find(".mint-slider-bullets a");
      var sliderEasing          = slider.data("slider-easing") || "linear";
      var sliderMode            = slider.data("slider-mode") || "horizontal";
      var sliderThumbnails      = sliderPager;

      var bxSliderMain = sliderMain.bxSlider({
        auto : true,
        autoHover : true,
        mode : sliderMode,
        easing : sliderEasing,
        adaptiveHeight : true,
        nextSelector : sliderArrowsContainer,
        prevSelector : sliderArrowsContainer,
        nextText: '<i class="icon-right-open"></i>',
        prevText: '<i class="icon-left-open"></i>',

        pagerCustom : sliderPager,

        onSlideBefore : function($slideElement, oldIndex, newIndex) {
          sliderBullets.eq(oldIndex).removeClass("active");
          sliderBullets.eq(newIndex).addClass("active");
        },

        onSliderLoad : function(currentIndex) {
          sliders.css("opacity", 1);
          mint.getPinterest();
          mint.setFullwidth();
          sliderBullets.eq(currentIndex).addClass("active");
        }
      });

      // if thumbnails is presented
      if(sliderThumbnails.length > 0)
      {
        var sliderThumbnails = sliderThumbnails.bxSlider({
          auto : true,
          autoHover : true,
          pager : false,
          controls : false,
          minSlides: 3,
          maxSlides: 30,
          slideWidth: 84,
          slideMargin: 5
        });

        sliderThumbnails.reloadSlider();
      }

      // custom bullets api
      sliderBullets.on("click", function() {
        var bullet = jQuery(this);
        var index = bullet.index();
        bxSliderMain.goToSlide( index );

        return false;
      });

    });
  },

  initMacBookSlider : function() {
    jQuery(".macbook_slider").bxSlider({
      pager : false,
      auto : true,
      controls : true,
      responsive :false,
      nextText : '',
      prevText : ''
    });
  },

  initCarousel : function() {
    var carousels = jQuery(".mint-carousel");

    carousels.each(function(index, el) {
      var carouselContainer       = jQuery(el);
      var carouselImageContainer  = carouselContainer.find(".mint-carousel-container");
      var carouselArrowsContainer = carouselContainer.find(".mint-carousel-arrows"); 
      
      // carousel call
      carouselImageContainer.bxSlider({
        auto : true,
        autoHover : true,
        minSlides : 3,
        maxSlides : 30,
        slideWidth : 100,
        slideMargin : 7,
        pager : false,
        nextSelector : carouselArrowsContainer,
        prevSelector : carouselArrowsContainer,
        nextText: '<i class="icon-right-open"></i>',
        prevText: '<i class="icon-left-open"></i>'
      });
    });
  },

  menu : function() {
  },

  setFullwidth : function() {
    var width = (jQuery(".all-elastic").length > 0) ? jQuery(".all-elastic").width() : jQuery("body").width();
    var contentWidth = jQuery(".elastic").width();
    var sideWidth = (width - contentWidth) / 2;
    jQuery(".fullwidth").css({
      marginLeft : - sideWidth + "px",
      width : width + "px"
    });
  },

  setPortfolio : function() {
    if(jQuery().wookmark)
    {
      var layout = jQuery(".portfolio-layout");
      var layout_type = layout.data("mint-layout");
      // Get a reference to your grid items.
      var handler = jQuery('.portfolio-layout .mint-portfolio-item'),
          filters = jQuery('#filters a');

      var per_row = layout.data("mint-columns");
      var item_width = 470; // item width based on items per page

      switch(per_row)
      {
        case 2:
          item_width = 470;
          break;
        case 3:
          item_width = 315;
          break;
        case 4:
          item_width = 235;
          break;
      }

      if(layout_type == "simple")
      {
         var options = {
          autoResize : false,
          offset : 1,
          outerOffset : 0,
          flexibleWidth : item_width,
          container : layout
        };
      }
      else
      {
        var options = {
          autoResize : false,
          offset : 20,
          outerOffset : 0,
          flexibleWidth : item_width,
          container : layout
        };
      }

      handler.wookmark(options);

      // Filters **********************************************/
      /**
       * When a filter is clicked, toggle it's active state and refresh.
       */
      var onClickFilter = function(event) {
        var item = jQuery(event.currentTarget),
            activeFilters = [];

        if (!item.hasClass('active')) {
          filters.removeClass('active');
        }
        item.toggleClass('active');

        // Filter by the currently selected filter
        if (item.hasClass('active')) {
          activeFilters.push(item.data('filter'));
        }

        handler.wookmarkInstance.filter(activeFilters);

        return false;
      }

      // Capture filter click events.
      filters.click(onClickFilter);

      // check for image if loaded in wookmark complete
      function portfolioImagesLoaded() {
        handler.wookmark(options);
        setTimeout(function() {
          handler.wookmark(options);
        }, 1500);
      }
      var queue = new createjs.LoadQueue(true);
      queue.addEventListener('complete', portfolioImagesLoaded);

      var images = [];
      handler.each(function(index, el) {
        images[index] = jQuery(el).find("img").attr("src");
      });
      for (i in images)
      {
        queue.loadFile(images[i]);
      }

      setTimeout(function() {
        handler.wookmark(options);
      }, 1000);
    }
  },

  fixAudioPlayerWidth : function() {
    var audioElement = jQuery(".wp-audio-shortcode .mejs-controls div.mejs-horizontal-volume-slider");
    var audioWidth = audioElement.width();
    setTimeout(function() {
      audioElement.width( audioWidth - 2 + "px");
    }, 100);

    jQuery(".mejs-playpause-button").on("click", function() {
      setTimeout(function() {
        audioElement.width(audioWidth - 5 + "px");
      }, 100);
    });
  },

  toTop: function() {
    jQuery(window).scroll(function() {

      if(jQuery(window).scrollTop() >= 400) // 400 height
      {
        jQuery('#toTop').fadeIn(300);
      }
      else
      {
        jQuery('#toTop').fadeOut(300);
      }

    });

    jQuery('body').on('click', '#toTop', function() {
      jQuery('html, body').animate({ scrollTop: 0 }, 600);
      
    }); 
  },

  retina : function() {
    try {
      if (jQuery.fn.retina) {

        jQuery('img').retina({checkIfImageExists:true});
      }
    } catch(e) {}
  },

  infiniteScroll : function()
  {
   
      if (jQuery.infinitescroll)
      {
          if (jQuery('#mint-content').hasClass('blog-layout-grid2') || jQuery('#mint-content').hasClass('blog-layout-grid3') || jQuery('#mint-content').hasClass('blog-layout-grid4'))
          {
             var selector = ".blog-inner-content .row";
          }
          else
          {
            var selector = ".blog-inner-content article";
          }

        
          jQuery('.blog-inner-content').infinitescroll({
              navSelector : 'ul.pagination',
              nextSelector: 'ul.pagination a.next',
              itemSelector : selector,
              donetext     : '<p>There are no more items to load.</p>',
              loading      : {
                  finished : function() {
                     mint.initPinterest();
                  }
              }
          });
      }
  },

  colorizeImg : function() {
    var canvas = jQuery("canvas#footer-header-label-img");

    if(canvas.length == 0) return;

    var width  = canvas.attr("width");
    var height = canvas.attr("height");
    var color  = canvas.data("color");
    var img    = canvas.data("src");
    var ctx    = canvas[0].getContext("2d");
    var rgb    = hexToRgb(color);

    var objImg = new Image();
    objImg.src = img;
    objImg.onload = function() {
      ctx.drawImage(objImg, 0, 0);
      var imageData = ctx.getImageData(0, 0, width, height);
      var data = imageData.data;
     
      for(var i = 0; i < data.length; i += 4)
      {
        data[i]     = rgb.r;
        data[i + 1] = rgb.g;
        data[i + 2] = rgb.b;
      }

      ctx.putImageData(imageData,0,0);
    }


  },

  ajaxTimeline : function() {
    jQuery(".ajax-timeline-load").on("click", function() {
      var $this = jQuery(this);
      var show = parseInt($this.data("mint-show"));
      var currentPage = parseInt($this.data("mint-current"));
      var offset = currentPage * show;
      var color = $this.data("mint-color");
      var cat = $this.data("mint-cat");
      var type = $this.data("mint-type");

      var data = { 
        action : "timeline_load",
        offset : offset,
        show : show,
        color : color,
        cat : cat,
        type : type
      };

      $this.addClass("load_timeline");

      var last_item = $this.closest(".mint-timeline").find(".mint-timeline-item").last();
      jQuery.post(mint_options.ajax_url, data, function(resp) {
        $this.removeClass("load_timeline");
        if(resp.success == false)
        {
           $this.text(resp.data.msg).addClass("disabled");
        }
        else
        {
          if(resp.data)
          {
            $this.text(resp.data.msg).addClass("disabled");
          }
          else
          {
            last_item.after(resp);
            $this.data("mint-current", currentPage + 1);
          }
        }
      });
      return false;
    });
  }
  
}

var MintMenu = {

  // variables declaration
  width : jQuery(window).width(),
  height : jQuery(window).height(),
  isMobile : false,
  isDesktop : true,
  breakpoint : 820,

  // set basic variables
  setVariables : function() {
    MintMenu.width = jQuery(window).width();
    MintMenu.height = jQuery(window).height();
  },


  init : function() {
    MintMenu.prepareMenu();
    MintMenu.toggleMenu();
    MintMenu.initMenu();

    // on resize
    jQuery(window).resize(function() {
      MintMenu.setVariables();
      MintMenu.toggleMenu();
      MintMenu.initMenu();
    });

  },

  prepareMenu : function() {

  },

  initMenu : function() {
    if(MintMenu.isMobile)
    {
      jQuery("body").off("click").on("click", "#menu-toggle", function() {
        jQuery(".mobile-menu").slideToggle();
        return false;
      });
    }
    else
    {
      
    }
  },

  // toggle between mobile and desktop version of menu
  toggleMenu : function() {
    if(MintMenu.width < MintMenu.breakpoint)
    {
      MintMenu.isMobile = true;
      MintMenu.isDesktop = false;
      MintMenu.addMenuToggle();
      jQuery(".main-menu").addClass("is-hidden");
      jQuery(".mobile-menu").removeClass("is-hidden");
    }
    else
    {
      MintMenu.isMobile = false;
      MintMenu.isDesktop = true;
      MintMenu.removeMenuToggle();
      jQuery(".main-menu").removeClass("is-hidden");
      jQuery(".mobile-menu").addClass("is-hidden");
    }
  },

  addMenuToggle : function() {
    if(jQuery("#menu-toggle").length > 0) return;

    jQuery("header").append("<a class='icon-menu' id='menu-toggle' href='#'></a>");
  },

  removeMenuToggle : function() {
    jQuery("#menu-toggle").remove();
  }
};

jQuery(function() {
	var mint = new Mint();
});

// Utilities
// Animation Heart
var _raf = window.requestAnimationFrame, 
        _caf = window.cancelAnimationFrame,
        _p = ["webkit","moz","ms","o"];
var i = _p.length;
while (--i > -1 && !_raf) 
{
        _raf = window[_p[i] + "RequestAnimationFrame"];
        _caf = window[_p[i] + "CancelAnimationFrame"] || window[_p[i] + "CancelRequestAnimationFrame"];
}

// for no requestAnimationFrame support
if(!_raf)
{
        _raf = (function() { return function(cb){ window.setTimeout(cb, 1000 / 60); } })();
        _caf = function(id) { clearTimeout(id) };
}

// Parses query strings
function parseQuery ( query ) {
  var Params = new Object ();
  if ( ! query ) return Params; // return empty object
  var Pairs = query.split(/[;&]/);
  for ( var i = 0; i < Pairs.length; i++ ) {
    var KeyVal = Pairs[i].split('=');
    if ( ! KeyVal || KeyVal.length != 2 ) continue;
    var key = unescape( KeyVal[0] );
    var val = unescape( KeyVal[1] );
    val = val.replace(/\+/g, ' ');
    Params[key] = val;
  }
  return Params;
}

function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

// Responsive Part 
MintResponsive = {
  init : function() {
    self = this;
    this.width = jQuery("body").width();
    this.height = jQuery("body").height();
  }
}

// All Extended Sliders
function MintSliders(params)
{
  self = this;
  self.params = params;
}

MintSliders.prototype = {
  quoteSlider : function() {
    jQuery(".animateblock").bxSlider({
      pager : true,
      controls : false,
      auto : true
    });
  }
}

// Parallax effect
