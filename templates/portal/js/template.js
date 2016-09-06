jQuery(document).ready(function(){

	jQuery(".sidebar ul ul").addClass("nav-list");

	// Fixes default classes not applied to Joomal contact forms for open items
	jQuery(".zenslider").addClass("start");
	jQuery(".zenslider h3").click(function () {
		jQuery(this).parent().removeClass("start");
	});

	// Width check for sidebar tabs
	jQuery('#side-bar-tabs').zenwidthcheck({
		   width: "240",
		   targetclass: "thin"
	});


	jQuery("#mod-search-searchword").focus(function(){
	        jQuery(this).css({"text-indent": "0"}).animate({ width:"100%"}, 'normal');
	    }).blur(function(){
	        jQuery(this).css({"text-indent": "-9999em"}).animate({ width:"40px"}, 'slow');
	});

	jQuery(".icon-search").click(function(){
		if(jQuery("#mod-search-searchword").width() < 40) {
			jQuery("#mod-search-searchword").focus();
		}
	});

	// Removes any search label added in module params for this position
	jQuery('#navsearch .form-search .search label').text('');


	jQuery(window).smartresize(function() {
		jQuery('#side-bar-tabs').zenwidthcheck({
			   width: "240",
			   targetclass: "thin"
		});

		if(jQuery(window).width() < 620) {
			jQuery('#side-bar-tabs').addClass("thin");
		}
		else {

		}

	});

	// Check to make tags absolute
	if(jQuery("#mainWrap .item-image").length > 0) {
		jQuery("#mainWrap .item-page").addClass("hasimage");
	}


	// Fixes default classes not applied to Joomal contact forms for open items
	jQuery(".accordion-toggle").prepend("<span class='accordion-icon'></span>");
		jQuery(".accordion-toggle").not(":first").addClass("collapsed");
	});

jQuery(window).load(function() {
	function bannerHeight() {
		var navHeader = jQuery("#navwrap").height() + jQuery("#logowrap").height();
		var banner = jQuery("#banner").height() - navHeader -30;

		jQuery("#banner").css({marginTop: -navHeader + 'px'});

	}

	bannerHeight();

	jQuery(window).smartresize(function() {
		bannerHeight();
	});
});





(function($){$.fn.lazyload=function(options){var settings={threshold:0,failurelimit:0,event:"scroll",effect:"show",container:window};if(options){$.extend(settings,options);}
var elements=this;if("scroll"==settings.event){$(settings.container).bind("scroll",function(event){var counter=0;elements.each(function(){if(!$.belowthefold(this,settings)&&!$.rightoffold(this,settings)){$(this).trigger("appear");}else{if(counter++>settings.failurelimit){return false;}}});var temp=$.grep(elements,function(element){return!element.loaded;});elements=$(temp);});}
return this.each(function(){var self=this;$(self).attr("original",$(self).attr("src"));if("scroll"!=settings.event||$.belowthefold(self,settings)||$.rightoffold(self,settings)){if(settings.placeholder){$(self).attr("src",settings.placeholder);}else{$(self).removeAttr("src");}
self.loaded=false;}else{self.loaded=true;}
$(self).one("appear",function(){if(!this.loaded){$("<img />").bind("load",function(){$(self).hide().attr("src",$(self).attr("original"))
[settings.effect](settings.effectspeed);self.loaded=true;}).attr("src",$(self).attr("original"));};});if("scroll"!=settings.event){$(self).bind(settings.event,function(event){if(!self.loaded){$(self).trigger("appear");}});}});};$.belowthefold=function(element,settings){if(settings.container===undefined||settings.container===window){var fold=$(window).height()+$(window).scrollTop();}
else{var fold=$(settings.container).offset().top+$(settings.container).height();}
return fold<=$(element).offset().top-settings.threshold;};$.rightoffold=function(element,settings){if(settings.container===undefined||settings.container===window){var fold=$(window).width()+$(window).scrollLeft();}
else{var fold=$(settings.container).offset().left+$(settings.container).width();}
return fold<=$(element).offset().left-settings.threshold;};$.extend($.expr[':'],{"below-the-fold":"$.belowthefold(a, {threshold : 0, container: window})","above-the-fold":"!$.belowthefold(a, {threshold : 0, container: window})","right-of-fold":"$.rightoffold(a, {threshold : 0, container: window})","left-of-fold":"!$.rightoffold(a, {threshold : 0, container: window})"});


	$.fn.zenwidthcheck = function (options) {

		 // Create some defaults, extending them with any options that were provided
			var settings = $.extend({
				width: '300',
				targetclass: 'thin'
			}, options);

		var el=$(this);

		// Remove the class
		jQuery(el).removeClass(settings.targetclass);

		// If smaller than the width assign the class
		if(jQuery(el).width() < settings.width ) {
			jQuery(el).addClass(settings.targetclass);
		}
	};


})(jQuery);


