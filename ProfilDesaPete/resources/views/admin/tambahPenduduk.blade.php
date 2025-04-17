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
					<li class="nav-item">
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
					<li class="nav-item active">
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
		  				<!-- Daftar Wisata -->
                        <a href="{{ route('admin.penduduk') }}">
							<p style="font-size: 18px; text-decoration: underline; margin-top:10px">Back</p>
						</a>	
					<div class="d-flex justify-content-between align-items-center">
						<h4 class="page-title mt-1">Tambah Data Penduduk</h4>
					</div>		
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-body">
                                        <div class="row">
                                            <div class="col col-md-4 text-center mt-3">
                                                <img src="{{ asset('img/dummy-man.png') }}" alt="" width="300" height="300">
												<button type="button" class="btn btn-primary mb-4 mt-3" data-bs-toggle="modal" data-bs-target="#modalTambah_wisata">Tambah Gambar</button>
											</div>
                                            <div class="col col-md-8">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    @csrf
													<h5 class="ml-2 mt-3"><strong>Data Diri</strong></h5>
                                                    <div class="form-group row">
														<div class="col col-md-4">
                                                        	<label for="nik">Nomor Induk Kependudukan</label>
                                                        	<input type="text" class="form-control" name="nik" id="nik" value="" required>
															<!-- <div class="form-check">
																<input type="checkbox" class="form-check-input" id="hasNik" onchange="toggleNikInput()">
																<label class="form-check-label" for="hasNik">Sudah Memiliki NIK?</label>
															</div> -->
														</div>
														<div class="col-md-8">
                                                        	<label for="nama_lengkap">Nama Lengkap</label>
                                                        	<input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="" required>
														</div>
													</div>
													<div class="form-group row">
														<div class="col col-md-4"> <!-- Jenis Kelamin -->
                                                    	    <label for="jenis_kelamin">Jenis Kelamin</label>
                                                    	    <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" value="" required>
                                                    	</div>
														<div class="col col-md-4"> <!-- Tempat Lahir -->
                                                    	    <label for="tempat_lahir">Tempat Lahir</label>
                                                    	    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="" required>
                                                    	</div>
                                                    	<div class="col col-md-4"> <!-- Tanggal Lahir -->
                                                    	    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    	    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="" required>
                                                    	</div>
													</div>
                                                   	<div class="form-group row">
                                                    	<div class="col col-md-8"> <!-- Alamat -->
                                                    	    <label for="alamat">Alamat</label>
                                                    	    <input type="text" class="form-control" name="alamat" id="alamat" value="" required>
                                                    	</div>
                                                    	<div class="col col-md-4"> <!-- Wilayah -->
                                                    	    <label for="wilayah">Wilayah</label>
                                                    	    <input type="text" class="form-control" name="wilayah" id="wilayah" value="" required>
                                                    	</div>
													</div>
													<div class="form-group row">
                                                    	<div class="col col-md-4"> <!-- Agama -->
                                                    	    <label for="agama">Agama</label>
                                                    	    <input type="text" class="form-control" name="agama" id="agama" value="" required>
                                                    	</div>
                                                    	<div class="col col-md-4"> <!-- Pendidikan -->
                                                    	    <label for="pekerjaan">Pekerjaan</label>
                                                    	    <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="" required>
                                                    	</div>
														<div class="col col-md-4">
                                                    		<label for="pendidikan">Pendidikan</label>
                                                    		<input type="text" class="form-control" name="pendidikan" id="pendidikan" value="" required>
														</div>
													</div>
													<div class="form-group row">
														<div class="col col-md-4">
															<label for="suku_etnis">Suku/Etnis</label>
															<input type="text" class="form-control" name="suku_etnis" id="suku_etnis" value="" required>
														</div>
														<div class="col col-md-4">
															<label for="no_telp">Nomor Telepon</label>
															<input type="text" class="form-control" name="no_telp" id="no_telp" value="" required>
														</div>
														<div class="col col-md-4">
															<label for="email">E-mail</label>
															<input type="email" class="form-control" name="email" id="email" value="" required>
														</div>
													</div>

													<h5 class="ml-2 mt-5"><strong>Data Kelahiran</strong></h5>
													<div class="form-group row">
														<div class="col col-md-4">
															<label for="no_akta_lahir">No. Akta Lahir</label>
															<input type="text" class="form-control" name="no_akta_lahir" id="no_akta_lahir" value="" required>
														</div>
														<div class="col col-md-4">
															<label for="waktu_kelahiran">Waktu Kelahiran</label>
															<input type="time" class="form-control" name="waktu_kelahiran" id="waktu_kelahiran" value="" required>
														</div>
														<div class="col col-md-4">
															<label for="tempat_dilahirkan">Tempat Dilahirkan</label>
															<input type="text" class="form-control" name="tempat_dilahirkan" id="tempat_dilahirkan" value="" required>
														</div>
													</div>
													<div class="form-group row">
														<div class="col col-md-3">
															<label for="jenis_kelahiran">Jenis Kelahiran</label>
															<input type="text" class="form-control" name="jenis_kelahiran" id="jenis_kelahiran" value="" required>
														</div>
														<div class="col col-md-3">
															<label for="anak_ke">Anak Ke</label>
															<input type="number" class="form-control" name="anak_ke" id="anak_ke" value="" required>
														</div>
														<div class="col col-md-3">
															<label for="berat_lahir">Berat Lahir (gram)</label>
															<input type="number" class="form-control" name="berat_lahir" id="berat_lahir" value="" required>
														</div>
														<div class="col col-md-3">
															<label for="panjang_lahir">Panjang Lahir (cm)</label>
															<input type="number" class="form-control" name="panjang_lahir" id="panjang_lahir" value="" required>
														</div>
													</div>

													<h5 class="ml-2 mt-5"><strong>Data Keluarga</strong></h5>
													<div class="form-group row">
														<div class="col col-md-6">
															<label for="no_kk">No. KK</label>
															<input type="text" class="form-control" name="no_kk" id="no_kk" value="" required>
														</div>
														<div class="col col-md-6">
															<label for="hub_keluarga">Hubungan Dalam Keluarga</label>
															<input type="text" class="form-control" name="hub_keluarga" id="hub_keluarga" value="" required>
														</div>
													</div>
													<div class="form-group row">
														<div class="col col-md-4">
															<label for="nik_ayah">NIK Ayah</label>
															<input type="text" class="form-control" name="nik_ayah" id="nik_ayah" value="" required>
														</div>
														<div class="col col-md-8">
															<label for="nama_ayah">Nama Ayah</label>
															<input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="" required>
														</div>
													</div>
													<div class="form-group row">
														<div class="col col-md-4">
															<label for="nik_ibu">NIK Ibu</label>
															<input type="text" class="form-control" name="nik_ibu" id="nik_ibu" value="" required>
														</div>
														<div class="col col-md-8">
															<label for="nama_ibu">Nama Ibu</label>
															<input type="text" class="form-control" name="nama_ibu" id="nama_ibu" value="" required>
														</div>
													</div>

													<h5 class="ml-2 mt-5"><strong>Data Kewarganegaraan</strong></h5>
													<div class="form-group row">
														<div class="col col-md-4">
															<label for="status_wn">Status Warga Negara</label>
															<input type="text" class="form-control" name="status_wn" id="status_wn" value="" required>
														</div>
														<div class="col col-md-4">
															<label for="no_paspor">Nomor Paspor</label>
															<input type="text" class="form-control" name="no_paspor" id="no_paspor" value="" required>
														</div>
														<div class="col col-md-4">
															<label for="tanggal_paspor">Tanggal Berakhir Paspor</label>
															<input type="text" class="form-control" name="tanggal_paspor" id="tanggal_paspor" value="" required>
														</div>
													</div>
													<div class="form-group row">
														<div class="col col-md-4">
															<label for="no_kitas_kitap">Nomor KITAS/KITAP</label>
															<input type="text" class="form-control" name="no_kitas_kitap" id="no_kitas_kitap" value="" required>
														</div>
														<div class="col col-md-4">
															<label for="negara_asal">Negara Asal</label>
															<input type="text" class="form-control" name="negara_asal" id="negara_asal" value="" required>
														</div>
													</div>

													<h5 class="ml-2 mt-5"><strong>Status Perkawinan</strong></h5>
													<div class="form-group row">
														<div class="col col-md-6">
															<label for="status_kawin">Status Perkawinan</label>
															<input type="text" class="form-control" name="status_kawin" id="status_kawin" value="" required>
														</div>
														<div class="col col-md-6">
															<label for="no_akta_nikah">No. Akta Nikah</label>
															<input type="text" class="form-control" name="no_akta_nikah" id="no_akta_nikah" value="" required>
														</div>
													</div>
													<div class="form-group row">
														<div class="col col-md-6">
															<label for="tanggal_nikah">Tanggal Pernikahan (Jika Status Menikah)</label>
															<input type="text" class="form-control" name="tanggal_nikah" id="tanggal_nikah" value="" required>
														</div>
														<div class="col col-md-6">
															<label for="tanggal_cerai">Tanggal Perceraian (Jika Status Cerai)</label>
															<input type="text" class="form-control" name="tanggal_cerai" id="tanggal_cerai" value="" required>
														</div>
													</div>

													<h5 class="ml-2 mt-5"><strong>Data Kesehatan</strong></h5>
													<div class="form-group">
														<label for="golongan_darah">Golongan Darah</label>
														<input type="text" class="form-control" name="golongan_darah" id="golongan_darah" value="" required>
													</div>
													<div class="form-group">
														<label for="riwayat_penyakit">Riwayat Penyakit</label>
														<textarea class="form-control" name="riwayat_penyakit" id="riwayat_penyakit" rows="4"></textarea>
													</div>
													<div class="form-group row">
														<div class="col col-md-4">
															<label for="asuransi_kesehatan">Asuransi Kesehatan</label>
															<input type="text" class="form-control" name="asuransi_kesehatan" id="asuransi_kesehatan" value="" required>
														</div>
														<div class="col col-md-4">
															<label for="no_asuransi">No. Asuransi</label>
															<input type="text" class="form-control" name="no_asuransi" id="no_asuransi" value="" required>
														</div>
														<div class="col col-md-4">
															<label for="no_bpjs_naker">No. BPJS Ketenagakerjaan</label>
															<input type="text" class="form-control" name="no_bpjs_naker" id="no_bpjs_naker" value="" required>
														</div>
													</div>
													<div class="text-end">
														<button type="submit" class="btn btn-primary mt-4">Save changes</button>
													</div>
                                                </form>
                                            </div>
                                        </div>
									</div>
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

</html>