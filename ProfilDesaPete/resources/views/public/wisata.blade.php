<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Wisata</title>

    <!-- Bootstrap CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    />
    <!-- 360 ESSENTIALS -->
    <link rel="stylesheet" href="css/site.css" media="all" />
    <link rel="stylesheet" href="css/panorama360.css" media="all" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ url('js/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ url('js/jquery.panorama360.js') }}"></script>
    <!-- Custom CSS -->
    <link href="{{ url('css/style.css') }}" rel="stylesheet" />
    <style>
      * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Hero Section */
.hero {
    position: relative;
    background: url('img/pantai.jpg') center/cover no-repeat;
    height: 500px; /* Sesuaikan tinggi */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    padding: 20px;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.hero-text {
    position: relative;
    z-index: 2;
}

/* Tombol Kembali */
.back-button {
    position: absolute;
    top: 20px;  /* Jarak dari atas */
    left: 20px; /* Jarak dari kiri */
    font-size: 24px;
    background: rgba(255, 255, 255, 0.7);
    color: black;
    padding: 10px 15px;
    border-radius: 50%;
    text-decoration: none;
    transition: 0.3s;
    z-index: 3;
}

.back-button:hover {
    background: rgba(255, 255, 255, 1);
}


.hero-text h4 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #ddd;
}

.hero-text h1 {
    font-size: 50px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #ddd;
}

.hero-text p {
    font-size: 18px;
    line-height: 1.5;
}

/* 360 */
.explore-360 {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 50px;
    max-width: 1200px;
    margin: auto;
    gap: 20px;
}

.text-container {
    flex: 1;
    max-width: 500px;
}

.text-container h2 {
    font-size: 28px;
    margin-bottom: 10px;
}

.text-container p {
    font-size: 16px;
    line-height: 1.5;
    color: #555;
}

.feature-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-placeholder {
    width: 100%;
    height: 300px;
    background-color: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #777;
}

@-webkit-keyframes spin {
                from { -webkit-transform: rotateY(0); }
                to   { -webkit-transform: rotateY(-360deg); }
            }
            @keyframes spin {
                from { transform: rotateY(0); }
                to   { transform: rotateY(-360deg); }
            }

            .vrContainer {
        width: 100%;
        max-width: 600px;
        height: 50vh;
        display: flex; /* Agar elemen di dalamnya mengikuti layout fleksibel */
        justify-content: flex-start; /* Pusatkan panorama */
        align-items: center;
        position: relative;
      }

      #viewer {
                position: absolute;
                /* left: 50%; */
                top: 0px;
                /* margin-left: -320px; */
                width: 100%;
                height: 100%;
                overflow: hidden;
                -webkit-transition: -webkit-transform 3s;
                transition: transform 3s;
                -webkit-perspective: 600px;
                perspective: 1000px;
                -webkit-transform-style: preserve-3d;
                transform-style: preserve-3d;
            }
            #cube {
                width: 100%;
                height: 100%;
                position: absolute;
                transform-style: preserve-3d;
                -webkit-transform-style: preserve-3d;
                transform-origin: 50% 50% 750px;
                -webkit-transform-origin: 50% 50% 750px;
                transform: translateZ(-150px);
                -webkit-transform: translateZ(-150px);
            }

            #cube img {
                position: absolute;
                width: 1500px;
                height: 1500px;
                top: 50%;
                left: 50%;
                margin-top: -750px;
                margin-left: -750px;
                opacity: 0.8;
                -webkit-transition: -webkit-transform 3s;
                transition: transform 3s;
                -webkit-transform-style: preserve-3d;
                transform-style: preserve-3d;
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
            }
            .front {
                -webkit-transform: translateZ(750px) translateZ(-750px);
                transform: translateZ(750px) translateZ(-750px);
            }
            .right {
                -webkit-transform: translateZ(750px) rotateY(-90deg) translateZ(-750px);
                transform: translateZ(750px) rotateY(-90deg) translateZ(-750px);
            }
            .left {
                -webkit-transform: translateZ(750px) rotateY(90deg) translateZ(-750px);
                transform: translateZ(750px) rotateY(90deg) translateZ(-750px);
            }
            .rear {
                -webkit-transform: translateZ(750px) translateZ(750px) rotateY( 180deg );
                transform: translateZ(750px) translateZ(750px) rotateY( 180deg );
            }
            .roof {
                -webkit-transform: translateZ(750px) rotateX(-90deg) translateZ(-750px);
                transform: translateZ(750px) rotateX(-90deg) translateZ(-750px);
            }
            .floor {
                -webkit-transform: translateZ(750px) rotateX(90deg) translateZ(-750px);
                transform: translateZ(750px) rotateX(90deg) translateZ(-750px);
            }

            
/* Responsif  */
@media (max-width: 768px) {
    .explore-360 {
        flex-direction: column;
        text-align: center;
    }

    .feature-placeholder {
        height: 250px;
    }
}

/* MAP */
.explore-map {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 40px;
    max-width: 1200px;
    height: 500px;
    margin: auto;
    gap: 20px;
}

.explore-map .text-container {
    flex: 1;
    max-width: 500px;
    padding-right: 50px;
}

.explore-map .text-container h2 {
    font-size: 28px;
    margin-bottom: 10px;
}

.explore-map .text-container p {
    font-size: 16px;
    line-height: 1.5;
    color: #555;
}

.map-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
}

.map-placeholder {
    width: 100%;
    height: 300px;
    background-color: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #777;
}

