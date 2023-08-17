import $ from 'jquery';
window.jQuery = window.$ = $

import '@popperjs/core';
import 'bootstrap/dist/js/bootstrap.js';
import isotope from 'isotope-layout';
import imagesLoaded from 'imagesloaded';
import jQueryBridget from 'jquery-bridget';
import '../lib/jquery.odometer.min.js';
import 'jquery.appear';
import '../lib/slick.js';
import './ajax-form.js';
import AOS from 'aos';
import './plugin.js';

let owl_carousel = require('owl.carousel');
window.fn = owl_carousel;

function setCookie(name, value, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

window.setCookie = setCookie;
window.getCookie = getCookie;

    /*=============================================
        =    		 Preloader			      =
    =============================================*/
    function preloader() {
        $('#preloader').delay(0).fadeOut();
    }

    $(window).on('load', function () {
        preloader();
        mainSlider();
        aosAnimation();
    });


    /*=============================================
        =          Data Background               =
    =============================================*/
    $("[data-background]").each(function () {
        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
    })


    /*=============================================
        =    		Mobile Menu			      =
    =============================================*/
//SubMenu Dropdown Toggle
    if ($('.menu-area li.menu-item-has-children ul').length) {
        $('.menu-area .navigation li.menu-item-has-children').append('<div class="dropdown-btn"><span class="fas fa-angle-down"></span></div>');
    }
//Mobile Nav Hide Show
    if ($('.mobile-menu').length) {

        var mobileMenuContent = $('.menu-area .main-menu').html();
        $('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);

        //Dropdown Button
        $('.mobile-menu li.menu-item-has-children .dropdown-btn').on('click', function () {
            $(this).toggleClass('open');
            $(this).prev('ul').slideToggle(500);
        });
        //Menu Toggle Btn
        $('.mobile-nav-toggler').on('click', function () {
            $('body').addClass('mobile-menu-visible');
        });

        //Menu Toggle Btn
        $('.menu-backdrop, .mobile-menu .close-btn').on('click', function () {
            $('body').removeClass('mobile-menu-visible');
        });
    }


    /*=============================================
        =     Menu sticky & Scroll to top      =
    =============================================*/
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 245) {
            $("#sticky-header").removeClass("sticky-menu");
            $('.scroll-to-target').removeClass('open');

        } else {
            $("#sticky-header").addClass("sticky-menu");
            $('.scroll-to-target').addClass('open');
        }
    });


    /*=============================================
        =    		 Scroll Up  	         =
    =============================================*/
    if ($('.scroll-to-target').length) {
        $(".scroll-to-target").on('click', function () {
            var target = $(this).attr('data-target');
            // animate
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1000);

        });
    }


    /*=============================================
        =             Main Slider                =
    =============================================*/
    function mainSlider() {
        var BasicSlider = $('.slider-active');
        BasicSlider.on('init', function (e, slick) {
            var $firstAnimatingElements = $('.slider-item:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);
        });
        BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('.slider-item[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
            doAnimations($animatingElements);
        });
        BasicSlider.slick({
            autoplay: true,
            autoplaySpeed: 5000,
            dots: false,
            fade: true,
            arrows: false,
            responsive: [
                { breakpoint: 767, settings: { dots: false, arrows: false } }
            ]
        });

        function doAnimations(elements) {
            var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            elements.each(function () {
                var $this = $(this);
                var $animationDelay = $this.data('delay');
                var $animationType = 'animated ' + $this.data('animation');
                $this.css({
                    'animation-delay': $animationDelay,
                    '-webkit-animation-delay': $animationDelay
                });
                $this.addClass($animationType).one(animationEndEvents, function () {
                    $this.removeClass($animationType);
                });
            });
        }
    }


    /*=============================================
        =         Up Coming Movie Active        =
    =============================================*/
        function initOwlCarousel() {
            $('.ucm-active').owlCarousel({
                loop: true,
                margin: 30,
                items: 4,
                autoplay: false,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
                nav: true,
                dots: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                    },
                    575: {
                        items: 2,
                        nav: false,
                    },
                    768: {
                        items: 2,
                        nav: false,
                    },
                    992: {
                        items: 3,
                    },
                    1200: {
                        items: 4
                    },
                }
            });
        }
        let url_owl = $('#ajaxGetCourseNew').data('ajax');

        $.ajax({
            type: "GET",
            url: url_owl,
            data: { type:0 },
            dataType: "json"
        }).done(function (response) {
            $('#owl_free').html(response.data);
        });

        $.ajax({
            type: "GET",
            url: url_owl,
            data: {type : 1},
            dataType: "json"
        }).done(function (response) {
            $('#owl_premium').html(response.data);
            initOwlCarousel();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            initOwlCarousel();
        });

    /*=============================================
        =         Up Coming Movie Active        =
    =============================================*/
    $('.ucm-active-two').owlCarousel({
        loop: true,
        margin: 45,
        items: 5,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplaySpeed: 1000,
        navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1,
                nav: false,
                margin: 30,
            },
            575: {
                items: 2,
                nav: false,
                margin: 30,
            },
            768: {
                items: 2,
                nav: false,
                margin: 30,
            },
            992: {
                items: 3,
                margin: 30,
            },
            1200: {
                items: 5
            },
        }
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $(".ucm-active-two").trigger('refresh.owl.carousel');
    });


    /*=============================================
        =    		Brand Active		      =
    =============================================*/
    $('.brand-active').slick({
        dots: false,
        infinite: true,
        speed: 1000,
        autoplay: true,
        arrows: false,
        slidesToShow: 6,
        slidesToScroll: 2,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: false,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false,
                }
            },
        ]
    });


    /*=============================================
        =         Gallery-active           =
    =============================================*/
    $('.gallery-active').slick({
        centerMode: true,
        centerPadding: '350px',
        slidesToShow: 1,
        prevArrow: '<span class="slick-prev"><i class="fas fa-caret-left"></i> previous</span>',
        nextArrow: '<span class="slick-next">Next <i class="fas fa-caret-right"></i></span>',
        appendArrows: ".slider-nav",
        responsive: [
            {
                breakpoint: 1800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: '220px',
                    infinite: true,
                }
            },
            {
                breakpoint: 1500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: '180px',
                    infinite: true,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: '160px',
                    arrows: false,
                    infinite: true,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '60px',
                    arrows: false,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: '0px',
                    arrows: false,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: '0px',
                    arrows: false,
                }
            },
        ]
    });

    /*=============================================
        =    		Odometer Active  	       =
    =============================================*/
    $('.odometer').appear(function (e) {
        var odo = $(".odometer");
        odo.each(function () {
            var countNumber = $(this).attr("data-count");
            $(this).html(countNumber);
        });
    });


    /*=============================================
        =    		Isotope	Active  	      =
    =============================================*/

