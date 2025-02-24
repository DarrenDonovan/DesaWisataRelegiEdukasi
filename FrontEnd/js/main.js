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



// PETA
// Pastikan script hanya berjalan jika elemen dengan ID "map" ada
if (document.getElementById("map")) {
    // Inisialisasi Peta
    var map = L.map('map').setView([-6.256097964960715, 106.4710449399145], 12); // Pastikan koordinat sesuai lokasi

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

    // Data Interest Points dengan kategori Desa dan Kelurahan
    var interestPoints = [
        { name: "Pasir Bolang", lat: -6.226479917976542, lon: 106.47184220102415, category: "Desa" },
        { name: "Cisereh", lat: -6.23258393623556, lon: 106.45836800354205, category: "Desa" },
        { name: "Pasir Nangka", lat: -6.252225664864957, lon: 106.47206608878156, category: "Desa" },
        { name: "Pematang", lat: -6.250700227216448, lon: 106.46269611260229, category: "Desa" },
        { name: "Pete", lat: -6.2551757467598605, lon: 106.46014819401702, category: "Desa" },
        { name: "Tegalsari", lat: -6.259508718586721, lon: 106.44606958089086, category: "Desa" },
        { name: "Mata Gara", lat: -6.251052078322207, lon: 106.48871237640144, category: "Desa" },
        { name: "Kadu Agung", lat: -6.269039580483018, lon: 106.4977442519755, category: "Kelurahan" },
        { name: "Marga Sari", lat: -6.286065988747027, lon: 106.49771244628573, category: "Desa" },
        { name: "Sodong", lat: -6.282788679349722, lon: 106.46819138548888, category: "Desa" },
        { name: "Tapos", lat: -6.294917102598325, lon: 106.47231257584326, category: "Desa" },
        { name: "Bantar Panjang", lat: -6.295601184925948, lon: 106.45126923990308, category: "Desa" },
        { name: "Cileles", lat: -6.320242630257741, lon: 106.43198249092904, category: "Desa" },
        { name: "Tigaraksa", lat: -6.26416190920571, lon: 106.43198249092904, category: "Kelurahan" }
    ];

    // Array untuk menyimpan marker
    var markers = [];

    // Fungsi untuk menampilkan marker berdasarkan kategori
    function addMarkers(category) {
        // Hapus semua marker sebelum menambahkan yang baru
        markers.forEach(marker => map.removeLayer(marker));
        markers = [];

        interestPoints.forEach(point => {
            if (category === "all" || point.category === category) {
                var marker = L.marker([point.lat, point.lon]).addTo(map);

                // Tooltip menggantikan Popup agar tidak ada tombol X dan menghilang otomatis
                marker.bindTooltip(`<b>${point.name}</b><br>${point.category}`, {
                    permanent: false,   // Tooltip hanya muncul saat cursor di atas
                    direction: "top",   // Menampilkan tooltip di atas marker
                    opacity: 0.9        // Sedikit transparan agar terlihat bagus
                });

                markers.push(marker);
            }
        });
    }

    // Tambahkan semua marker pertama kali
    addMarkers("all");

    // Event untuk filter berdasarkan kategori (jika elemen ada)
    var categoryFilter = document.getElementById("categoryFilter");
    if (categoryFilter) {
        categoryFilter.addEventListener("change", function () {
            addMarkers(this.value);
        });
    }
}

// PETA END


// KECAMATAN SCROLL (yang samping logo)
window.addEventListener("scroll", function() {
    if (window.scrollY > 50) { // Sesuaikan nilai ini sesuai kebutuhan
        document.body.classList.add("scrolled");
    } else {
        document.body.classList.remove("scrolled");
    }
});

  


    