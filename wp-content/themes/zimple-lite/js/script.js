(function ($) {
	'use strict';

	var tocial = {
		
		initReady: function() {
			this.mobileMenu();
			this.slideShow();
			this.scrollTop();
			this.stickyMenu();
		},

		stickyMenu: function() {
			var self = this;

			var catcher = $('#catcher'),
				sticky  = $('#sticky'),
				bodyTop = $('body').offset().top;

			if ( sticky.length ) {
				$(window).scroll(function() {
					self.stickThatMenu(sticky,catcher,bodyTop);
				});
				$(window).resize(function() {
					self.stickThatMenu(sticky,catcher,bodyTop);
				});
			}
		},

		stickThatMenu: function(sticky,catcher,top) {
			var self = this;

			if(self.isScrolledTo(sticky,top)) {
				sticky.addClass('sticky-menu');
				catcher.height(sticky.height());
			} 
			var stopHeight = catcher.offset().top;
			if ( stopHeight > sticky.offset().top) {
				$('#sticky').removeClass('sticky-menu');
				catcher.height(0);
			}
		},

		isScrolledTo: function(elem,top) {
			var docViewTop = $(window).scrollTop(); //num of pixels hidden above current screen
			var docViewBottom = docViewTop + $(window).height();

			var elemTop = $(elem).offset().top - top; //num of pixels above the elem
			var elemBottom = elemTop + $(elem).height();

			return ((elemTop <= docViewTop));
		},

		slideShow: function() {
			$('.flexslider').flexslider({
			    animation: "slide",
			    useCSS: false,
			    move: 1,
			    animationSpeed: 800,
			    itemWidth: 180,
			    itemMargin: 25
			});
		},

		mobileMenu: function() {
			var $top_menu = $('.primary-navigation');
			var $secondary_menu = $('.secondary-navigation');
			var $first_menu = '';
			var $second_menu = '';

			if ($top_menu.length == 0 && $secondary_menu.length == 0) {
				return;
			} else {
				if ($top_menu.length) {
					$first_menu = $top_menu;
					
					if($secondary_menu.length) {
						$second_menu = $secondary_menu;
						$('.top-nav').addClass('has-second-menu');
					}
				} else {
					$first_menu = $secondary_menu;
				}
			}
			var menu_wrapper = $first_menu
			.clone().attr('class', 'mobile-menu')
			.wrap('<div id="mobile-menu-wrapper" class="mobile-only"></div>').parent().hide()
			.appendTo('body');
			
			// Add items from the other menu
			if ($second_menu.length) {
				$second_menu.find('ul.menu').clone().appendTo('.mobile-menu');
			}
			
			$('.navbar-toggle').click(function(e) {
				e.preventDefault();
				e.stopPropagation();
				$('#mobile-menu-wrapper').show(); // only required once
				$('body').toggleClass('mobile-menu-active');
			});

			$('#page, .toggle-mobile-menu').click(function() {
				if ($('body').hasClass('mobile-menu-active')) {
					$('body').removeClass('mobile-menu-active');
				}
				if($('.menu-item-has-children .arrow-sub-menu').hasClass('fa-chevron-down')) {
					$('.menu-item-has-children .arrow-sub-menu').removeClass('fa-chevron-down').addClass('fa-chevron-right');
				}
			});

			$('<i class="fa arrow-sub-menu fa-chevron-right"></i>').insertAfter($('.menu-item-has-children > a'));

			if($('#wpadminbar').length) {
				$('#mobile-menu-wrapper').addClass('wpadminbar-active');
			}

			$('.menu-item-has-children .arrow-sub-menu').click(function(e) {
				e.preventDefault();
				var active = $(this).hasClass('fa-chevron-down');
				if(!active) {
					$(this).removeClass('fa-chevron-right').addClass('fa-chevron-down');
					$(this).next().slideDown();
				} else {
					$(this).removeClass('fa-chevron-down').addClass('fa-chevron-right');
					$(this).next().slideUp();
				}
			});

		},


		infiniteScroll: function() {
			var pageNumber = 2;
			var isLoading = false;
			jQuery(window).scroll(function(){
				
				if($(window).scrollTop() + $(window).height() > $('#main').height()) {

					if (pageNumber <= totalPages && isLoading === false) {
						jQuery.ajax({
							url: SuperAdsAjax.ajaxurl,
							type: 'POST',
							data: 'action=infinite_scroll&page_no='+ pageNumber + '&loop_file=content',
							beforeSend: function () {
								isLoading = true;
								$('.scroll-loading').show();
							},
							success: function (data) {
								jQuery('#post-container').append(data); 
								isLoading = false;
								pageNumber++;
								$('.scroll-loading').removeAttr('style');
							}
							
						});
					}
				}
			}); 
		},

		scrollTop: function() {
			var scrollDes = 'html,body';  
			// Opera does a strange thing if we use 'html' and 'body' together so my solution is to do the UA sniffing thing
			if(navigator.userAgent.match(/opera/i)){
				scrollDes = 'html';
			}
			// Show ,Hide
			$(window).scroll(function () {
				if ($(this).scrollTop() > 130) {
					$('.back-to-top').addClass('filling').removeClass('hiding');
					$('.sharing-top-float').fadeIn();
				} else {
					$('.back-to-top').removeClass('filling').addClass('hiding');
					$('.sharing-top-float').fadeOut();
				}
			});
			// Scroll to top when click
			$('.back-to-top').click(function () {
				$(scrollDes).animate({ 
					scrollTop: 0
				},{
					duration :500
				});

			});
		}

	}
	$(document).ready(function () {
		tocial.initReady();
	});

})(jQuery);