jQueryBridget( 'imagesLoaded', imagesLoaded, $ );
jQueryBridget( 'isotope', isotope, $ );

    $.ajax({
        type: "GET",
        url: $('#courses_top_related').data('ajax'),
        dataType: "json",
    }).done(function (response) {
        $('#courses_top_related').html(response.data);
        initImagesLoaded();
    });

    if(window.location.pathname.slice(1) === "course") {
        initImagesLoaded();
    }

    function initImagesLoaded() {
        // init
        $('.tr-movie-active').imagesLoaded(function () {
                    // init Isotope
                    var $grid = $('.tr-movie-active').isotope({
                        itemSelector: '.grid-item',
                        percentPosition: true,
                        masonry: {
                            columnWidth: '.grid-sizer',
                        }
                    });
                    // filter items on button click
                    $('.tr-movie-menu-active').on('click', 'button', function () {
                        var filterValue = $(this).attr('data-filter');
                        $grid.isotope({ filter: filterValue });
                    });

                });
        //for menu active class
        $('.tr-movie-menu-active button').on('click', function (event) {
                    $(this).siblings('.active').removeClass('active');
                    $(this).addClass('active');
                    event.preventDefault();
                });
    }

    /*=============================================
        =    		 Aos Active  	         =
    =============================================*/
    function aosAnimation() {
        AOS.init({
            duration: 1000,
            mirror: true,
            once: true,
            disable: 'mobile',
        });
    }

