<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    @foreach ($wilayaheach as $itemWilayah)
    <title>{{ $itemWilayah->nama_wilayah }}</title>
    @endforeach
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="{{ url('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ url('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ url('css/style.css') }}" rel="stylesheet" />
    <link href="{{ url('css/leaflet.css') }}" rel="stylesheet" />

    <style>  
      /* CARD WISATA */
        .containerWisata {
            max-width: 1400px;
            margin: auto;
            text-align: center;
        }

        .gridWisata {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 20px;
        }

        .cardW {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .cardW img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .cardW:hover img {
            transform: scale(1.05);
            cursor: pointer;
        }

        .cardW .info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            text-align: left;
        }

        /* UMKM CSS */
        .containerUMKM {
            max-width: 1400px;
            margin: auto;
            text-align: center;
        }

        .gridUMKM {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
        }
        
        .cardU {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .cardU img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .cardU:hover img {
            /* transform: scale(1.05); */
            cursor: pointer;
        }

        .cardU .info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            text-align: left;
        }

        .umkm-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            text-align: center;

            /* Efek transisi */
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .umkm-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);

            /* Efek transisi */
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        /* Saat popup aktif */
        .umkm-popup.show {
            opacity: 1;
            visibility: visible;
        }

        .umkm-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .close-btn {
            background: red;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
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
                        <a href="{{ url('about') }}" class="nav-item nav-link">Tentang Kami</a>
                        <a href="{{ url('infografis') }}" class="nav-item nav-link">Infografis</a>
                        <a href="{{ url('maps') }}" class="nav-item nav-link">Maps</a>
                        <a href="{{ url('berita') }}" class="nav-item nav-link">Berita</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Profile Desa</a>
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
    @foreach ($wilayaheach as $itemWilayah)
      <h3 class="text-white display-3 mb-4 text-center">
        <span class="small-text d-block">{{ $itemWilayah->jenis_wilayah }}</span>
        {{ $itemWilayah->nama_wilayah }}
      </h3>
      @endforeach
    </div>
    <!-- Header End -->

    <!-- Profil -->
    <div class="mx-auto text-center mb-5" style="max-width: 900px; margin-top: 100px;">
      <h5 class="section-title px-3"> perkenalkan </h5>
      <h1 class="mb-0">Profil Desa</h1>
    </div>
    <div class="containerProDes">
      <div class="proDes">
        @foreach ($wilayaheach as $itemWilayah)
        <h2>{{ $itemWilayah->nama_wilayah }}</h2>
        <p><strong>Batas {{ $itemWilayah->jenis_wilayah }}</strong></p>
        <table>
          <tr>
            <td class="highlight">Utara :</td>
            <td>{{ $itemWilayah->batas_utara }}</td>
          </tr>
          <tr>
            <td class="highlight">Timur :</td>
            <td>{{ $itemWilayah->batas_timur }}</td>
          </tr>
          <tr>
            <td class="highlight">Selatan :</td>
            <td>{{ $itemWilayah->batas_selatan }}</td>
          </tr>
          <tr>
            <td class="highlight">Barat :</td>
            <td>{{ $itemWilayah->batas_barat }}</td>
          </tr>
        </table>
        <p><strong>Luas Desa:</strong> {{ number_format($itemWilayah->luas_wilayah, 0, ',', '.') }} Ha</p>
        <p><strong>Jumlah Penduduk:</strong> {{ number_format($itemWilayah->jumlah_penduduk, 0, ',', '.') }} Jiwa</p>
      </div>

      <div class="gmbrDesa">
        <img
          src="{{ asset('storage/' . $itemWilayah->gambar_wilayah) }}"
          class="img-fluid rounded shadow-lg"
          alt="Gambar Desa"
        />
      </div>
      @endforeach
    </div>
    <!-- Profil end -->

    <!-- Infografis start -->
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
                          <a href="#berdasarkan-dusun" class="service-content-inner d-flex justify-content-end align-items-center bg-white border border-primary rounded p-4 pe-0">
                              <div class="service-content text-end">
                                  <h5 class="mb-4">Berdasarkan Jenis Kelamin</h5>
                                  <p class="mb-0">Dolor sit amet consectetur adipisicing elit...</p>
                              </div>
                              <div class="service-icon p-4">
                                  <i class="fa fa-user fa-4x text-primary"></i>
                              </div>
                          </a>
                      </div>
                      
                      <div class="col-12">
                          <a href="#berdasarkan-umur" class="service-content-inner d-flex justify-content-end align-items-center bg-white border border-primary rounded p-4 pe-0">
                              <div class="service-content text-end">
                                  <h5 class="mb-4">Berdasarkan Kelompok Umur</h5>
                                  <p class="mb-0">Dolor sit amet consectetur adipisicing elit...</p>
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
                                  <p class="mb-0">Dolor sit amet consectetur adipisicing elit...</p>
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
                                  <p class="mb-0">Dolor sit amet consectetur adipisicing elit...</p>
                              </div>
                          </a>
                      </div>
                  </div>
              </div>
          </div>
  
          <div class="d-flex justify-content-center mt-4">
              <a href="#berdasarkan-pendidikan" class="service-content-inner d-flex align-items-center justify-content-center bg-white border border-primary rounded p-4" style="width: 50%;">
                  <div class="service-icon p-4">
                      <i class="fa fa-user fa-4x text-primary"></i>
                  </div>
                  <div class="service-content text-center">
                      <h5 class="mb-4">Berdasarkan Pendidikan</h5>
                      <p class="mb-0">Dolor sit amet consectetur adipisicing elit...</p>
                  </div>
              </a>
          </div>  
      </div>
  </div>

   <!--  Berdasarkan Dusun-->
  <div class="container-fluid testimonial py-5" id="berdasarkan-jen-kel">
      <div class="container py-5">
          <div class="mx-auto text-center" style="max-width: 500px;">
              <h1 class="mb-0">Berdasarkan Jenis Kelamin</h1>
              <canvas id="Chart2"></canvas>
          </div>
      </div>
  </div>
  <!-- END -->

  <!-- Berdasarkan kelompok umur  -->
  <div class="container-fluid testimonial py-5" id="berdasarkan-umur">
      <div class="container py-5">
          <div class="mx-auto text-center" style="max-width: 600px;">
              <h1 class="mb-0">Berdasarkan Kelompok Umur</h1>
              <canvas id="Chart3"></canvas>
          </div>
      </div>
  </div>
  <!-- END -->

   <!-- Berdasarkan pekerjaan  -->
   <div class="container-fluid testimonial py-5" id="berdasarkan-pekerjaan">
      <div class="container py-5">
          <div class="mx-auto text-center" style="max-width: 900px;">
              <h1 class="mb-0">Berdasarkan Pekerjaan</h1>
              <canvas id=""></canvas>
          </div>
      </div>
  </div>
  <!-- END -->

  <!-- Berdasarkan agama  -->
  <div class="container-fluid testimonial py-5" id="berdasarkan-agama">
      <div class="container py-5">
          <div class="mx-auto text-center" style="max-width: 900px;">
              <h1 class="mb-0">Berdasarkan Agama</h1>
              <canvas id=""></canvas>
          </div>
      </div>
  </div>
  <!-- END -->

  <!-- Berdasarkan pendidikan  -->
  <div class="container-fluid testimonial py-5" id="berdasarkan-pendidikan">
      <div class="container py-5">
          <div class="mx-auto text-center" style="max-width: 900px;">
              <h1 class="mb-0">Berdasarkan Pendidikan</h1>
              <canvas id=""></canvas>
          </div>
      </div>
  </div>
  <!-- END -->

  <!-- Infografis END -->



    <!-- Wisata start -->
    <div class="mx-auto text-center mb-5" style="max-width: 900px; margin-top: 100px;">
      <h5 class="section-title px-3"> Wisata </h5>
      <h1 class="mb-0">Jelajahi Wisata Lokal</h1>
    </div>
    <div class="containerWisata">
      <div class="gridWisata">
          @foreach($wisata as $itemWisata)
          <div class="cardW">
            <a href="{{ url('profildesa/' . $itemWisata->id_wilayah . '/wisata/' . $itemWisata->id_wisata) }}">
              <img src="{{ asset('storage/' . $itemWisata->gambar_wisata) }}" alt="{{ $itemWisata->nama_tempat }}"></a>
              <div class="info">{{ $itemWisata->nama_tempat }}</div>
          </div>
          @endforeach
      </div>
  </div>

  <!-- UMKM start -->
  <div class="mx-auto text-center mb-5" style="max-width: 900px; margin-top: 100px;">
    <h5 class="section-title px-3"> UMKM </h5>
    <h1 class="mb-0">Produk Khas Daerah</h1>
  </div>
  <div class="containerUMKM" style="margin-bottom: 50px;"> 
    <div class="gridUMKM">
        @foreach ($jenis_umkm as $itemJenisUmkm)
        <div class="cardU" onclick="showUmkmPopup('{{ $itemJenisUmkm->jenis_umkm }}', '{{ $itemJenisUmkm->keterangan }}')">
            <img src="{{ asset('storage/' . $itemJenisUmkm->gambar_jenis_umkm) }}" alt="">
            <div class="info">{{ $itemJenisUmkm->jenis_umkm }}</div>
        </div>
        @endforeach
    </div>
</div>

<!-- POPUP -->
<div class="umkm-overlay" id="umkm-overlay" onclick="closeUmkmPopup()"></div>
<div class="umkm-popup" id="umkm-popup">
    <h2 id="umkm-popup-title"></h2>
    <p id="umkm-popup-content"></p>
    <!-- MAP -->
    <button class="close-btn" onclick="closeUmkmPopup()">Tutup</button>
</div>

<!-- Kegiatan Start -->
        <!-- Kegiatan Terbaru -->
        <div class="container-fluid destination py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-3" style="max-width: 900px;">
                    <h5 class="section-title px-3">Galeri</h5>
                    <h1 class="mb-0">Kegiatan</h1>
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

        <!-- BERITA -->
        <div class="container mb-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Highlight</h5>
                @foreach($wilayaheach as $itemWilayah)
                <h1 class="mb-0">Berita Terbaru {{ $itemWilayah->nama_wilayah }}</h1>
                @endforeach
            </div>
            <div class="row">
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
                            <a href="{{ url('berita/detailberita/' . $itemBerita->id_berita) }}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- BERITA END -->


    <!-- Footer Start -->
    <div class="container-fluid footer py-5">
      <div class="container py-5">
        <div class="row g-5">
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item d-flex flex-column">
              <h4 class="mb-4 text-white">Hubungi Kami</h4>
              <a href=""><i class="fas fa-home me-2"></i> 123 Street, New York, USA</a>
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
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <script src="{{ url('lib/easing/easing.min.js') }}"></script>
        <script src="{{ url('lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ url('lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ url('lib/lightbox/js/lightbox.min.js') }}"></script>
        

        <!-- Template Javascript -->
        <script src="{{ url('js/main.js') }}"></script>
        <script src="{{ url('js/leaflet.js') }}"></script>

    </body>
    <script>
    function showUmkmPopup(title, content) {
    let popup = document.getElementById('umkm-popup');
    let overlay = document.getElementById('umkm-overlay');

    document.getElementById('umkm-popup-title').innerText = title;
    document.getElementById('umkm-popup-content').innerText = content;

    popup.classList.add('show');
    overlay.classList.add('show');
}

function closeUmkmPopup() {
    let popup = document.getElementById('umkm-popup');
    let overlay = document.getElementById('umkm-overlay');

    popup.classList.remove('show');
    overlay.classList.remove('show');
}

        const ctx2 = document.getElementById('Chart2');
          new Chart(ctx2, {
            type: 'pie',
            data: {
              labels: ['Laki-Laki', 'Perempuan'], 
              datasets: [{
                label: 'Jumlah Penduduk',
                data: {!! json_encode(array_values($rasio_jenis_kelamin)) !!}, 
                backgroundColor: [
				  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 99, 132, 0.6)' 
                ]
              }]
            },
            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    datalabels: {
                        formatter: function (value) {
                            return value.toLocaleString();
                        },
                        color: 'black',
                        font: {
                            size: 14
                        }
                    }
                }
            }
          }); 

	const ctx3 = document.getElementById('Chart3');
          new Chart(ctx3, {
            type: 'doughnut',
            data: {
              labels: {!! json_encode($kel_umur_penduduk->pluck('kelompok_umur')) !!}, 
              datasets: [{
                label: 'Jumlah Orang',
                data: {!! json_encode($kel_umur_penduduk->pluck('jumlah_orang')) !!}, 
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

		  
</script>
</html>