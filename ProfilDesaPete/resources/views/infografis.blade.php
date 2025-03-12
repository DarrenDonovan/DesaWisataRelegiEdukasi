<!-- HARUS DIUPDATE -->

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Infografis Desa Pete</title>
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
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

       
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
                        <a href="{{ url('infografis') }}" class="nav-item nav-link active">Infografis</a>
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
                <h3 class="text-white display-3 mb-4">Infografis</h1>
            </div>
        </div>
        <!-- Header End -->

        <!-- Services Start -->
        <div class="container-fluid bg-light service py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">Demografi</h5>
                    <h1 class="mb-0">Penduduk</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-12">
                                <a href="#jumlah-penduduk" class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">Jumlah Penduduk</h5>
                                        <p class="mb-0">
                                            Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <i class="fa fa-globe fa-4x text-primary"></i>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-12">
                                <a href="#berdasarkan-dusun" class="service-content-inner d-flex align-items-center  bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">Berdasarkan Dusun</h5>
                                        <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <i class="fa fa-hotel fa-4x text-primary"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="#berdasarkan-umur" class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">Berdasarkan Kelompok Umur</h5>
                                        <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <i class="fa fa-user fa-4x text-primary"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-12">
                                <a href="#berdasarkan-pekerjaan" class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <i class="fa fa-globe fa-4x text-primary"></i>
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Berdasarkan Pekerjaan</h5>
                                        <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="#berdasarkan-agama" class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <i class="fa fa-hotel fa-4x text-primary"></i>
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Berdasarkan Agama</h5>
                                        <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="#berdasarkan-pendidikan" class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <i class="fa fa-user fa-4x text-primary"></i>
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Berdasarkan Pendidikan</h5>
                                        <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services End -->

        <!-- Jumlah penduduk dan kepala keluarga -->
        <div class="container-fluid testimonial" id="jumlah-penduduk">
            <div class="container">
                <div class="container-fluid testimonial py-5">
                    <div class="container py-5">
                        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                            <h1 class="mb-0" >Jumlah Penduduk</h1>
                            <div>
                              <canvas id="Chart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END -->

         <!--  Berdasarkan Dusun-->
        <div class="container-fluid testimonial" id="berdasarkan-dusun">
            <div class="container">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h1 class="mb-0">Berdasarkan Dusun</h1>
                    <div>
                      <canvas id="Chart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- END -->

        <!-- Berdasarkan kelompok umur  -->
        <div class="container-fluid testimonial" id="berdasarkan-umur">
            <div class="container">
                <div class="mx-auto text-center mb-5" style="max-width: 600px;">
                    <h1 class="mb-0">Berdasarkan Kelompok Umur</h1>
                    <div>
                      <canvas id="Chart3"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- END -->

         <!-- Berdasarkan pekerjaan  -->
         <div class="container-fluid testimonial" id="berdasarkan-pekerjaan">
            <div class="container">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h1 class="mb-0">Berdasarkan Pekerjaan</h1>
                    <div>
                      <canvas id="Chart4"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- END -->

        <!-- Berdasarkan agama  -->
        <div class="container-fluid testimonial" id="berdasarkan-agama">
            <div class="container">
                <div class="mx-auto text-center mb-5" style="max-width: 600px;">
                    <h1 class="mb-0">Berdasarkan Agama</h1>
                    <div>
                      <canvas id="Chart5" width="300" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- END -->

        <!-- Berdasarkan pendidikan  -->
        <div class="container-fluid testimonial" id="berdasarkan-pendidikan">
            <div class="container">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h1 class="mb-0">Berdasarkan Pendidikan</h1>
                    <div>
                      <canvas id="Chart6"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- END -->


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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ url('lib/easing/easing.min.js') }}"></script>
        <script src="{{ url('lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ url('lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ url('lib/lightbox/js/lightbox.min.js') }}"></script>
        

        <!-- Template Javascript -->
        <script src="{{ url('js/main.js') }}"></script>
        <script>
          const ctx1 = document.getElementById('Chart1');
          new Chart(ctx1, {
            type: 'bar',
            data: {
              labels: {!! json_encode($jumlah_penduduk->pluck('nama_wilayah')) !!},
              datasets: [{
                label: 'Jumlah Penduduk',
                data: {!! json_encode($jumlah_penduduk->pluck('jumlah_penduduk')) !!},
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });


          const ctx2 = document.getElementById('Chart2');
          new Chart(ctx2, {
            type: 'bar',
            data: {
              labels: {!! json_encode($jumlah_dusun->pluck('nama_wilayah')) !!},
              datasets: [{
                label: 'Jumlah Penduduk',
                data: {!! json_encode($jumlah_dusun->pluck('jumlah_dusun')) !!},
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });


          const ctx3 = document.getElementById('Chart3');
          new Chart(ctx3, {
            type: 'doughnut',
            data: {
              labels: {!! json_encode($kel_umur_kecamatan->pluck('kelompok_umur')) !!}, 
              datasets: [{
                label: 'Jumlah Orang',
                data: {!! json_encode($kel_umur_kecamatan->pluck('jumlah_orang')) !!}, 
                backgroundColor: [
                  'rgba(255, 99, 132, 0.6)', 
                  'rgba(54, 162, 235, 0.6)', 
                  'rgba(255, 206, 86, 0.6)', 
                  'rgba(75, 192, 192, 0.6)',
                  'rgba(153, 102, 255, 0.6)',
                  'rgba(0, 255, 255, 0.6)'
                ]
              }]
            }
          });


          const ctx4 = document.getElementById('Chart4');
          new Chart(ctx4, {
            type: 'bar',
            data: {
              labels: {!! json_encode($pekerjaan_kecamatan->pluck('pekerjaan')) !!},
              datasets: [{
                label: 'Jumlah Pekerja',
                data: {!! json_encode($pekerjaan_kecamatan->pluck('jumlah_pekerja')) !!},
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });


          const ctx5 = document.getElementById('Chart5');
          new Chart(ctx5, {
            type: 'pie',
            data: {
              labels: {!! json_encode($agama_kecamatan->pluck('agama')) !!}, 
              datasets: [{
                label: 'Jumlah Penganut',
                data: {!! json_encode($agama_kecamatan->pluck('jumlah_penganut')) !!}, 
                backgroundColor: [
                  'rgba(255, 99, 132, 0.6)', 
                  'rgba(54, 162, 235, 0.6)', 
                  'rgba(255, 206, 86, 0.6)', 
                  'rgba(75, 192, 192, 0.6)',
                  'rgba(153, 102, 255, 0.6)',
                  'rgba(0, 255, 255, 0.6)'
                ]
              }]
            }
          });


          const ctx6 = document.getElementById('Chart6');
          new Chart(ctx6, {
            type: 'bar',
            data: {
              labels: {!! json_encode($pendidikan_kecamatan->pluck('pendidikan')) !!},
              datasets: [{
                label: 'Jumlah Orang',
                data: {!! json_encode($pendidikan_kecamatan->pluck('jumlah_orang')) !!},
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        </script>


    </body>

</html>