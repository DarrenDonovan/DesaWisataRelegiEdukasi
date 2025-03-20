<!-- HARUS DIUPDATE -->

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title> Tentang Kami</title>
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
            <div class="row gx-0">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                </div>
                <div class="col-lg-4 text-center text-lg-end">
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
                        <a href="{{ url('/') }}" class="nav-item nav-link">Home</a>
                        <a href="{{ url('about') }}" class="nav-item nav-link active">Tentang Kami</a>
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
        <!-- Navbar & Hero End -->

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Tentang Kami</h1>
            </div>
        </div>
        <!-- Header End -->

        <!-- About Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5">
                        <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                            <img src="{{ asset('storage/' . $about_us->gambar_about) }}" class="img-fluid w-100 h-100" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8))">
                        <h5 class="section-about-title pe-3">Visi dan Misi Kecamatan Tigakarsa</h5>
                        <h1 class="mb-4"> Visi </h1>
                        {!! $about_us->visi !!}
                        <h1 class="mb-4"> Misi </h1>
                        {!! $about_us->misi !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Struktu organisasi -->
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3"> Bagan Organisasi</h5>
            <h1 class="mb-0"> Struktur Pemerintahan Kecamatan </h1>
            <img src="{{ asset('storage/' . $about_us->bagan_organisasi) }}" class="img-fluid w-100 h-100" alt="">
        </div>
        <!--  Struktur organisasi end-->

         <!-- Perangkat Start -->
         <div class="container-fluid guide py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3"> Perangkat Kecamatan </h5>
                    <h1 class="mb-0"> Daftar nama dan Jabatan </h1>
                </div>
                <br>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="{{ asset('storage/' . $camat->gambar_perangkat) }}" style="height: 300px; width:100%; object-fit:cover" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner" style="height: 100px">
                                    <h4 class="mt-3">{{ $camat->nama }}</h4>
                                    <p class="mb-0">{{ $camat->jabatan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="{{ asset('storage/' . $sekretaris->gambar_perangkat) }}" style="height: 300px; width:100%; object-fit:cover" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner" style="height:100px">
                                    <h4 class="mt-3">{{ $sekretaris->nama }}</h4>
                                    <p class="mb-0">{{ $sekretaris->jabatan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($kasi as $kepala_seksi)
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item" >
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="{{ asset('storage/' . $kepala_seksi->gambar_perangkat) }}" style="height: 300px; width:100%; object-fit:cover" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner" style="height: 100px">
                                    <h4 class="mt-3">{{ $kepala_seksi->nama }}</h4>
                                    <p class="mb-0">{{ $kepala_seksi->jabatan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @foreach ($kepala_desa as $kades)
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="{{ asset('storage/' . $kades->gambar_perangkat) }}" style="height: 300px; width:100%; object-fit:cover" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner" style="height: 100px">
                                    <h4 class="mt-3">{{ $kades->nama }}</h4>
                                    <p class="mb-0">{{ $kades->jabatan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Perangkat End -->
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3"> Lokasi Desa </h5>
            <h1 class="mb-0"> Peta Lokasi Desa </h1>
        </div>
        

            <!-- Kotak Informasi -->
        <div class="containerInfoMap">
            <div class="info">
                <h2>{{ $wilayahkecamatan->nama_wilayah }}</h2>
                <p><strong>Batas Kecamatan</strong></p>
                <table>
                    <tr><td class="highlight">Utara</td><td>Kecamatan Cikupa - Balaraja</td></tr>
                    <tr><td class="highlight">Timur</td><td>Kecamatan Cikupa - Panongan </td></tr>
                    <tr><td class="highlight">Selatan</td><td>Kecamatan Jambe - Kabupaten Bogor</td></tr>
                    <tr><td class="highlight">Barat</td><td>Kecamatan Solear - Cisoka</td></tr>
                    <tr><td class="highlight">Luas Desa</td><td>{{ number_format($wilayahkecamatan->luas_wilayah, 0, ',', '.') }} Ha</td></tr>
                    <tr><td class="highlight">Jumlah Penduduk</td><td>{{ number_format($jumlah_penduduk, 0, ',', '.') }} Jiwa</td></tr>
                </table>
            </div>
    
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126912.9796141675!2d106.38661133346228!3d-6.259697926417773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4206f20e931b2d%3A0xef390e4510eb920c!2sKec.%20Tigaraksa%2C%20Kabupaten%20Tangerang%2C%20Banten!5e0!3m2!1sid!2sid!4v1741580904300!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>            </div>
        </div>

        <br>
        <br>
    

        <!-- Footer Start -->
        <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
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
                        Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
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
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

</html>