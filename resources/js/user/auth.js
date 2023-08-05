import $ from 'jquery';

import '@popperjs/core';
import 'bootstrap/dist/js/bootstrap.js';
function preloader() {
    $('#preloader').delay(0).fadeOut();
}

$(window).on('load', function () {
    preloader();
});
var fullHeight = function() {
    $('.js-fullheight').css('height', $(window).height());
    $(window).resize(function(){
        $('.js-fullheight').css('height', $(window).height());
    });

};

fullHeight();
$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
