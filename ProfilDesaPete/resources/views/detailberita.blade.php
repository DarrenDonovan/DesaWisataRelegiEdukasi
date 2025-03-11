<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Website Kecamatan Tigaraksa</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        
        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
        <link href="{{ url('css/bootstrap.min1.css') }}" rel="stylesheet">
        <link href="{{ url('css/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ url('css/aos.css') }}" rel="stylesheet">
        <link href="{{ url('css/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ url('css/style.css') }}" rel="stylesheet">
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <style>
          /* Navbar agar tetap di atas */
          .navbar {
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              z-index: 1000;
              background-color: #002c77;
              padding: 15px 20px;
              box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          }
  
          /* Supaya konten tidak ketutupan navbar */
          .main {
              padding-top: 100px; /* Sesuaikan dengan tinggi navbar */
          }
  
          /* Hero section atau container utama */
          .container-fluid {
              margin-top: 20px;
          }
  
          /* Styling Artikel */
          .article {
              background: white;
              padding: 20px;
              border-radius: 10px;
              box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
          }
      </style>

    </head>

    <body class="single-post-page">
        <header>
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
                        <a href="{{ url('/') }}" class="nav-item nav-link">Home</a>
                        <a href="{{ url('about') }}" class="nav-item nav-link">Tentang Kami</a>
                        <a href="{{ url('infografis') }}" class="nav-item nav-link">Infografis</a>
                        <a href="{{ url('maps') }}" class="nav-item nav-link">Maps</a>
                        <a href="{{ url('berita') }}" class="nav-item nav-link active">Berita</a>
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

  <main class="main">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">
              <article class="article">
              <h2 class="title">{{ $berita->judul_berita }}</h2>
                <div class="post-img">
                  <img src="{{ asset('storage/' . $berita->gambar_berita) }}" alt="" class="img-fluid mb-2" style="width: 725px">
                </div>
                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>  {{ $berita->penulis_berita }}</li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i>  {{ $berita->tanggal_berita }}</li>
                  </ul>
                </div><!-- End meta top -->
                <div class="content mt-6 mb-6">
                    {!! $berita->konten_berita !!}
                </div><!-- End post content -->
              </article>
            </div>
          </section><!-- /Blog Details Section -->


        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item card p-3 border rounded">
                <h3 class="widget-title">Recent Posts</h3>
                @foreach ($beritaterbaru as $itemBeritaTerbaru)
                <div class="post-item d-flex border-bottom pb-2 mb-2">
                <img src="{{ asset('storage/' . $itemBeritaTerbaru->gambar_berita) }}" alt="" class="flex-shrink-0 me-2 rounded" width="60" height="60">
                <div>
                    <h4 class="h6 mb-1"><a href="{{ url('detailberita/' . $itemBeritaTerbaru->id_berita) }}">{{ $itemBeritaTerbaru->judul_berita }}</a></h4>
                    <time datetime="2020-01-01" class="text-muted small">{{ $itemBeritaTerbaru->tanggal_berita }}</time>
                </div>
                </div>
                @endforeach
            </div><!--/Recent Posts Widget -->

            <!-- Tags Widget -->
            <div class="tags-widget widget-item card p-3 border rounded mt-3">
                <h3 class="widget-title">Tags</h3>
                <ul class="list-inline">
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">App</a></li>
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">IT</a></li>
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">Business</a></li>
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">Mac</a></li>
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">Design</a></li>
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">Office</a></li>
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">Creative</a></li>
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">Studio</a></li>
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">Smart</a></li>
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">Tips</a></li>
                <li class="list-inline-item m-1"><a href="#" class="btn btn-sm btn-outline-primary">Marketing</a></li>
                </ul>
            </div><!--/Tags Widget -->

          </div>

        </div>

      </div>
    </div>

  </main>

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
                <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Site Name</a>, All right reserved.
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
    <script src="{{ url('lib/easing/easing.min.js') }}"></script>
    <script src="{{ url('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ url('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('lib/lightbox/js/lightbox.min.js') }}"></script>
    

    <!-- Template Javascript -->
    <script src="{{ url('js/main.js') }}"></script>
</body>

</html>