(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 30);
      };
  }
  // smartresize
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');


/*
	Breakpoints.js
	version 1.0

	Creates handy events for your responsive design breakpoints

	Copyright 2011 XOXCO, Inc
	http://xoxco.com/

	Documentation for this plugin lives here:
	http://xoxco.com/projects/code/breakpoints

	Licensed under the MIT license:
	http://www.opensource.org/licenses/mit-license.php

*/
(function($) {

	var lastSize = 0;
	var interval = null;

	$.fn.resetBreakpoints = function() {
		$(window).unbind('resize');
		if (interval) {
			clearInterval(interval);
		}
		lastSize = 0;
	};

	$.fn.setBreakpoints = function(settings) {
		var options = jQuery.extend({
							distinct: true,
							breakpoints: new Array(320,480,768,1024)
				    	},settings);


		interval = setInterval(function() {

			var w = $(window).width();
			var done = false;

			for (var bp in options.breakpoints.sort(function(a,b) { return (b-a) })) {

				// fire onEnter when a browser expands into a new breakpoint
				// if in distinct mode, remove all other breakpoints first.
				if (!done && w >= options.breakpoints[bp] && lastSize < options.breakpoints[bp]) {
					if (options.distinct) {
						for (var x in options.breakpoints.sort(function(a,b) { return (b-a) })) {
							if ($('body').hasClass('breakpoint-' + options.breakpoints[x])) {
								$('body').removeClass('breakpoint-' + options.breakpoints[x]);
								$(window).trigger('exitBreakpoint' + options.breakpoints[x]);
							}
						}
						done = true;
					}
					$('body').addClass('breakpoint-' + options.breakpoints[bp]);
					$(window).trigger('enterBreakpoint' + options.breakpoints[bp]);

				}

				// fire onExit when browser contracts out of a larger breakpoint
				if (w < options.breakpoints[bp] && lastSize >= options.breakpoints[bp]) {
					$('body').removeClass('breakpoint-' + options.breakpoints[bp]);
					$(window).trigger('exitBreakpoint' + options.breakpoints[bp]);

				}

				// if in distinct mode, fire onEnter when browser contracts into a smaller breakpoint
				if (
					options.distinct && // only one breakpoint at a time
					w >= options.breakpoints[bp] && // and we are in this one
					w < options.breakpoints[bp-1] && // and smaller than the bigger one
					lastSize > w && // and we contracted
					lastSize >0 &&  // and this is not the first time
					!$('body').hasClass('breakpoint-' + options.breakpoints[bp]) // and we aren't already in this breakpoint
					) {
					$('body').addClass('breakpoint-' + options.breakpoints[bp]);
					$(window).trigger('enterBreakpoint' + options.breakpoints[bp]);

				}
			}

			// set up for next call
			if (lastSize != w) {
				lastSize = w;
			}
		},250);
	};

})(jQuery);
