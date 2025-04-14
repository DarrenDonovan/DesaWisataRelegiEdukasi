<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <title>Website Kecamatan Tigaraksa</title>
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
        <link href="{{ url('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ url('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ url('css/style.css') }}" rel="stylesheet">
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid bg-primary px-5 d-none d-lg-block">
            <div class="row gx-0 justify-content-end"> <!-- Tambahkan justify-content-end -->
                <div class="col-lg-4 text-end"> <!-- Gunakan text-end agar teks sejajar ke kanan -->
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a href="{{url('login')}}"><small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Login</small></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="{{ url('/') }}" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Kecamatan Tigaraksa<span class="subtext">Kabupaten Tangerang</span></h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                        <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                        <a href="{{ url('about') }}" class="nav-item nav-link">Tentang Kami</a>
                        <a href="{{ url('infografis') }}" class="nav-item nav-link">Infografis</a>
                        <a href="{{ url('maps') }}" class="nav-item nav-link">Maps</a>
                        <a href="{{ url('berita') }}" class="nav-item nav-link">Berita</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profile Desa</a>
                            <div class="dropdown-menu m-0">
                                @foreach ($wilayahNoKec as $item)
                                <a href="{{ url('profildesa/' . $item->id_wilayah) }}" class="dropdown-item">{{ $item->nama_wilayah }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </nav>

            <!-- Carousel Start -->
            <div class="carousel-header">
                <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="img/car-2.jpg" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                <div class="p-3" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Selamat Datang</h4>
                                    <h1 class="display-2 text-capitalize text-white mb-4">Website Kecamatan Tigaraksa</h1>
                                    <p class="mb-5 fs-5">Sumber informasi terbaru tentang desa-desa yang ada di Kecamatan Tigaraksa 
                                    </p>
                                </div>
                            </div>
                        </div>
    
            <!-- Carousel End -->
        </div>
        <div class="container-fluid w-100 search-bar position-relative" style="top: -50%; transform: translateY(-50%);">
                <div class="position-relative rounded-pill w-100 mx-auto p-5" style="background: rgba(19, 53, 123, 0.8);">
                    <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="🔍 Cari..."> 
                    <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute me-2" style="top: 50%; right: 46px; transform: translateY(-50%);">Search</button> 
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- BERITA -->
        <div class="container mt-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Highlight</h5>
                <h1 class="mb-0">Berita Terbaru Kecamatan Tigaraksa</h1>
            </div>
            <div class="row">
                <!-- Berita 1 -->
                @foreach ($berita as $itemBerita)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $itemBerita->gambar_berita) }}" class="card-img-top" alt="Gambar Berita">
                        <div class="card-body">
                            <h5 class="card-title">{{ $itemBerita->judul_berita }}</h5>
                            <p class="text-muted">
                                <i class="bi bi-calendar"></i> {{ $itemBerita->tanggal_berita }} &nbsp; 
                                <i class="bi bi-person"></i> {{ $itemBerita->penulis_berita }}
                            </p>
                            <p class="card-text">{!! Str::limit($itemBerita->konten_berita, 50, '...') !!}</p>
                            <a href="{{ url('detailberita/' . $itemBerita->id_berita) }}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- BERITA END -->

        <!-- Kegiatan Start -->
        <!-- Kegiatan Terbaru -->
        <div class="container-fluid destination py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-3" style="max-width: 900px;">
                    <h5 class="section-title px-3">Galeri</h5>
                    <h1 class="mb-0">Kegiatan Kecamatan Tigaraksa</h1>
                </div>
                <div class="container-fluid mb-4">
                    <div class="container py-5">
                        <div class="row g-5 align-items-center">
                            <div class="col-md-5">
                                <div class="h-100" >
                                    <img src="{{asset('storage/' . $kegiatanterbaru->gambar_kegiatan)}}" class="img-fluid" style="width: 400px; height: auto; margin-left: 40px;" alt="">
                                </div>
                            </div>
                            @if ($kegiatanterbaru)
                            <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                                <h5 class="section-about-title pe-3">Kegiatan Terbaru</h5>
                                <h1 class="mb-4" class="text-primary">{{ $kegiatanterbaru->nama_kegiatan }}</h1>
                                <p class="mb-4">{{ $kegiatanterbaru->keterangan }}</p>                        
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Daftar Kegiatan -->
                <div class="tab-class text-center">
                    <ul class="nav nav-pills d-inline-flex justify-content-center mb-2">
                        <li class="nav-item">
                            <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-all">
                                <span class="text-dark" style="width: 150px;">Semua</span>
                            </a>
                        </li>
                        @foreach ($jenis_kegiatan as $jenis)
                        <li class="nav-item">
                            <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-{{ $jenis->id_jenis_kegiatan }}">
                                <span class="text-dark" style="width: 150px;">{{ $jenis->nama_jenis_kegiatan }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div id="tab-all" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="row g-4">
                                    @foreach ($kegiatan as $keg)
                                    <div class="col-lg-4">
                                        <div class="destination-img" style="width: 100%; object-fit:cover;">
                                            <img class="img-fluid rounded w-100" src="{{ asset('storage/' . $keg->gambar_kegiatan) }}" data-bs-toggle="modal"  style="width: 432px; height: 250px; object-fit:cover;">
                                            <div class="destination-overlay p-4 text-start">
                                                <a class="btn btn-primary text-white rounded-pill border py-2 px-3" style="pointer-events: none;">6 Photos</a>                                                       
                                                <h4 class="text-white mb-2 mt-3">{{ $keg->nama_kegiatan }}</h4>
                                                <a href="#galleryModal{{ $keg->id_kegiatan }}" class="btn-hover text-white"  data-bs-toggle="modal" data-bs-target="#galleryModal{{ $keg->id_kegiatan }}">Lihat Semua Foto <i class="fa fa-arrow-right ms-2"></i>
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- galeri pas di klik -->
                                    <div class="modal fade" id="galleryModal{{ $keg->id_kegiatan }}" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="galleryModalLabel">Galeri {{ $keg->nama_kegiatan }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-5">
                                                        <div class="col-md-5">
                                                            <div class="h-100" >
                                                                <img src="{{asset('storage/' . $keg->gambar_kegiatan)}}" class="img-fluid" style="width: 400px; height: auto; margin-left: 20px;" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                                                            <h1 class="mb-4" class="text-primary">{{ $keg->nama_kegiatan }}</h1>
                                                            <p class="mb-4">{{ $keg->keterangan }}</p>                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <!-- Kegiatan per kategori -->
                        @foreach ($jenis_kegiatan as $jenisKegiatan)
                        <div id="tab-{{ $jenisKegiatan->id_jenis_kegiatan }}" class="tab-pane fade p-0">
                            <div class="row g-4">
                                @foreach ($kegiatan as $item)
                                    @if ($item->id_jenis_kegiatan == $jenisKegiatan->id_jenis_kegiatan)
                                    <div class="col-lg-4 col-md-6"> 
                                        <div class="destination-img" style="width: 100%; object-fit:cover;">
                                            <img class="img-fluid rounded w-100" src="{{ asset('storage/' . $item->gambar_kegiatan) }}" style="object-fit: cover; width: 100%; height: 250px;">
                                            <div class="destination-overlay p-4 text-start">
                                                <a class="btn btn-primary text-white rounded-pill border py-2 px-3" style="pointer-events: none;">6 Photos</a>                                                       
                                                <h4 class="text-white mb-2 mt-3">{{ $item->nama_kegiatan }}</h4>
                                                <a href="#galleryModal{{ $item->id_kegiatan }}-{{ $jenisKegiatan->id_jenis_kegiatan }}" class="btn-hover text-white" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $item->id_kegiatan }}-{{ $jenisKegiatan->id_jenis_kegiatan }}">Lihat Semua Foto <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="galleryModal{{ $item->id_kegiatan }}-{{ $jenisKegiatan->id_jenis_kegiatan }}" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="galleryModalLabel">Galeri {{ $item->nama_kegiatan }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-5">
                                                        <div class="col-md-5">
                                                            <div class="h-100" >
                                                                <img src="{{asset('storage/' . $keg->gambar_kegiatan)}}" class="img-fluid" style="width: 400px; height: auto; margin-left: 20px;" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                                                            <h1 class="mb-4" class="text-primary">{{ $keg->nama_kegiatan }}</h1>
                                                            <p class="mb-4">{{ $keg->keterangan }}</p>                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
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
        <!-- Footer End -->
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{url('lib/easing/easing.min.js')}}"></script>
        <script src="{{url('lib/waypoints/waypoints.min.js')}}"></script>
        <script src="{{url('lib/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{url('lib/lightbox/js/lightbox.min.js')}}"></script>
        

        <!-- Template Javascript -->
        <script src="{{url('js/main.js')}}"></script>
    </body>

</html>