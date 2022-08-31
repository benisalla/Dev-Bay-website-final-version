(function ($) {
    "use strict";


    //----------------------------< copy mobile phone >---------------------------
    $("#copy-tele").click((event) => {
        var $ele = $("#copy-tele");
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val("+212 675556566");
        $temp.select();
        document.designMode = "on";
        document.execCommand("copy");
        document.designMode = "off";
        $temp.remove();

        $("#copy-pop-up").addClass("copy-pop-up-active");
        setTimeout(() => {
            $("#copy-pop-up").removeClass("copy-pop-up-active");
        }, 2000);

    })
    //----------------------------< end copy mobile phone >---------------------------



    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 2);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    //Sticky Navbar

    $(window).scroll(function () {

        if ($(this).width() >= 962) {
            $(".nav-link").css("color", "white")

        }
        if ($(this).scrollTop() > 45 && $(this).width() >= 992) {
            $(".nav-link").css("color", "#000066")
            $('.navbar').addClass('sticky-top shadow-sm');


        } else {
            $('.navbar').removeClass('sticky-top');
        }
    });

    // Dropdown on mouse hover

    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function () {

        if ($(this).width() < 992) {
            $('.navbar').addClass('fixed-top shadow-sm');
            $('.navbar').removeClass('sticky-top ');
        } 


        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
                function () {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function () {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 300, 'easeInOutExpo');
        return false;
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        dots: true,
        loop: true,
        center: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 45,
        dots: false,
        loop: true,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 4
            },
            768: {
                items: 6
            },
            992: {
                items: 8
            }
        }
    });

    // close the menu after clicking on a link

    const $PressedLink = $(".PressedLink");
    const $NavbarCollapse = $(".navbar-collapse");
    const $toggleButton = $(".navbar-toggler");

    $PressedLink.click(() => {
        $toggleButton.addClass("collapsed");
        $NavbarCollapse.removeClass("show");
    })


    $('.PressedLink').on('click',(event) => { toggleNav($(event.target)); } );

    function toggleNav(myTarget){
        const $AllClasses = myTarget.attr('class').split(' ');
        $('.PressedLink').map((index, element) => {
            $(element).removeClass('active');
        });
        $('.nav-link.dropdown-toggle').removeClass('active');
        
        if($AllClasses.indexOf('dropdown-item') === 0){
            $('.nav-link.dropdown-toggle').addClass('active');
        }else{
            myTarget.addClass('active');
        }
    }


    $(window).on('scroll', ()=>{
        const $Height = $(document).scrollTop();

        console.log("difference is : "+ ($Height - $('#contact').offset().top))

        toggleNav($($('.PressedLink')[0]));

        if( $Height - $('#about').offset().top >= -10){
            toggleNav($($('.PressedLink')[1]));
        }

        if($Height - $('#service').offset().top >= -10){
            toggleNav($($('.PressedLink')[2]));
        }
        if($Height - $('#plan').offset().top >= -10 ){
            toggleNav($($('.PressedLink')[7]));
        }
        if($Height - $('#contact').offset().top >= -10 ){
            toggleNav($($('.PressedLink')[4]));
        }
        if($Height - $('#testimonial').offset().top >= -10){
            toggleNav($($('.PressedLink')[7]));
        }
        if($Height - $('#team').offset().top >= -10 ){
            toggleNav($($('.PressedLink')[7]));
        }
        if($Height - $('#blog').offset().top >= -10 ){
            toggleNav($($('.PressedLink')[3]));
        }
        
    });


})(jQuery);



