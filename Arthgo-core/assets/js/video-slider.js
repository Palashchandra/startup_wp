;(function($){
    $(window).on('elementor/frontend/init',function(){
        elementorFrontend.hooks.addAction('frontend/element_ready/Arthgo-popup-slider_-box.default',function(scope,$){
            $(scope).find(".popup_wrapper_box").each(function () {
                var swiper = new Swiper(".popup_wrapper_box", {
                    loop: true,
                    spaceBetween: 30,
                    autoplay: false,
                    navigation: {
                        nextEl: '.popup_next',
                        prevEl: '.popup_prev',
                    },
                    pagination: {
                        el: ".cre_popup_pag",
                        clickable: true
                    },
                    breakpoints: {
                        320: {
                        slidesPerView: 1
                        },
                        576: {
                        slidesPerView: 2
                        },
                        768: {
                        slidesPerView: 3,
                        },
                        1200: {
                        slidesPerView: 3,
                        }
                    }
                });
            });
        });
    });
})(jQuery);