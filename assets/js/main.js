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

    // Back to Top Button
    var element,
        button = document.querySelector('#shapla-back-to-top'),
        distance = 500;

    function showOrHideButton() {
        if (document.body.scrollTop > distance || document.documentElement.scrollTop > distance) {
            button.classList.add('is-active');
        } else {
            button.classList.remove('is-active');
        }
    }

    function scrollToTop(element, duration) {

        if (duration <= 0) return;
        var difference = 0 - element.scrollTop;
        var perTick = difference / duration * 10;

        setTimeout(function () {
            element.scrollTop = element.scrollTop + perTick;
            if (element.scrollTop === 0) return;
            scrollToTop(element, duration - 10);
        }, 10);
    }

    document.addEventListener("DOMContentLoaded", function () {
        window.addEventListener("scroll", function () {
            showOrHideButton();
        });
    });

    button.addEventListener("click", function () {
        if (document.body.scrollTop) {
            // For Safari
            element = document.body;
        } else if (document.documentElement.scrollTop) {
            // For Chrome, Firefox, IE and Opera
            element = document.documentElement;
        }

        scrollToTop(element, 300);
    });

})(jQuery);
