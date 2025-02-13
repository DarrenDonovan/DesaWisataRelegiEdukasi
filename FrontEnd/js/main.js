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


// PETA
var map = L.map('map').setView([-6.2486487494494085, 106.45379672355843], 13); // Ganti koordinat sesuai lokasi desa

// Definisi tile layer (peta jalan dan peta satelit)
var streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
});

var satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: '&copy; Esri & Contributors'
});

// Tambahkan layer default (peta jalanan)
streetLayer.addTo(map);

// Kontrol untuk memilih peta
var baseMaps = {
    "Peta Jalan": streetLayer,
    "Peta Satelit": satelliteLayer
};

L.control.layers(baseMaps).addTo(map);

// Data Interest Points (contoh data)
var interestPoints = [
    { name: "Wisata A", lat: -6.250521229491999, lon: 106.45422669776936, category: "wisata" },
    { name: "Warung Bu Siti", lat: -6.252, lon: 106.455, category: "makanan" },
    { name: "Homestay ABCD", lat: -6.248, lon: 106.457, category: "penginapan" }
];

// Tambahkan marker ke peta
var markers = [];
function addMarkers(category) {
    // Hapus semua marker sebelum menambahkan yang baru
    markers.forEach(marker => map.removeLayer(marker));
    markers = [];

    interestPoints.forEach(point => {
        if (category === "all" || point.category === category) {
            var marker = L.marker([point.lat, point.lon]).addTo(map)
                .bindPopup(`<b>${point.name}</b>`);
            markers.push(marker);
        }
    });
}

// Tambahkan semua marker pertama kali
addMarkers("all");

// Event untuk filter berdasarkan kategori
document.getElementById("categoryFilter").addEventListener("change", function() {
    addMarkers(this.value);
});

// Event untuk pencarian lokasi
document.getElementById("searchBox").addEventListener("input", function() {
    var query = this.value.toLowerCase();
    markers.forEach(marker => {
        var popupText = marker.getPopup().getContent().toLowerCase();
        if (popupText.includes(query)) {
            marker.openPopup();
        }
    });
});


