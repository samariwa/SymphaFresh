

(function ($) {
    "use strict";

    // catagory-container swiper slider init
    var catagoryContainer = new Swiper('.catagory-container', {
        slidesPerView: 6,
        loop: true,
        navigation: {
            nextEl: '.catagory-slider-next',
            prevEl: '.catagory-slider-prev',
          },
        spaceBetween: 30,
        breakpoints: {
            990: {
                slidesPerView: 4
            },
            768: {
                slidesPerView: 2
            },
            540: {
                slidesPerView: 2
            },
            400: {
                slidesPerView: 2
            }
        }
    });


    // trending-product-container swiper slider init
    var trendingContainer = new Swiper('.trending-product-container', {
        slidesPerView: 4,
        loop: true,
        navigation: {
            nextEl: '.trending-slider-next',
            prevEl: '.trending-slider-prev',
          },
        spaceBetween: 30,
        breakpoints: {
            1200: {
                slidesPerView: 3
            },
            990: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 2
            },
            540: {
                slidesPerView: 1
            },
            400: {
                slidesPerView: 1
            }
        }
    });

    // trending-product-container swiper slider init
    var recommendContainer = new Swiper('.recommend-product-container', {
        slidesPerView: 4,
        loop: true,
        navigation: {
            nextEl: '.trending-slider-next',
            prevEl: '.trending-slider-prev',
          },
        spaceBetween: 30,
        breakpoints: {
            1200: {
                slidesPerView: 3
            },
            990: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 2
            },
            540: {
                slidesPerView: 1
            },
            400: {
                slidesPerView: 1
            }
        }
    });

    // brand-feature-product-container swiper slider init
    var recommendContainer = new Swiper('.feature-brand-container', {
        slidesPerView: 5,
        loop: true,
        navigation: {
            nextEl: '.brand-feature-slider-next',
            prevEl: '.brand-feature-slider-prev',
          },
        spaceBetween: 30,
        breakpoints: {
            1200: {
                slidesPerView: 4
            },
            990: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 2
            },
            540: {
                slidesPerView: 1
            },
            400: {
                slidesPerView: 1
            }
        }
    });

    // trending-product-container swiper slider init
    var testimonialContainer = new Swiper('.testimonial-container', {
        slidesPerView: 1,
        loop: true,
        navigation: {
            nextEl: '.testimonial-slider-next',
            prevEl: '.testimonial-slider-prev',
          },
        spaceBetween: 30,
    });

    // banner-slider-container swiper slider init
    var banneSliderConainer = new Swiper('.banner-slider-container', {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 0,
        speed: 900,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
          }
    });

    // infoBoxContainer swiper slider init
    var infoBoxContainer = new Swiper('.info-box-container', {
        slidesPerView: 3,
        loop: true,
        centeredSlides: true,
        initialSlide: 2,
        spaceBetween: 30,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
          },
        breakpoints: {
            990: {
                slidesPerView: 2
            },
            767: {
                slidesPerView: 1
            }
        }
    });


    $('.info-hover-effect-parent').on('mouseover', '.info-hover-effect-child', function() {
        $('.info-hover-effect-child.active').removeClass('active');
        $(this).addClass('active');
    });

    $('.product-slick').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
        vertical: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        centerMode: true,
        asNavFor: '.product-slick',
        arrows: true,
        dots: false,
        focusOnSelect: true
    });


    
    $('.add-product img').elevateZoom({
        zoomType: "inner",
        scrollZoom : true
    });

    // $('.cart-btn-toggle').on('click', function(){
    //     $(this).closest('.cart-btn-toggle').find('.cart-btn').hide()
    //     $(this).closest('.cart-btn-toggle').find('.price-btn').show()
    // })
    $('.cart-btn').on('click', function(){
        $(this).parent('.cart-btn-toggle').find('.cart-btn').hide()
        $(this).parent('.cart-btn-toggle').find('.price-btn').show()
    })
    $('.price-increase-decrese-group .quantity-right-plus').on('click', function() {
        var $qty = $(this).closest('.price-increase-decrese-group').find('.input-number');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
        }
    });
    $('.price-increase-decrese-group .quantity-left-minus').on('click', function() {
        var ths = $(this);
        var $qty = $(this).closest('.price-increase-decrese-group').find('.input-number');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal) && currentVal > 0) {
            $qty.val(currentVal - 1);
        }
        if(currentVal === 1){
            console.log(ths);
            // ths.parents('.price-increase-decrese-group').css('background-color','red');
            ths.parents('.price-btn').hide();
            ths.parents('.price-btn').siblings('.cart-btn').show();
        }
    });

    
    var $qty = $(this).closest('.price-increase-decrese-group').find('.input-number');
    var currentVal = $qty.val();
    if(currentVal === 0){
        alert('hi')
        // $(this).closest('.cart-btn-toggle').find('.cart-btn').show()
        $(this).closest('.cart-btn-toggle').find('.price-btn').hide()
    }

    $(".wish-link").on("click",function(e){
        e.preventDefault();
        $(this).toggleClass("focus");
        // $("p").toggleClass("main");
    });

    // $(".all-catagory-option > a").on("click",function(e){
    //     $('.page-layout').toggleClass('open-side-menu')
    //     $('body').toggleClass('open-side-menu')
    // });
    var contentwidth = jQuery(window).width();
    if ((contentwidth) > '1200') {
        $('.home-layout').addClass('open-side-menu')
    }
    if ((contentwidth) > '1200') {
        $('.sticky-sidebar-home').addClass('open-side-menu')
    }
    if ((contentwidth) < '991') {
        $('.widget .widget-wrapper').addClass('collapse')
    }

    if ((contentwidth) < '991') {
        $('.cart-btn-toggle').removeAttr('onclick');
    }


    $('.cart-product-item>.close-item').on('click',function(){
        $(this).parent('.cart-product-item').remove();
    })

    $('.wishlist-item>.close-item').on('click',function(){
        $(this).parent('.wishlist-item').remove();
    })
    

     // fixed menu app home page
     $(window).on("scroll",function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            $(".header-bottom,.mobile-header,.catagory-sidebar-area").addClass("fixed-totop animated slideInDown");
        } else {
            $(".header-bottom,.mobile-header,.catagory-sidebar-area").removeClass("fixed-totop  animated slideInDown");
        }
    });


     // fixed bottom to top
    $(window).on("scroll",function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 500) {
            $(".to-top").addClass("fixed-totopmbb");
        } else {
            $(".to-top").removeClass("fixed-totopmbb");
        }
    });


    //popup
    $('.popup-close,.popup-overlay').on("click", function(){
        $('#popup').hide();
    });
    $(document).ready(function()  {
        $("#popup").delay(2000).fadeIn();
    });

    if($(window).width() > 990) {
        $(document).ready(function() {
            $('.sidebar')
                .theiaStickySidebar({
                    additionalMarginTop: 110
                });
        });
    }




    $(function () {
        setNavigation();
    });
    
    function setNavigation() {
        var pathArray = window.location.pathname.split('/');
        var lastItem = pathArray.pop();
        $(".menu a").each(function () {
            var href = $(this).attr('href');
            if (lastItem.substring(0, href.length) === href) {
                var myLi = $(this).closest('li');
                myLi.addClass('active');
                myLi.parent().parent().addClass('active');
            }
        });
    }

        


    
    
})(jQuery);	



