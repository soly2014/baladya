
(function($) {
	"use strict";

	/* ------------------------------------------------------------------------ */
	/*	BOOTSTRAP FIX FOR WINPHONE 8 AND IE10
	/* ------------------------------------------------------------------------ */
	if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
		var msViewportStyle = document.createElement("style")
		msViewportStyle.appendChild(
			document.createTextNode(
				"@-ms-viewport{width:auto!important}"
			)
		)
		document.getElementsByTagName("head")[0].appendChild(msViewportStyle)
	}

	function detectIE() {
		if ($.browser.msie && $.browser.version == 9) {
			return true;
		}
		if ($.browser.msie && $.browser.version == 8) {
			return true;
		}
		return false;
	}

	function getWindowWidth() {
		return Math.max( $(window).width(), window.innerWidth);
	}

	function getWindowHeight() {
		return Math.max( $(window).height(), window.innerHeight);
	}


	//BEGIN DOCUMENT.READY FUNCTION
	jQuery(document).ready(function($) {

		$.browser.chrome = $.browser.webkit && !!window.chrome;
		$.browser.safari = $.browser.webkit && !window.chrome;

		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			$('body').addClass('mobile');
		}
		
		if ($.browser.chrome) {
			$('body').addClass('chrome');
		}
		
		if ($.browser.safari) {
			$('body').addClass('safari');
		}
		
		
		/* ------------------------------------------------------------------------ */
		/*	REFRESH WAYPOINTS
		/* ------------------------------------------------------------------------ */
		function refreshWaypoints() {
			setTimeout(function() {
				$.waypoints('refresh');
			}, 1000);   
		}
		
		
		/* ------------------------------------------------------------------------ */
		/*	ANIMATED ELEMENTS
		/* ------------------------------------------------------------------------ */	
		if( !$('body').hasClass('mobile') ) {

			$('.animated').appear();

			if( detectIE() ) {
				$('.animated').css({
					'display':'block',
					'visibility': 'visible'
				});
			} else {
				$('.animated').on('appear', function() {
					var elem = $(this);
					var animation = elem.data('animation');
					if ( !elem.hasClass('visible') ) {
						var animationDelay = elem.data('animation-delay');
						if ( animationDelay ) {
							setTimeout(function(){
								elem.addClass( animation + " visible" );
							}, animationDelay);
						} else {
							elem.addClass( animation + " visible" );
						}
					}
				});
				
				/* Starting Animation on Load */
				$(window).load(function() {
					$('.onstart').each( function() {
						var elem = $(this);
						if ( !elem.hasClass('visible') ) {
							var animationDelay = elem.data('animation-delay');
							var animation = elem.data('animation');
							if ( animationDelay ) {
								setTimeout(function(){
									elem.addClass( animation + " visible" );
								}, animationDelay);
							} else {
								elem.addClass( animation + " visible" );
							}
						}
					});
				});	
				
			}

		}
		
		
		/* ------------------------------------------------------------------------ */
		/*	FULLPAGE
		/* ------------------------------------------------------------------------ */	
		$('#fullpage').fullpage({
			anchors: ['firstPage', 'secondPage', '3rdPage', '4thPage', 'lastPage'],
			menu: '#menu',
			scrollingSpeed: 800,
			autoScrolling: true,
			scrollBar: true,
			easing: 'easeInQuart',
			resize : false,
			paddingTop: '80px',
			paddingBottom: '80px',
			responsive: 1000,
		});
		
		$('a.go-slide').on( 'click', function() {
			var elem = $(this),
				slideID = elem.data('slide');
				
			$.fn.fullpage.moveTo(slideID);
		});
		
		
		/* ------------------------------------------------------------------------ */
		/*	BACKGROUNDS
		/* ------------------------------------------------------------------------ */	
		function initPageBackground() {
			if($('body').hasClass('image-background')) { // IMAGE BACKGROUND
			
				$("body").backstretch([
					"demo/background/image-1.jpg"
				]);
				
			} else if( $('body').hasClass('slideshow-background') ) { // SLIDESHOW BACKGROUND
			
				$("body").backstretch([
					"demo/background/image-1.jpg",
					"demo/background/image-2.jpg",
					"demo/background/image-3.jpg",
				], {duration: 3000, fade: 1200});
			
			} else if($('body').hasClass('youtube-background')) { // YOUTUBE VIDEO BACKGROUND
				if($('body').hasClass('mobile')) {
					
					// Default background on mobile devices
					$("body").backstretch([
						"demo/video/video.jpg"
					]);
					
				} else {
					$(".player").each(function() {
						$(".player").mb_YTPlayer();
					});
				}
			} else if($('body').hasClass('youtube-list-background')) { // YOUTUBE LIST VIDEOS BACKGROUND
				if($('body').hasClass('mobile')) {
					
					// Default background on mobile devices
					$("body").backstretch([
						"demo/video/video.jpg"
					]);
					
				} else {
				
					var videos = [
						{videoURL: "0pXYp72dwl0",containment:'body',autoPlay:true, mute:true, startAt:0,opacity:1, loop:false, ratio:"4/3", addRaster:true},
						{videoURL: "9d8wWcJLnFI",containment:'body',autoPlay:true, mute:true, startAt:0,opacity:1, loop:false, ratio:"4/3", addRaster:false},
						{videoURL: "nam90gorcPs",containment:'body',autoPlay:true, mute:true, startAt:0,opacity:1, loop:false, ratio:"4/3", addRaster:true}
					];
					
					$(".player").YTPlaylist(videos, true);
					
				}
			} else if($('body').hasClass('mobile')) { // MOBILE BACKGROUND - Image background instead of video on mobile devices
				if($('body').hasClass('video-background')) {
					
					// Default background on mobile devices
					$("body").backstretch([
						"demo/video/video.jpg"
					]);
					
				}	
			}
		}
		
		initPageBackground();
		
		
		/* ------------------------------------------------------------------------ */
		/*	IOS
		/* ------------------------------------------------------------------------ */
		function iosdetect() {
			var deviceAgent = navigator.userAgent.toLowerCase();
			var $iOS = deviceAgent.match(/(iphone|ipod|ipad)/);
		 
			if ($iOS) {
				var divs = $('#home');
				var vid = $('#video_background');
				var h = window.innerHeight;
				var divh = $("#home").height();
				divs.css({ "position": "relative", "top": (h-divh)/2, "margin-top": "0" });
				vid.css({ "display": "none"});
				$(window).resize(function() {
					var divs = $('#home');
					var h = window.innerHeight;
					var divh = $("#home").height();
					divs.css({ "position": "relative", "top": (h-divh)/2, "margin-top": "0" });
				});
		 
				// use fancy CSS3 for hardware acceleration
			}
		}
		
		iosdetect();
	  
		

	
		initContactForm();
			
	});
	//END DOCUMENT.READY FUNCTION

})(jQuery);