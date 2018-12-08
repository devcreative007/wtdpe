/**
 * Functionality specific to Override theme.
 *
 * Provides helper functions to enhance the theme experience.
 * handles expanding of the menu search field, prevents FOUC,
 * includes Fitvids for responsive videos,
 * includes Fittext for responsive header text.
 *
 */

/** Solution provided by http://www.learningjquery.com/2008/10/1-way-to-avoid-the-flash-of-unstyled-content */
jQuery('html').addClass('jsflash');

jQuery(document).ready(function ($) {
    'use strict';


    (function () {

        var siteTitle = 'site-title',
            navSearchForm = 'navsearchform';

        /**This function is responsible for animating search field.*/
        function expandSearch() {
            var searchInput = $('.search-text'),
                searchWidth = searchInput.outerWidth();// Get the width of search text field.
            $('.searchbox input[type="submit"]').on('click', function (e) {
                // Stops parent element from knowing about a given event on its child.
                e.stopPropagation();

                if (0 === searchInput.val()) {
                    searchInput.show()
                        .animate({
                            width: searchWidth
                        }, 500, function () {
                            searchInput.addClass('expanded').focus();
                        });
                    return false;
                } else if (0 !== searchInput.val() && !searchInput.hasClass('expanded')) {// If user enters value and goes to other page and back allow the field to be expanded.
                    searchInput.show()
                        .animate({
                            width: searchWidth
                        }, 500, function () {
                            searchInput.addClass('expanded').focus();
                        });
                    return false;
                }


            });

        }


        $('html').removeAttr('style').removeAttr('class');

// Removes 'video-container' from Twitter Embeds 
        $('.video-container > .twitter-tweet').unwrap();

        $('#' + navSearchForm + ' ' + '.search').removeClass('search').addClass('search-text');
        $('.searchbox input[type="submit"]').css({'display': 'block'});
        expandSearch();

        $('#' + navSearchForm + ' ' + '.search-text').css({'width': '0'}).hide();//Hide search text field.
        $('.search-text').on('click', function (e) {
            // stops parent element from knowing about a given event on its child.

            e.stopPropagation();


        });


        $(document).on('click', function () {

            var search = $('.search-text');
            if (search.is(':visible:not(:animated,:focus)')) {
                search.animate({
                    width: '0'
                }, 500, function () {
                    $(this).css({'width': '0'}).removeClass('expanded').hide();
                });

            }


        });


        $('.entry-content').fitVids();// Make videos responsive using fitVids.
        $('.header-text-wrapper >' + ' ' + '#' + siteTitle).fitText(1.1);// Make Header text responsive using fitText.
        $('#' + siteTitle + '+' + ' ' + '.site-description').fitText(3);


    })();

});