function cartopen() {
    //alert("Hi")
    document.getElementById("sitebar-cart").classList.add('open-cart');
    document.getElementById("sitebar-drawar").classList.add('hide-drawer');
}

function cartclose() {
    document.getElementById("sitebar-cart").classList.remove('open-cart');
    document.getElementById("sitebar-drawar").classList.remove('hide-drawer');
}
// open modal
function openModal() {
    document.getElementById("product-details-popup").classList.add('open-side');
}

function closeModal() {
    document.getElementById("product-details-popup").classList.remove('open-side');
}

// open signup form
function OpenSignUpForm() {
    document.getElementById("login-area").classList.add('open-form');
}

function CloseSignUpForm() {
    document.getElementById("login-area").classList.remove('open-form');
}





// jQuery(function($){
//     $(document).ajaxSend(function() {
//         $("#overlay").fadeIn(300);　
//     });
        
//     $('#edit').click(function(){
//         $.ajax({
//             type: 'GET',
//             success: function(){
//                 $("#load-data").load("../components/edit-profile.html", function(responseTxt, statusTxt, xhr){
//                     if(statusTxt == "success")
//                       alert("External content loaded successfully!");
//                     if(statusTxt == "error")
//                       alert("Error: " + xhr.status + ": " + xhr.statusText);
//                   });
//             }
//         }).done(function() {
//             setTimeout(function(){
//                 $("#overlay").fadeOut(300);
//             },500);
//         });
//     });	
// });


$(document).ready(function(){

$("input[type='radio']").click(function(){
    var sim = $("input[type='radio']:checked").val();
    //alert(sim);
    if (sim<3) { $('.myratings').css('color','red'); $(".myratings").text(sim); }
    else{ $('.myratings').css('color','green'); $(".myratings").text(sim); } 
    }); 
});


