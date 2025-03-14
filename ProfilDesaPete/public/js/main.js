(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });


    // International Tour carousel
    $(".InternationalTour-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : false,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });


    // packages carousel
    $(".packages-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: false,
        dots: false,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });


    // testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });

    
   // Back to top button
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    }); 

})(jQuery);

window.addEventListener("scroll", function () {
    var navbar = document.querySelector(".navbar-brand"); // Ganti dengan elemen navbar utama jika perlu
    if (window.scrollY > 50) { // Jika scroll lebih dari 50px
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});


// MODAL GALLERY
document.addEventListener("DOMContentLoaded", function () {
    let modal = document.getElementById("galleryModal");
    let overlay = document.querySelector(".destination-overlay");
    let destinationImg = document.querySelector(".destination-img");

    if (modal && overlay && destinationImg) {
        // pas modal dibuka, sembunyikan overlay sementara
        modal.addEventListener("show.bs.modal", function () {
            overlay.style.opacity = "0";
        });

        // modal ditutup, hover normal
        modal.addEventListener("hidden.bs.modal", function () {
            overlay.style.opacity = "0"; // Pastikan overlay tidak langsung muncul

            // Tambahkan event listener hanya jika belum ditambahkan sebelumnya
            if (!destinationImg.hasAttribute("data-hover-listener")) {
                destinationImg.addEventListener("mouseenter", function () {
                    overlay.style.opacity = "1";
                });

                destinationImg.addEventListener("mouseleave", function () {
                    overlay.style.opacity = "0";
                });

                // Tandai bahwa event listener sudah ditambahkan
                destinationImg.setAttribute("data-hover-listener", "true");
            }
        });
    }
});

// MODAL GALLERY END


// KECAMATAN SCROLL (yang samping logo)
window.addEventListener("scroll", function() {
    if (window.scrollY > 50) { // Sesuaikan nilai ini sesuai kebutuhan
        document.body.classList.add("scrolled");
    } else {
        document.body.classList.remove("scrolled");
    }
});

    