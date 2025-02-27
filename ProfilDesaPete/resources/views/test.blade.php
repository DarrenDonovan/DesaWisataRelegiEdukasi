<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Peta Desa Pete</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">

        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <style>
            #map { height: 500px; }
        </style>

    </head>

    <body>
 <!-- Kegiatan Start -->
 <div class="container-fluid destination py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">Galeri</h5>
                    <h1 class="mb-0">Kegiatan</h1>
                </div>
                @if ($kegiatanterbaru)
                <div>
                <h1>Kegiatan Terbaru</h1>
                <img src="{{ asset('storage/' . $kegiatanterbaru->gambar_kegiatan) }}" width="100" alt="">
                <h1>{{ $kegiatanterbaru->nama_kegiatan }}</h1>
                <p>{{ $kegiatanterbaru->keterangan }}</p>
                </div>
                @endif
                <div class="tab-class text-center">
                    <ul class="nav nav-pills d-inline-flex justify-content-center mb-2">
                        @foreach ($jenis_kegiatan as $jenis)
                        <li class="nav-item">
                            <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-{{ $jenis->id_jenis_kegiatan }}">
                                <span class="text-dark" style="width: 150px;">{{ $jenis->nama_jenis_kegiatan }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                    @foreach ($jenis_kegiatan as $jk)
                        <div id="tab-{{ $jk->id_jenis_kegiatan }}" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="row g-4">
                                    <div class="col-lg-4">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{ asset('storage/' . $jk->gambar_jenis_kegiatan ) }}" data-bs-toggle="modal" style="object-fit: cover; width: 1000px; height: 240px">
                                            <div class="destination-overlay p-4 text-start">
                                                <a class="btn btn-primary text-white rounded-pill border py-2 px-3" style="pointer-events: none;">6 Photos</a>                                                       
                                                <h4 class="text-white mb-2 mt-3">{{ $jk->nama_jenis_kegiatan }}</h4>
                                                <a href="#galleryModal{{ $jk->id_jenis_kegiatan }}" class="btn-hover text-white"  data-bs-toggle="modal" data-bs-target="#galleryModal{{ $jk->id_jenis_kegiatan }}">Lihat Semua Foto <i class="fa fa-arrow-right ms-2"></i>
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                    @endforeach

                                    <!-- galeri pas di klik -->
                                    <div class="modal fade" id="galleryModal{{ $jk->id_jenis_kegiatan }}" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="galleryModalLabel">Galeri {{ $jk->nama_jenis_kegiatan }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-2">
                                                        @foreach ($kegiatan as $items)
                                                            @if ($items->gambar_kegiatan && $items->id_jenis_kegiatan == $jk->id_jenis_kegiatan)
                                                                <div class="col-md-4">
                									                <img src="{{ asset('storage/' . $items->gambar_kegiatan) }}" style="object-fit: cover; width: 250px; height: 150px;">
                                                                </div>
                									        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Konten Kegiatan start -->
                        <div id="tab-{{ $jk->id_jenis_kegiatan }}" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="container py-5">
                                    <div class="row g-4">
                                        @foreach ($kegiatan as $item)
                                            @if ($item->gambar_kegiatan && $item->id_jenis_kegiatan == $jk->id_jenis_kegiatan)
                                            <div class="col-lg-4 col-md-6">
                                                <img class="img-fluid rounded w-100" src="{{ asset('storage/' . $item->gambar_kegiatan) }}" style="object-fit: cover; width: 1000px; height: 240px">
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Kegiatan End -->

        <!-- Footer Start -->
        <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Hubungi Kami</h4>
                            <a href=""><i class="fas fa-home me-2"></i> Tangerang, Banten, Indonesia</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                            <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                            <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-share fa-2x text-white me-2"></i>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
        
    
    </body>

</html>