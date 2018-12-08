/**
 * Handles toggling the navigation menu for Desktop/Tablets/Phones and
 * accessibility for submenu items.
 */

jQuery(document).ready(function ($) {
    'use strict';

    (function () {
        var oldTouchPos,
            resizeId,
            cachedWindowWidth = $(window).width();


//This function is responsible for slideDown animation of next sub-menu	
        function animateNextSub($this, minus, getHref) {

            if ($this.next('.sub-menu').length) {

                $this.removeAttr('href');//Prevent link default behaviour (on first touch don't go to other page )
                $this.next('.sub-menu').slideDown(300, function () {
                    var thisPrev = $(this).prev('a');

                    manageHref(thisPrev, getHref, minus);

                });

            }

        }

//This function is responsible for complementing slideUp animation 
        function decorationUp($this, minus) {
            $this.prev('a').removeAttr('class').children(minus).not('.menu-item-description').hide(200);
        }

//Simple function checks if we are on Big Screen (based on CSS "float" property)
        function isBigScr() {
            return $('.nav li').css('float') == 'left';
        }

//This function is responsible for making first level menu item's same height if description is present (on Big Screen) 
        function equalizeHeight_If_Description() {

            if (!isBigScr()) {
                $('.nav ul li a').removeAttr('style');
            } else {
                var menuItemDescription = $('ul li a .menu-item-description:not("ul ul li a .menu-item-description")');
                if (menuItemDescription.length) {

                    var makeEqualHeight = menuItemDescription.parent().height();

                    $('.nav ul li a:not("ul ul li a")').not(menuItemDescription.parent('a')).css({
                        'height': makeEqualHeight + 'px',
                        'line-height': makeEqualHeight + 'px'
                    });
                    menuItemDescription.parent('a').css({'height': makeEqualHeight + 'px'});
                }
            }
        }


//Function is responsible for complementing slideDown animation (showing/hiding minus sign, adding/removing href's and adding/removing text-decorations)
        function manageHref(thisPrev, getHref, minus) {

            if (undefined === thisPrev.attr('href') || false === thisPrev.attr('href')) {//If attr is NOT here treat it as a link (allow X Button to animate ,do NOT underline)


                thisPrev.children(minus).show(290, function () {
                    thisPrev.attr('href', getHref);
                    if ('#' == getHref || undefined === getHref || false === getHref) {

                        thisPrev.removeAttr('class');
                    } else {

                        thisPrev.addClass('underline');
                    }

                });
            }
        }

//This function is responsible for animating width and height of our menu (On anchor hover... on device with a mouse)
        var animateMenuWidth = function () {
            var activeClass = $('.active');
            if (!isBigScr()) {
                return false;
            }

            if (activeClass.next('ul.sub-menu').length) {//Check if next submenu exist. If it does exist do:
                var nextSubmenu = activeClass.next('ul.sub-menu');

                nextSubmenu
                    .css({//Add the following Css properties so we can Read it's values in order to make an animation
                        'visibility': 'hidden',
                        'display': 'block'
                    });
                var getWidth = nextSubmenu.outerWidth(true),//Get the width of menu
                    getHeightFirstChild = nextSubmenu.children('li:first').outerHeight(true),//Get the height of first child of our menu
                    getSubmenuHeight = nextSubmenu.outerHeight(true);//Get the height of of menu


                nextSubmenu
                    .removeClass('sub-menu')
                    .addClass('jsub-menu').css({
                        'visibility': '',
                        'height': getHeightFirstChild + 'px',
                        'width': '0',
                        'z-index': '99999'
                    });

                nextSubmenu.filter(':not(:animated)').animate({width: getWidth}, 500, function () {
                    //animate width of menu,callback animate height
                    if (nextSubmenu.children('li').length > 1) {
                        nextSubmenu.animate({height: getSubmenuHeight}, 500);
                    }

                });

            }

        };

//Dummy function for hoverIntent plugin
        function nullFunc() {
            return;
        }

//This function is responsible for animating slideDown of our menu on Desktop Layout
        var animateMenuDropdown = function () {
            var $this = $(this);
            if (!isBigScr()) {
                return false;
            }

            if ($this.children('ul:first').hasClass('jsub-menu')) {//Let's check if "jsub-menu" Class is here
                return false;//If it is ("jsub-menu" here) don't SlideDown...
            } else {//Else slide down if no class

                $this.find('ul.sub-menu:first').not(':visible').slideDown(500);

            }

        };

//This function is responsible for animating slideUp of our menu on Big Screen Layout
        var animateUp = function () {

            if (!isBigScr()) {
                return false;
            }

            var $this = $(this);

            $this.find('ul:first')
                .slideUp(500, function () { //Slide Up our open menu/es,execute callback function
                    var $this = $(this);

                    $this.removeClass('jsub-menu').addClass('sub-menu').removeAttr('style');//Remove our added Jquery classes and add default Wordpress class "sub-menu"

                });

        };

//This function is responsible for animating slideUp/slideDown of our FIRST menu on Medium Screen Layout
        function slideDownMedScrFirst($this, minus, getHref) {

            if (!isBigScr()) {
                return false;
            }

            if ($this.next('.sub-menu').length) {
                $this.removeAttr('href');//Prevent link default behaviour (on first touch don't go to other page )
                $this.next('.sub-menu').slideDown(300, function () {
                    var thisPrev = $(this).prev('a');
                    manageHref(thisPrev, getHref, minus);

                });
            }
            if ($('.nav ul.sub-menu:visible').length > 1) {

                $('.sub-menu:not(:animated)').slideUp(300, function () {
                    var $this = $(this),
                        minus = $('.minus');
                    decorationUp($this, minus);
                });
            }

        }

//This function is responsible for animating slideDown of our SECOND menu (sub-menu) on Medium Screen Layout
        function slideDownMedScrSecond($this, minus, getHref) {

            if (!isBigScr()) {
                return false;
            }

            animateNextSub($this, minus, getHref);

        }

//This function is responsible for animating slideUp/slideDown Menu on Small Screen Layout
        function slideDownSmallScr($this, minus, getHref) {

            if (!isBigScr()) {

                animateNextSub($this, minus, getHref);
            }

        }

        //This is MAIN Function it is responsible for animating slideDown/slideUp of our menu on Medium/Small Screens (Tablets/Phones)
        //Uses functions defined above: decorationUp(),slideDownMedScrFirst(),slideDownMedScrSecond(),slideDownSmallScr()
        function animateMobileMenu() {

            $('.nav ul a:not(.nav ul ul a)').on('touchstart touchmove', function () {// Medium/Big Screen Layout checks if first "ul li a:first" is touched...
                var $this = $(this),
                    minus = $('.minus'),
                    getHref = $this.attr('href');

                slideDownMedScrFirst($this, minus, getHref);
            });

            $('.nav ul ul a').on('touchstart touchmove', function () {
                var $this = $(this),
                    minus = $('.minus'),
                    getHref = $this.attr('href');

                slideDownMedScrSecond($this, minus, getHref);

            });

            $('.nav a .minus').on('touchstart touchmove', function (e) {

                e.preventDefault();
                e.stopPropagation();

                var parentsUntil = $(this).parentsUntil('ul').find('ul'),
                    getFirstAnchor = $('ul.jnav a:not(ul.sub-menu a)');

                if (isBigScr() && !$(this).parent().is(getFirstAnchor)) {// Medium/Big Screen Layout checks if "ul ul li a" is touched...

                    parentsUntil.slideUp(300, function () {
                        var $this = $(this),
                            minus = $('.minus');
                        decorationUp($this, minus);

                    });

                } else if (isBigScr() && $(this).parent().is(getFirstAnchor)) {// Medium/Big Screen Layout checks if "ul li a" is touched...

                    parentsUntil.slideUp(300, function () {
                        var $this = $(this),
                            minus = $('.minus');
                        decorationUp($this, minus);
                    });

                } else if (!isBigScr()) {//Small Screen Layout
                    $(this).parent('a').next('.sub-menu').slideUp(300, function () {
                        var $this = $(this),
                            minus = $('.minus');
                        decorationUp($this, minus);

                    });

                }
            });

            $('.nav a').on('touchstart', function () {

                oldTouchPos = $(window).scrollTop();

            }).on('touchend', function () {

                var newTouchPos = $(window).scrollTop(),

                    $this = $(this),
                    minus = $('.minus'),
                    getHref = $this.attr('href');

                if (( Math.abs(oldTouchPos - newTouchPos) ) < 3 && !$this.children('.minus').is(':visible')) {

                    slideDownSmallScr($this, minus, getHref);
                }

            });


            $('.menu-toggle').click(function () {

                var navelem = $('.nav');
                if (navelem.is(':animated') || $('.search-text').is(':visible')) {
                    return;
                } else {
                    navelem.slideToggle(300);
                }

            });


        }

        $('.nav ul:first ,ul.nav').removeClass('nav').addClass('jnav');//Add jquery Class to our menu (If Menu Is Created via Wordpress Backend)
        $('.nav ul.children').removeClass('children').addClass('sub-menu');//Add jquery Class to our menu (Default menu if no menu is created)

// Execute menu hover states and functions(animate functions,width and height properties in order to make our animations on Desktop Machines)
// Uses HoverIntent plugin
        var config = {
            sensitivity: 6, // number = sensitivity threshold (must be 1 or higher)
            interval: 100,  // number = milliseconds for onMouseOver polling interval
            over: animateMenuWidth, // function = onMouseOver callback (REQUIRED)
            timeout: 500,// number = milliseconds delay before onMouseOut
            out: nullFunc// function = onMouseOut callback (EMPTY in order to avoid js errors)
        };
        var config2 = {
            sensitivity: 6, // number = sensitivity threshold (must be 1 or higher)
            interval: 100,  // number = milliseconds for onMouseOver polling interval
            over: animateMenuDropdown, // function = onMouseOver callback (REQUIRED)
            timeout: 500, // number = milliseconds delay before onMouseOut
            out: animateUp // function = onMouseOut callback
        };

        if ("ontouchstart" in document) {
            animateMobileMenu();

        } else {//On desktop hover
            var subMenuAnchor = $('ul.jnav ul.sub-menu a');
            subMenuAnchor.hover(function () {
                if (!isBigScr()) {
                    return false;
                }
                $(this).addClass('active');

            }, function () {
				var $this = $(this);
				if ( $this.hasClass('underline') ){
					return false;
				}

                $this.removeClass('active').removeAttr('class');
            });
            subMenuAnchor.hoverIntent(config);

            $('ul.jnav li').hoverIntent(config2);

            //If user is viewing page with resised browser show the Mobile Menu and handle the click's
            $('.menu-toggle').on('click', function () {
                var menuContainer = $('.nav');
                if (menuContainer.is(':animated')) {

                    return false;
                }

                menuContainer.slideToggle(500);

            });

            $('.nav a').click(function () {
                var $this = $(this),
                    minus = $('.minus'),
                    getHref = $this.attr('href');

                slideDownSmallScr($this, minus, getHref);

            });

            $('.nav a .minus').click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                $(this).parent('a').next('.sub-menu').slideUp(300, function () {
                    var $this = $(this),
                        minus = $('.minus');
                    decorationUp($this, minus);

                });

            });

        }


        equalizeHeight_If_Description();

        $(window).on("resize", function () {


            clearTimeout(resizeId);// Prevent functions from executing every time on resize (fires after resize is finished)

            resizeId = setTimeout(function () {
                var newWindowWidth = $(window).width();
                if (newWindowWidth !== cachedWindowWidth) { //Prevent from running on window scroll (Android/IOS)
                    // Update the window width for next time
                    cachedWindowWidth = $(window).width();

                    if (isBigScr()) { //If Big screen remove all
                        $('.jnav .sub-menu').slideUp(500);
                        $('.nav ul a').removeAttr('class');
                        $('.searchbox').show();
                        $('.minus').css({'display': 'none'});
                        $('.nav').removeAttr('style');
                    }

                }

                equalizeHeight_If_Description();
            }, 10);


        });
    })();
});