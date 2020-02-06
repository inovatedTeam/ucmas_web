/* drop down menu */
function myFunction_lang() {
    document.getElementById("dropdown_lang").classList.toggle("show");
}
function myFunction_country() {
    var openDropdown = document.getElementById("#dropdown_country");
    if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
    }else{
        openDropdown.classList.add("show");
    }
}
(function($) {

    'use strict';
    $("#btn_country").click(function () {
        document.getElementById("dropdown_country").classList.toggle("show");
        // myFunction_country();
    });
    $("#btn_lang").click(function () {
        document.getElementById("dropdown_lang").classList.toggle("show");
        // myFunction_lang();
    });
    $("#btn_country2").click(function () {
        document.getElementById("dropdown_country2").classList.toggle("show");
        // myFunction_country();
    });
    $("#btn_lang2").click(function () {
        document.getElementById("dropdown_lang2").classList.toggle("show");
        // myFunction_lang();
    });
    /*-----------------------------------------------------------------------------------*/
    /*  Initialize
    /*-----------------------------------------------------------------------------------*/
    /*changed by dong*/
    new WOW().init();

    /*-----------------------------------------------------------------------------------*/
    /*  Sticky Header
    /*-----------------------------------------------------------------------------------*/
    $(window).scrollTop();
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.site-header').addClass("fixedwrap");
            } else {
                $('.site-header').removeClass("fixedwrap");
            }
    });

    /*-----------------------------------------------------------------------------------*/
    /*  Menu Dropdown
    /*-----------------------------------------------------------------------------------*/

    $('ul.menus li ul li').hover(function() {
        $(this).parents('li.has-child').toggleClass('open');
    });

    /*-----------------------------------------------------------------------------------*/
    /*  Search Bar
    /*-----------------------------------------------------------------------------------*/

    // new UISearch( document.getElementById( 'sb-search' ) );

    /*-----------------------------------------------------------------------------------*/
    /*  Number Counter
    /*-----------------------------------------------------------------------------------*/

    /*changed by dong*/
    $('.counter').counterUp({
        delay: 10,
        time: 2000
    });

    /*-----------------------------------------------------------------------------------*/
    /*  GALLERY
    /*-----------------------------------------------------------------------------------*/

    // $('.gallery').magnificPopup({
    //     delegate: 'a',
    //     type: 'image',
    //     tLoading: 'Loading image #%curr%...',
    //     mainClass: 'mfp-img-mobile',
    //     gallery: {
    //       enabled: true,
    //       navigateByImgClick: true,
    //       preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    //     },
    //     image: {
    //       tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
    //
    //     }
    //   });

    /*-----------------------------------------------------------------------------------*/
    /*  CAROUSEL
    /*-----------------------------------------------------------------------------------*/

    /*$('.owl-carousel').owlCarousel({
        margin:10,
        dots:true,
        items:4,
        lazyLoad: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    })*/

    /*-----------------------------------------------------------------------------------*/
    /*  FLEXSLIDER
    /*-----------------------------------------------------------------------------------*/

    $(".testimonial-wrap .flexslider").flexslider({
        animation: "slide",
        controlNav: true,
        prevText: "",
        nextText: "",
        directionNav: false,
        smoothHeight: false,
        slideshowSpeed: 5000
    });

    $(".flexslider-wrap.fullscreen .flexslider").flexslider({
        animation: "slide",
        controlNav: true,
        prevText: "",
        nextText: "",
        directionNav: false,
        smoothHeight: false,
        slideshowSpeed: 5000
    });

    $('.class-flexslider').flexslider({
        animation: "fade",
        controlNav: "thumbnails"
    });

    var windowHeight;
    var windowWidth;

    windowHeight = $(window).height();
    windowWidth = $(window).width();

    $(".flexslider-wrap .slides img").each(function() {
        var h = $(this).height();
        var w = $(this).width();
        var ratA = w / h;
        var ratI = windowWidth / windowHeight;
        if (ratA > ratI) {
            var r = w / h;
            $(this).css('height', windowHeight);
            $(this).css('width', windowHeight * r);
            var m = ((windowHeight * r) - windowWidth) / 2;
            $(this).css('margin-left', -m);
            $(this).attr("rat", 1);
            $(this).attr("mar", m);
        } else {
            var r = h / w;
            $(this).css('width', windowWidth);
            $(this).css('height', windowWidth * r);
            var m = ((windowWidth * r) - windowHeight) / 2;
            $(this).css('margin-top', -m);
            $(this).attr("rat", 0);
            $(this).attr("mar", m);
        }
    });

    var windowHeight;
    var windowWidth;

    windowHeight = $(window).height();
    windowWidth = $(window).width();

    $(".fullscreen").css('height', windowHeight*0.75);

    $('.flexslider-wrap .slides li').css('height', window.innerHeight*0.75);

    /*-----------------------------------------------------------------------------------*/
    /*  SKILL BAR
    /*-----------------------------------------------------------------------------------*/

    $('.skills-bar').each(function() {
        $(this).find('.bar').animate({
            width: $(this).attr('data-percent')
        }, 4000);
    });

    /*-----------------------------------------------------------------------------------*/
    /*  MENU MOBILE
    /*-----------------------------------------------------------------------------------*/

    var slideRight = new Menu({
        wrapper: '.site-main',
        type: 'slide-right',
        menuOpenerClass: '.slide-button',
        maskId: '#slide-overlay'
    });

    var slideRightBtn = document.querySelector('#slide-buttons');
  
    slideRightBtn.addEventListener('click', function(e) {
        e.preventDefault;
        slideRight.open();
    });

    var coba = $('.teacher-desc.active').attr('id');
    $("a[aria-controls=" + coba + "]").find('img').css('opacity', '1');

    $(document).on('click', '.teacher-photo-box', function() {
        $(this).find('img').css('opacity', 1);
        $(this).parent().siblings('.owl-item').find('img').css('opacity', '0.3');
    });

    

    $('.teacher-desc').each(function() {

        var coba = $('.teacher-desc.active').attr('id');
         $("a[aria-controls=" + coba + "]").find('img').css('opacity', '1');

    });

    $(document).on('click', '.teacher-person', function() {
        $(this).find('img').css('opacity', 1);
        $(this).parent().siblings('.owl-item').find('img').css('opacity', '0.3');
    });

    /*-----------------------------------------------------------------------------------*/
    /*  EQUAL HEIGHT
    /*-----------------------------------------------------------------------------------*/

    function kindergartenEqualHeight() {
        if( windowWidth > 789 ) {
        var classDetails = $('.class-details');
        var classDetailsHeight = $('.class-item img').height();

            classDetails.css('height', classDetailsHeight );

        }
    }

    window.onload = function() {
      kindergartenEqualHeight();
    };

    window.onresize = function() {
      kindergartenEqualHeight();
    };

    window.onclick = function(event) {
        if (event.target.matches('.non-click')){
            console.log(432);
        }
        else if (!event.target.matches('.dropbtn')) {
            console.log(111);
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

})(jQuery);
$(document).ready(function(){
    $("#btn_lang").click(function () {
        console.log(234);
        $("#dropdown_lang").addClass("show");
    });
// Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {

        if (event.target.matches('.non-click')){
            console.log(432);
        }
        else if (!event.target.matches('.dropbtn')) {
            console.log(111);
            var dropdowns = $(this).siblings("dropdown-content");
            $(".dropdown .dropdown-content").each(function () {
                $(this).removeClass("show");
            });
            dropdowns.addClass("show");

        }
    }
});
function change_lang(base_url, lang){

    var pathname = window.location.pathname; // Returns path only
    var hostname = window.location.hostname; // Returns path only
    var url      = window.location.href;     // Returns full URL
    var path = url.split('?');
    var substring = 'lang';
    var new_url = "";

    console.log(base_url);
    console.log(window.location.hostname);
    console.log(pathname);
    console.log(url);

    if(url.indexOf(substring) !== -1){
        new_url = "http://" + hostname + pathname + "?lang=" + lang ;
        // new_url = path[0] + "?lang=" + lang ;
    }else{
        new_url = "http://" + hostname + pathname + "?lang=" + lang ;
        // new_url = url + "?lang=" + lang ;
    }

    // var new_url = base_url + lang + "/" + path[1];
    document.location.href = new_url;
}
$(document).ready(function () {

});