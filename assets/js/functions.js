(function ($) {
    "use strict";


   
    // $(function(){
    //     var scene = document.getElementById('bannerImages');
    //     var parallaxInstance = new Parallax(scene, {
    //       relativeInput: true
         
    //     });
    // });

     // fixed menu
     $(window).on("scroll",function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            $(".header").addClass("fixed-menu slideInDown animated");
        } else {
            $(".header").removeClass("fixed-menu slideInDown animated");
        }
    });
        
    // fixed bottom to top
    $(window).on("scroll",function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 500) {
            $(".to-top").addClass("fixed-totop");
        } else {
            $(".to-top").removeClass("fixed-totop");
        }
    });


     /* ===================================
                Mouse parallax
            ====================================== */

            if($(window).width() > 780) {
                $('.banner').mousemove(function (e) {
                    $('[data-depth]').each(function () {
                        var depth = $(this).data('depth');
                        var amountMovedX = (e.pageX * -depth / 4);
                        var amountMovedY = (e.pageY * -depth / 4);

                        $(this).css({
                            'transform': 'translate3d(' + amountMovedX + 'px,' + amountMovedY + 'px, 0)',
                            'transition': '0.5s ease',
                        });
                    });
                });
            }


    
    
})(jQuery);	


