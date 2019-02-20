/**
 * JS for Bloggers Lite theme
 */

(function ($) {
    "use strict";
    function sticky_header() {
        if ($('body').hasClass('sticky-header')) {
            var start_y = $('.top-header').innerHeight() + 60;
            var window_y = $(window).scrollTop();

            if (window_y > 10) {
                if (!($('#masthead').hasClass('is-sticky'))) {
                    $('#masthead .top-header').slideUp(100);
                    $('#masthead')
                            .addClass('is-sticky');
                }
            } else {
                if ($('#masthead').hasClass('is-sticky')) {
                    $('#masthead .top-header').slideDown(100);
                    $('#masthead').removeClass('is-sticky');
                }
            }
        }
    }
    $(document).ready(function () {
        if ( !$( ".custom-header-media" ).length ) {
            var menu_height = $('.main-header').height();
            if($(window).width() <= 991) {
                menu_height = $('.mean-bar').height();
            }
            $('#main').css({
                'padding-top':menu_height
            });
        }
        $(".icon").click(function () {
            $(".mobilenav").fadeToggle(500);
            $(".top-menu").toggleClass("top-animate");
            $(".mid-menu").toggleClass("mid-animate");
            $(".bottom-menu").toggleClass("bottom-animate");
            $('body').toggleClass('menu-hide-show');
        });
        //$('.site-header.stricky').meanmenu();
        //$('.home .site-header .menu-block').meanmenu();
        //$('.site-header').meanmenu();

        $('.site-header.stricky-menu-left').meanmenu();
        $('.site-header.stricky-menu-right').meanmenu();
        $('.home .site-header .menu-block.stricky-menu-left').meanmenu();
        $('.home .site-header .menu-block.stricky-menu-right').meanmenu();


        $(".arrow-up").click(function () {
            $("html, body").animate({scrollTop: 0}, 1000);
        });

        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll > 100) {
                $(".arrow-up").fadeIn();
            } else {
                $(".arrow-up").fadeOut();
            }
        });

        $('#site-navigation ul ul').each(function () {
            if ($(this).children().length) {
                $(this, 'li:first').before('<a class="menu-expand" href="#"><i class="fa-caret-down"></i></a>');
            }
        });
        $('a.menu-expand').click(function (e) {
            e.preventDefault();
            if ($(this).find("i").hasClass("fa-caret-down")) {
                $(this).find("i").removeClass("fa-caret-down");
                $(this).find("i").addClass("fa-caret-up");
            } else {
                $(this).find("i").removeClass("fa-caret-up");
                $(this).find("i").addClass("fa-caret-down");
            }
            $(this).siblings('ul').slideToggle(".sub-menu");
        });

        $('.slick_slider ul.slides').slick({
            dots: false,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplaySpeed: 3000,
            autoplay: true,
            prevArrow: '<div class="slick-prev"><i class="fa fa-chevron-left"></i></div>',
            nextArrow: '<div class="slick-next"><i class="fa fa-chevron-right"></i></div>'
        });

        $('.menu-scroll-down').click(function (e) {
            var $scrollTop = $("#primary").offset().top - 50;
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $scrollTop
            }, 600);
        });
        
        var stickey_layoutmenu = attached_vars.stickey_layoutmenu;
        if(stickey_layoutmenu == 'yes') {
            $(window).scroll(function () {
                if ($(window).width() > 1023) {
                    var y = $(this).scrollTop();
                    var top_height = $('.top-back').height();
                    if (y > top_height) {
                        $('.stricky').addClass('active-sticky');
                        $('.stricky').removeClass('normal');
                    } else {
                        $('.stricky').removeClass('active-sticky');
                        $('.stricky').addClass('normal');
                    }
                }
            });
        }
    });
    $('.our_client_div').slick({
        slidesToShow: 5,
        dots: true,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1100,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 1023,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 360,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //Issue for last menu with submenu
    $("ul.nav-menu li.menu-item-has-children").on('mouseenter mouseleave', function (e) {
        var elm = $(this).children('ul');
        var off = elm.offset();
        var l = off.left;
        var container_left = $('.container').offset().left;
        var container_width = $('.container').width();
        var w = elm.width();
        var isEntirelyVisible = (l + w <= container_width + container_left);
        if (!isEntirelyVisible) {
            $(this).addClass('edge');
        } else {
            $(this).removeClass('edge');
        }
    });   

    /*-------Scrolling Effects-------*/
    var $elems = $('.animateblock');
    var winheight = $(window).height();
    $elems.each(function () {
        var $elm = $(this);
        var topcoords = $elm.offset().top;
        if (topcoords < winheight) {
            // animate when top of the window is 3/4 above the element
            $elm.addClass('animated');
        }
    });
    $('.progress_inner').each(function () {
        if ($(this).offset().top < winheight)
        {
            var width = $(this).attr('data-width');
            $(this).animate({
                width: width
            }, 1000);
        }
    });
    $('.pie_progress').each(function () {
        if ($(this).offset().top < winheight)
        {
            $(this).asPieProgress('start');
        }
    });
    
    $(window).scroll(function () {
        animate_elems();
    });

    function animate_elems() {
        var wintop;
        wintop = $(window).scrollTop(); // calculate distance from top of window

        // loop through each item to check when it animates
        $elems.each(function () {
            var $elm = $(this);
            if ($elm.hasClass('animated')) {
                return true;
            } // if already animated skip to the next item
            var topcoords = $elm.offset().top; // element's distance from top of page in pixels
            if (wintop > (topcoords - (winheight * 0.9))) {
                // animate when top of the window is 3/4 above the element
                $elm.addClass('animated');
            }
        });
        $('.progress_inner').each(function () {
            if (wintop > $(this).offset().top - winheight)
            {
                var width = $(this).attr('data-width');
                $(this).animate({
                    width: width
                }, 500);
            }
        });
    }
    
    $(window).load(function () {
        if(attached_vars.enable_loader == 'yes') {
            $(".loader").fadeOut("slow");
        }
    });
    
})(jQuery);
