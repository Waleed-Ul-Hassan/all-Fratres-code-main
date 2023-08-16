
$(document).ready(function(){

    $('.jobseeker-client-logo-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        autoplay: true,
        autoplaySpeed: 1500,
        infinite: true,
        pauseOnHover: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
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

    });
    $('.left').click(function(){
        $('.jobseeker-client-logo-slider').slick('slickPrev');
    })

    $('.right').click(function(){
        $('.jobseeker-client-logo-slider').slick('slickNext');
    })

});