/* Responsif */
@media (max-width: 768px) {
    .explore-map {
        flex-direction: column;
        text-align: center;
    }

    .map-placeholder {
        height: 250px;
    }
  } 
    /* CONTENT PAKETAN */
      .contentPaketan {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 20px;
      }

      .paket {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        padding: 10px;
      }

      .paket img {
        width: 100%;
        border-radius: 10px;
      }

      .btn {
        background-color: #13357b;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        width: 100%;
      }

      .btn:hover {
        background-color: #0a2a5c;
      }

      /* MEDIA QUERIES */
      @media (max-width: 768px) {
        .contain {
          flex-direction: column;
          padding: 20px;
        }

        .contentSidebar {
          width: 100%;
        }

        .contenDesk {
          width: 100%;
          padding: 10px;
        }
      }
      
    </style>
  </head>
  <body>
   <!-- Hero Section -->
   <header class="hero">
    <div class="overlay"></div>

    <!-- Tombol Kembali -->
    <a href="{{ url('/') }}" class="back-button">
      &#8592;
  </a>
  

    <div class="hero-text">
        <h4>Wisata</h4>
        <h1>{{ $wisata->nama_tempat }}</h1>
        <p>{{ $wisata->keterangan }}</p>
    </div>
</header>

<!-- Container 360 -->
<section class="explore-360">
<div class="text-container">
    <h2>Jelajahi {{ $wisata->nama_tempat }} dalam 360°</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab laboriosam vel ratione atque modi provident saepe culpa, necessitatibus quas aperiam quia? Ab dolor atque sed quidem soluta. Neque, voluptate?</p>
</div>

<div class="vrContainer">
    <div id="viewer">
        <div id="cube">
            <img class="front" src="/img/texture/cube0000.jpg" alt="" />
            <img class="right" src="/img/texture/cube0001.jpg" alt="" />
            <img class="rear" src="/img/texture/cube0002.jpg" alt="" />
            <img class="left" src="/img/texture/cube0003.jpg" alt="" />
            <img class="roof" src="/img/texture/cube0004.jpg" alt="" />
            <img class="floor" src="/img/texture/cube0005.jpg" alt="" />
        </div>
    </div>
</div>

</section>

<!-- Container Map dengan Tracking -->
<section class="explore-map">
<div class="text-container">
    <h2>Telusuri {{ $wisata->nama_tempat }} dengan Peta Interaktif</h2>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi necessitatibus ipsum dignissimos harum debitis non qui sapiente, voluptates accusamus laborum quos voluptatum tempora culpa sequi quibusdam! Eaque labore ipsa excepturi.</p>
</div>

<div class="map-container">
    <iframe src="{{ url('rute/' . $wisata->id_wisata) }}" width="100%" height="400px" style="border-radius: 10px; border: none;"></iframe>
</div>

</section>


      <!-- CONTAINER PAKETAN -->
      <div class="contentPaketan">
        <div class="paket">
          <img src="/img/packages-1.jpg" alt="Hidden Gems Jogja" />
          <button class="btn">Hidden Gems [Klik Sini]</button>
        </div>
        <div class="paket">
          <img src="/img/packages-2.jpg" alt="Wisata Keluarga" />
          <button class="btn">Wisata Keluarga [Klik Sini]</button>
        </div>
        <div class="paket">
          <img src="/img/packages-3.jpg" alt="Jogja Magelang 2H1M" />
          <button class="btn">Wisata 2H1M [Klik Sini]</button>
        </div>
      </div>
    </div>
    <!-- <script src="js/jquery-2.0.2.min.js"></script> -->
    <script>
      (function() {
    var x1, y1, moving = false,
        $viewer = $('#viewer'),
        $cube = $('#cube'),
        w_v = $viewer.width(), 
        h_v = $viewer.height(),
        c_yaw = 0,
        c_pitch = 0,
        perspective = 525;

    $viewer.on('mousedown', function(e) {
        x1 = e.pageX;
        y1 = e.pageY;
        moving = true;
        e.preventDefault();
    });

    $(document).on('mousemove', function(e) {
        if (moving) {
            x2 = e.pageX;
            y2 = e.pageY;

            var dist_x = x2 - x1,
                dist_y = y2 - y1,
                yaw = Math.atan2(dist_y, perspective) / Math.PI * 180,
                pitch = -Math.atan2(dist_x, perspective) / Math.PI * 180,
                vendors = ['-webkit-', '-moz-', ''];

            c_yaw += yaw;
            c_pitch += pitch;
            c_yaw = Math.min(90, c_yaw);
            c_yaw = Math.max(-90, c_yaw);
            c_pitch %= 360;

            yaw = c_yaw;
            pitch = c_pitch;

            for (let i in vendors) {
                $cube.css(vendors[i] + 'transform', `translateZ(-150px) rotateX(${yaw}deg) rotateY(${pitch}deg)`);
            }

            x1 = x2;
            y1 = y2;
        }
    }).on('mouseup', function() {
        moving = false;
    });

    // Hanya aktif jika mouse ada di dalam viewer
    $(document).on('mousemove', function(e) {
        var offset = $viewer.offset();
        var mouseX = e.pageX;
        var mouseY = e.pageY;

        if (
            mouseX < offset.left || 
            mouseX > offset.left + $viewer.width() || 
            mouseY < offset.top || 
            mouseY > offset.top + $viewer.height()
        ) {
            moving = false;
        }
    });

})();

              </script>
  </body>
</html>
