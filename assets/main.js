(function () {

    var slick_nav_options = {
        asNavFor: '.slick-gallery-main',
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        centerMode: true,
        focusOnSelect: true
    };
    $('.slick-gallery-nav').slick(slick_nav_options);

    var slick_main_options = {
        asNavFor: '.slick-gallery-nav',
        adaptiveHeight: true
    };
    $('.slick-gallery-main').slick(slick_main_options);

})();