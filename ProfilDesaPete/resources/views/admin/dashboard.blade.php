<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="{{url('css/admin/bootstrap.min.css')}}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="{{url('css/admin/ready.css')}}">
	<link rel="stylesheet" href="{{url('css/admin/demo.css')}}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

	 <!-- Icon Font Stylesheet -->
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{url('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
        <link href="{{url('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Template Stylesheet -->
		<link href="{{url('css/style.css')}}" rel="stylesheet">

	</head>
<body>
   <!-- Topbar Start -->
   <div class="container-fluid bg-primary px-5 d-none d-lg-block topbar">
		<div class="row gx-0 justify-content-end"> <!-- Tambahkan justify-content-end -->
   			<div class="col-lg-4 text-end"> <!-- Gunakan text-end agar teks sejajar ke kanan -->
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    @if(Auth::check() && Auth::user()->role==='superadmin')
					<a href="#" data-bs-toggle="modal" data-bs-target="#modal_removeAdmin"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Remove Admin</small></a>
                    <a href="{{url('admin/createadmin')}}"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Add Admin</small></a>
                    @endif
                    <a href="{{url('logout')}}"><small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Logout</small></a>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Remove Admin  -->
	<div class="modal fade" id="modal_removeAdmin" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
   		<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
					<h5 class="modal-title" id="modalTitle">Remove Admin</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    			</div>
    			<div class="modal-body">
					<form action="{{ route('removeAdmin')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="admin">Nama Admin</label>
							<select name="admin" class="form-control" required>
							    <option value="">-- Pilih Admin --</option>
							    @foreach ($users as $items)
							        <option value="{{ $items->id }}">
									{{ $items->name }}
									</option>
							    @endforeach
							</select>
						</div>
						<button type="submit" class="btn btn-primary form-control">Save changes</button>
					</form>
	            </div>
	        </div>
	    </div>
	</div>

        <!-- Topbar End -->
		<div class="sidebar">
				<ul class="nav">
					<li class="nav-item active">
						<a href="{{ route('admin') }}">
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.kegiatan') }}">
							<p>Kegiatan</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.profilWilayah') }}">
							<p>Profil Wilayah</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.penduduk') }}">
							<p>Kependudukan</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.berita') }}">
							<p>Berita</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.infografis') }}">
							<p>Infografis</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.wisata') }}">
							<p>Wisata</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.umkm') }}">
							<p>UMKM</p>
						</a>
					</li>
				</ul>
		</div>

			<div class="main-panel">
					<div class="container-fluid">
						@if (Session::has('message'))
							<p class="alert alert-success mt-2">{{ Session::get('message') }}</p>
						@endif
						<!-- Informasi Umum Admin Dashboard -->
							<div class="row mt-4">
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<h4 class="card-title text-center mb-1">Jumlah Penduduk Laki-Laki Kecamatan Tigaraksa</h4>
											<div class="card-body">
		  										<p>{{ $total_data_jenis_kelamin->penduduk_laki }}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<h4 class="card-title text-center mb-1">Jumlah Penduduk Perempuan Kecamatan Tigaraksa</h4>
											<div class="card-body">
		  										<p>{{ $total_data_jenis_kelamin->penduduk_perempuan }}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<h4 class="card-title text-center mb-1">Angka Jumlah Penduduk Kecamatan Tigaraksa</h4>
											<div class="card-body">
		  										<p>{{ $total_data_jenis_kelamin->penduduk_laki + $total_data_jenis_kelamin->penduduk_perempuan }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>

						<!-- Chart Jumlah Penduduk di Kecamatan -->
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Jumlah Penduduk Kecamatan Tigaraksa</h4>
									</div>
									<div class="card-body">
										<canvas id="Chart1"></canvas>
									</div>
								</div>
							</div>
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-body">
										<table class="table table-striped mt-3">
											<tbody>
        										<tr>
													<th>Nama Wilayah</th>
													@foreach ($jumlah_penduduk as $jumlahPenduduk)
            											<td>{{ $jumlahPenduduk->nama_wilayah }}</td>
													@endforeach
												</tr>
												<tr>
													<th>Jumlah Penduduk</th>
            										@foreach ($jumlah_penduduk as $jumlahPenduduk)
            											<td>{{ $jumlahPenduduk->jumlah_penduduk }}</td>
													@endforeach
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>


						<!-- Chart Sebaran Penduduk Berdasarkan Jenis Kelamin -->
						<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Sebaran Penduduk Berdasarkan Jenis Kelamin di Kecamatan Tigaraksa</h4>
									</div>
									<div class="card-body">
										<canvas id="Chart2"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Tabel Data Penduduk Berdasarkan Jenis Kelamin</h4>
									</div>
									<div class="card-body">
										<table class="table table-striped mt-3">
											<thead>
												<tr>
													<th scope="col">Jenis Kelamin</th>
													<th scope="col">Jumlah Penduduk</th>
												</tr>
											</thead>
											<tbody>
        										<tr>
            										<td><p>Laki-Laki</p></td>
													<td>{{ $data_jenis_kelamin->penduduk_laki }}</td>
												</tr>
                                                <tr>
            										<td><p>Perempuan</p></td>
													<td>{{ $data_jenis_kelamin->penduduk_perempuan }}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
				</div>	
			</div>
		</div>
	</div> 
	
</body>
<script src="{{url('js/admin/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{url('js/admin/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{url('js/admin/core/popper.min.js"></script>
<script src="{{url('js/admin/core/bootstrap.min.js"></script>
<script src="{{url('js/admin/plugin/chartist/chartist.min.js"></script>
<script src="{{url('js/admin/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="{{url('js/admin/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="{{url('js/admin/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="{{url('js/admin/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{url('js/admin/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="{{url('js/admin/plugin/chart-circle/circles.min.js"></script>
<script src="{{url('js/admin/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="{{url('js/admin/ready.min.js"></script>
<script src="{{url('js/admin/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>


<script>
	const ctx1 = document.getElementById('Chart1');
	new Chart(ctx1, {
	  type: 'bar',
	  data: {
	    labels: {!! json_encode($jumlah_penduduk->pluck('nama_wilayah')) !!},
	    datasets: [{
	      label: 'Jumlah Penduduk',
	      data: {!! json_encode($jumlah_penduduk->pluck('jumlah_penduduk')) !!},
	      borderWidth: 1,
		  datalabels: {
        	anchor:'end',
        	align:'top',
        	offset: 5
          },
	    }]
	  },
	  plugins: [ChartDataLabels],
	  options: {
	    scales: {
	      y: {
	        beginAtZero: true
	      }
	    },
        plugins: {
          datalabels: {
              formatter: function (value) {
                  return value.toLocaleString(); 
                  }
              }
          }
	  }
	});

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

		  const ctx4 = document.getElementById('Chart4');
          new Chart(ctx4, {
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

</script>
</html>