$(document).on('click','.userSubscription',function(){
    var email = $('.userSubscription').val();
    var token = $('.newsletter_token').val();
    var where = 'newsletter'
    $.post("../add.php",{email:email,token:token,where:where},
    function(result){
        if (result == 'success') {
            alert('Thank you. Your newsletter subsription was successful!');
            location.reload(true);
           }
            else if (result == 'exists') {
            alert('You are already subscribed for our newsletter.');
           }
           else if (result == 'error') {
            alert('Something went wrong. Please try again later.');
           }
            else{
            alert("Something went wrong. Please try again later.");
           }
    });        
});

$(document).on('click','.anonymousSubscription',function(){
    var email = $('#anonymousEmail').val();
    var token = $('.newsletter_token').val();
    var where = 'newsletter'
    $.post("../add.php",{email:email,token:token,where:where},
    function(result){
        if (result == 'success') {
            alert('Thank you. Your newsletter subsription was successful!');
            location.reload(true);
           }
            else if (result == 'exists') {
            alert('You are already subscribed for our newsletter.');
           }
            else{
            alert("Something went wrong. Please try again later.");
           }
    }); 
  });

  $(document).on('click','.cart_increase',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#cart_qty${id}`).val();
    var total = $('#cart_total').val();
    var where = 'cart_increase'
    $.post("cart.php",{id:id,total:total,qty:qty,where:where},
    function(result){
        if (result == 'max') {
            alert('Quantity Unavailable');
           }
        else{
            var data = $.parseJSON(result);
            var subtotal = data[0];
            var total = data[1];
            var total_hidden = data[2];
            $(`#cart_subtotal${id}`).html(subtotal);
            $('#total_value').html(total);
            $('#cart_total').val(total_hidden);
        }   
    }); 
  });

  $(document).on('click','.cart_decrease',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#cart_qty${id}`).val();
    var total = $('#cart_total').val();
    var where = 'cart_decrease'
    $.post("cart.php",{id:id,total:total,qty:qty,where:where},
    function(result){
        var data = $.parseJSON(result);
        var subtotal = data[0];
        var total = data[1];
        var total_hidden = data[2];
        $(`#cart_subtotal${id}`).html(subtotal);
        $('#total_value').html(total);
        $('#cart_total').val(total_hidden);
    }); 
  });

  $(document).on('click','.checkout_cart_increase',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#checkout_cart_qty${id}`).val();
    var total = $('#checkout_total').val();
    var where = 'cart_increase'
    $.post("cart.php",{id:id,qty:qty,total:total,where:where},
    function(result){
        if (result == 'max') {
            alert('Quantity Unavailable');
           }
           else{
            var data = $.parseJSON(result);
            var subtotal = data[0];
            var total = data[1];
            var total_hidden = data[2];
            $(`#checkout_subtotal${id}`).html(subtotal);
            $('#checkout_total_value').html(total);
            $('#checkout_total').val(total_hidden);
        }  
    }); 
  });

  $(document).on('click','.checkout_cart_decrease',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#checkout_cart_qty${id}`).val();
    var total = $('#checkout_total').val();
    var where = 'cart_decrease'
    $.post("cart.php",{id:id,qty:qty,total:total,where:where},
    function(result){
        var data = $.parseJSON(result);
            var subtotal = data[0];
            var total = data[1];
            var total_hidden = data[2];
            $(`#checkout_subtotal${id}`).html(subtotal);
            $('#checkout_total_value').html(total);
            $('#checkout_total').val(total_hidden);
    }); 
  });

  $(document).on('click','#user_contact',function(){
    var email = $('#hidden_email').val();
    var subject = $('#subject').val();
    var message = $('#message').val();
    var token = $('.contact_page_token').val();
    var where = 'site_contact'
    $.post("../add.php",{email:email,token:token,subject:subject,message:message,where:where},
    function(result){
        if (result == 'success') {
            alert('Your message was successfully sent! We shall get back to you in the shortest instance possible.');
            location.reload(true);
           }
           else if(result == 'error'){
            alert("Something went wrong. Please try again later.");
           }
            else{
            alert("Something went wrong. Please try again later.");
           }
    });        
});

$(document).on('click','#anonymous_contact',function(){
    var name = $('#full_name').val();
    var email = $('#email_address').val();
    var number = $('#mobile_number').val();
    var subject = $('#subject').val();
    var message = $('#message').val();
    var token = $('.contact_page_token').val();
    var where = 'site_contact'
    $.post("../add.php",{name:name,email:email,token:token,number:number,subject:subject,message:message,where:where},
    function(result){
        if (result == 'success') {
            alert('Your message was successfully sent! We shall get back to you in the shortest instance possible.');
            location.reload(true);
           }
           else if(result == 'error'){
            alert("Something went wrong. Please try again later."); 
          }
            else{
            alert("Something went wrong. Please try again later.");
           }
    });        
});

