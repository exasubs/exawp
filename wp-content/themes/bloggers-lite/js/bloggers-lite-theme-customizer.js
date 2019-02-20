/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */

(function ($) {
    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.site-title a').text(to);
        });
    });
    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.site-description').text(to);
        });
    });
    wp.customize('facebook', function (value) {
        value.bind(function (to) {
            $('.facebook').attr("href", to);
        });
    });
    wp.customize('twitter', function (value) {
        value.bind(function (to) {
            $('.twitter').attr("href", to);
        });
    });
    wp.customize('email', function (value) {
        value.bind(function (to) {
            $('.mail').attr("href", to);
        });
    });
    wp.customize('pinterest', function (value) {
        value.bind(function (to) {
            $('.pinterest').attr("href", to);
        });
    });
    wp.customize('googleplus', function (value) {
        value.bind(function (to) {
            $('.google-plus').attr("href", to);
        });
    });
    wp.customize('rssfeed', function (value) {
        value.bind(function (to) {
            $('.rss').attr("href", to);
        });
    });
    wp.customize('instagram', function (value) {
        value.bind(function (to) {
            $('.instagram').attr("href", to);
        });
    });
    wp.customize('linkedin', function (value) {
        value.bind(function (to) {
            $('.linkedin').attr("href", to);
        });
    });
    wp.customize('youtube', function (value) {
        value.bind(function (to) {
            $('.youtube').attr("href", to);
        });
    });
    wp.customize('flicker', function (value) {
        value.bind(function (to) {
            $('.flickr').attr("href", to);
        });
    });

    // Header text color
    wp.customize('header_textcolor', function (value) {
        value.bind(function (to) {
            if ('blank' === to) {
                $('.site-title, .site-title a, .site-description,.main-navigation li a').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title, .site-title a, .site-description,.main-navigation li a').css({
                    'clip': 'auto',
                    'color': to,
                    'position': 'relative'
                });
            }
        });
    });

    // Hook into Theme color/image change and adjust body class value as needed.
    wp.customize('theme_color', function (value) {
        value.bind(function (to) {
            var body = $('.top-header,.single_block a:hover');

            if (('#ffffff' == to || '#fff' == to) && 'none' == body.css('background-image'))
                body.addClass('custom-background-white');
            else if ('' == to && 'none' == body.css('background-image'))
                body.addClass('custom-background-empty');
            else
                body.removeClass('custom-background-empty custom-background-white');
        });
    });
    // Hook into background color/image change and adjust body class value as needed.
    wp.customize('background_color', function (value) {
        value.bind(function (to) {
            var body = $('body');

            if (('#ffffff' == to || '#fff' == to) && 'none' == body.css('background-image'))
                body.addClass('custom-background-white');
            else if ('' == to && 'none' == body.css('background-image'))
                body.addClass('custom-background-empty');
            else
                body.removeClass('custom-background-empty custom-background-white');
        });
    });
    wp.customize('background_image', function (value) {
        value.bind(function (to) {
            var body = $('body');

            if ('' != to)
                body.removeClass('custom-background-empty custom-background-white');
            else if ('rgb(255, 255, 255)' == body.css('background-color'))
                body.addClass('custom-background-white');
            else if ('rgb(230, 230, 230)' == body.css('background-color') && '' == _wpCustomizeSettings.values.background_color)
                body.addClass('custom-background-empty');
        });
    });

    // Whether a header image is available.
    function hasHeaderImage() {
        var image = wp.customize('header_image')();
        return '' !== image && 'remove-header' !== image;
    }

    // Whether a header video is available.
    function hasHeaderVideo() {
        var externalVideo = wp.customize('external_header_video')(),
                video = wp.customize('header_video')();

        return '' !== externalVideo || (0 !== video && '' !== video);
    }

    // Toggle a body class if a custom header exists.
    $.each(['external_header_video', 'header_image', 'header_video'], function (index, settingId) {
        wp.customize(settingId, function (setting) {
            setting.bind(function () {
                if (hasHeaderImage()) {
                    $(document.body).addClass('has-header-image');
                } else {
                    $(document.body).removeClass('has-header-image');
                }

                if (!hasHeaderVideo()) {
                    $(document.body).removeClass('has-header-video');
                }
            });
        });
    });

})(jQuery);
