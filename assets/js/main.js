/**
 * @global ShaplaPortfolio
 */
(function ($) {
    "use strict";

    var ShaplaPortfolio = window.ShaplaPortfolio || {};

    // Headroom
    if (!!ShaplaPortfolio.is_sticky_header) {
        var masthead = $("#masthead"),
            content = masthead.next(),
            mastheadHeight = masthead.outerHeight();

        content.css('margin-top', mastheadHeight + 'px');
        masthead.headroom();
    }

    // Hero Section
    $(document).find('.hero-content-wrapper').each(function () {
        var _this = $(this),
            options = _this.data('options');
        _this.css('background-image', 'url(' + options.img_url + ')');
        _this.find('.hero-content-inner').css({
            'background-color': options.bg_color,
            'color': options.text_color
        });
        _this.find('a').css('color', options.link_color);
        _this.find('h1, h2, h3, h4, h5, h6').css('color', options.text_color);
    });

    // Add bootstrap class
    $("table").addClass("table table-bordered");
    $("input, textarea, select").addClass("form-control");
    $("input[type='submit']").addClass("btn btn-default").removeClass("form-control");
    $("img").addClass("img-responsive");

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
