/**
 * @global ShaplaPortfolio
 */
(function ($) {
    "use strict";

    var ShaplaPortfolio = window.ShaplaPortfolio || {};

    // will first fade out the loading animation
    $(".status").fadeOut();
    // will fade out the whole DIV that covers the website.
    $(".preloader").delay(1000).fadeOut("slow");

    // Headroom
    if (!!ShaplaPortfolio.is_sticky_header) {
        var masthead = $("#masthead"),
            content = masthead.next(),
            mastheadHeight = masthead.outerHeight();

        content.css('margin-top', mastheadHeight + 'px');
        masthead.headroom();
    }

    // Add bootstrap class
    $("table").addClass("table table-bordered");
    $("input, textarea, select").addClass("form-control");
    $("input[type='submit']").addClass("btn btn-default").removeClass("form-control");
    $("img").addClass("img-responsive");

    // Search toggle.
    $('.search-toggle').on('click', function (event) {
        var that = $(this),
            wrapper = $('.search-box-wrapper');

        that.toggleClass('active');
        wrapper.toggleClass('hide');

        if (that.is('.active') || $('.search-toggle a')[0] === event.target) {
            wrapper.find('.search-field').focus();
        }
    });

    if ($().responsiveSlides) {
        $("#portfolio-slider").responsiveSlides({
            auto: true,
            timeout: 4000,
            nav: false,
            speed: 500,
            maxwidth: 1170,
            pager: false,
            namespace: "portfolio-slides"
        });
    }

    if ($.scrollUp) {
        $.scrollUp({
            animation: 'slide',
            scrollImg: true
        });
    }

})(jQuery);
