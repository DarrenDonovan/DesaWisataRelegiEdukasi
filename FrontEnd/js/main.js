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

    // pas modal dibuka, sembunyikan overlay sementara
    modal.addEventListener("show.bs.modal", function () {
        overlay.style.opacity = "0"; 
    });

    // modal ditutup, hover normal
    modal.addEventListener("hidden.bs.modal", function () {
        overlay.style.opacity = "0"; // Pastikan overlay tidak langsung muncul

        // Tambahkan  hover saat mouse masuk & keluar
        destinationImg.addEventListener("mouseenter", function () {
            overlay.style.opacity = "1";
        });

        destinationImg.addEventListener("mouseleave", function () {
            overlay.style.opacity = "0";
        });
    });
});
// MODAL GALLERY END

// PETA
// Inisialisasi Peta
var map = L.map('map').setView([-6.235, 106.466], 13); // Pastikan koordinat sesuai lokasi

// Definisi tile layer (peta jalan dan peta satelit)
var streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
});

var satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: '&copy; Esri & Contributors'
});

// Tambahkan layer default (peta jalan)
streetLayer.addTo(map);

// Kontrol untuk memilih peta
var baseMaps = {
    "Peta Jalan": streetLayer,
    "Peta Satelit": satelliteLayer
};

L.control.layers(baseMaps).addTo(map);

// Data Interest Points (langsung ditampilkan tanpa kategori)
var interestPoints = [
    { name: "Pasir Bolang", lat: -6.226479917976542,    lon: 106.47184220102415 },
    { name: "Cisereh", lat: -6.222,  lon: 106.458 },
    { name: "Pasir Nangka", lat: -6.234,  lon: 106.471},
    { name: "Pematang", lat: -6.238,  lon: 106.460},
    { name: "Pete", lat: -6.253,  lon: 106.453},
    { name: "Tegalsari", lat: -6.242760178426513,   lon: 106.44619795929671},
];

// Tambahkan marker ke peta
interestPoints.forEach(point => {
    L.marker([point.lat, point.lon]).addTo(map)
        .bindPopup(`<b>${point.name}</b>`);
});
// PETA END
        
