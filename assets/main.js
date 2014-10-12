(function () {

    var slick_nav_options = {
        asNavFor: '.slick-gallery-main',
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        centerMode: true,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    };
    $('.slick-gallery-nav').slick(slick_nav_options);

    var slick_main_options = {
        asNavFor: '.slick-gallery-nav',
        adaptiveHeight: true
    };
    $('.slick-gallery-main').slick(slick_main_options);

})();