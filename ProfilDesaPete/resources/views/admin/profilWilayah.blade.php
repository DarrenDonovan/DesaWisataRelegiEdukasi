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

		<!-- CKEditor5 -->
		<link rel="stylesheet" href="{{url('../../assets/vendor/ckeditor5.css')}}">

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
					<li class="nav-item active">
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

						@if(Auth::check() && Auth::user()->role==='superadmin')
						<!-- About Us -->
						<div class="d-flex justify-content-between align-items-center mt-4">
							<h4 class="page-title mt-1">About Us</h4>
							<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalEdit_about">Edit Tentang Kami</button>	
						</div>	
							<div class="row">
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<h4 class="card-title text-center mb-1">Gambar</h4>
										</div>
										<div class="card-body">
											<img src="{{ asset('storage/' . $about->gambar_about) }}" width="275" alt="">
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h4 class="card-title text-center mb-1">Bagan Organisasi</h4>
										</div>
										<div class="card-body">
											<img src="{{ asset('storage/' . $about->bagan_organisasi) }}" width="275px" alt="">
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="card">
										<div class="card-header">
											<h4 class="card-title">Konten Kecamatan</h4>
											<p class="card-category">Last Updated {{ $about->name }} at {{ $about->updated_at }}</p>
										</div>
										<div class="card-body">
											<h4 class="card-title">Visi Kecamatan</h4>
											<p>{!! $about->visi !!}</p>
											<h4 class="card-title">Misi Kecamatan</h4>
											<p>{!! $about->misi !!}</p>
										</div>
									</div>
								</div>
							</div>

							<div class="modal fade" id="modalEdit_about" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
   								<div class="modal-dialog">
        							<div class="modal-content">
            							<div class="modal-header">
											<h5 class="modal-title" id="modalTitle">Edit Tentang Kami</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            							</div>
            							<div class="modal-body">
											<form action="{{ route('admin.updateAboutUs') }}" method="post" enctype="multipart/form-data">
												@csrf
												<div class="form-group">
													<label for="visi">Visi</label>
													<textarea name="visi" class="form-control" id="visi" cols="50" rows="4" required>{{ $about->visi }}</textarea>					
												</div>
												<div class="form-group">
													<label for="misi">Misi</label>
													<textarea name="misi" class="form-control" id="misi" cols="50" rows="4" required>{{ $about->misi }}</textarea>					
												</div>
												<div class="form-group">
													<label for="gambar_about">Gambar Kegiatan</label>
													<input type="file" class="form-control-file" name="gambar_about" id="gambar_about">
                								</div>
												<div class="form-group">
													<label for="bagan_organisasi">Bagan Organisasi</label>
													<input type="file" class="form-control-file" name="bagan_organisasi" id="bagan_organisasi">
                								</div>
												<button type="submit" class="btn btn-primary form-control">Save changes</button>
											</form>
								        </div>
								    </div>
								</div>
							</div>
						@endif

						<!-- Profil Desa -->
						@if(Auth::check() && Auth::user()->role==='admin')
						<div class="d-flex justify-content-between align-items-center mt-4">
							<h4 class="page-title mt-1">Profil {{ $wilayaheach->nama_wilayah }}</h4>
							<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalEdit_profil">Edit Profil</button>	
						</div>	
							<div class="row">
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<h4 class="card-title text-center mb-1">Gambar</h4>
											<p class="card-category">Last Updated by {{ $wilayaheach->name }} at {{ $wilayaheach->updated_at }}</p>
										</div>
										<div class="card-body">
											<img src="{{ asset('storage/' . $wilayaheach->gambar_wilayah) }}" width="275" alt="">
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="card">
										<div class="card-header">
											<h4 class="card-title">Konten Profil</h4>
											<p class="card-category">{{ $wilayaheach->nama_wilayah }}</p>
										</div>
										<div class="card-body">
											<h4 class="card-title">Batas Desa</h4>
											<p>Utara : {{ $wilayaheach->batas_utara }}</p>
											<p>Timur: {{ $wilayaheach->batas_timur }}</p>
											<p>Selatan : {{ $wilayaheach->batas_selatan }}</p>
											<p>Barat: {{ $wilayaheach->batas_barat }}</p>
											<p>Luas Wilayah : {{ $wilayaheach->luas_wilayah }} Ha</p>
											<p>Jumlah Penduduk : {{ $data_jenis_kelamin->penduduk_laki + $data_jenis_kelamin->penduduk_perempuan }} Jiwa</p>
										</div>
									</div>
								</div>
							</div>

							<div class="modal fade" id="modalEdit_profil" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
   								<div class="modal-dialog">
        							<div class="modal-content">
            							<div class="modal-header">
											<h5 class="modal-title" id="modalTitle">Edit Tentang Kami</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            							</div>
            							<div class="modal-body">
											<form action="{{ route('admin.updateProfil', $wilayaheach->id_wilayah) }}" method="post" enctype="multipart/form-data">
												@csrf
												<div class="form-group">
													<label for="gambar_wilayah">Gambar Kegiatan</label>
													<input type="file" class="form-control-file" name="gambar_wilayah" id="gambar_wilayah">
                								</div>
												<button type="submit" class="btn btn-primary form-control">Save changes</button>
											</form>
								        </div>
								    </div>
								</div>
							</div>
						@endif

						<!-- Perangkat Kecamatan -->
						<div class="d-flex justify-content-between align-items-center">
							<h4 class="page-title mt-1">Perangkat {{ $wilayaheach->nama_wilayah	}}</h4>
							<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalTambah_perangkat">Tambah Personil</button>	
						</div>		
		  			
						<div class="container-fluid guide">
        				    <div class="container card py-4">
        				        <div class="row g-4">
									@foreach ($perangkat_kecamatan as $perangkat)
        				            <div class="col-md-6 col-lg-3">
        				                <div class="guide-item">
        				                    <div class="guide-img">
        				                        <img src="{{ asset('storage/' . $perangkat->gambar_perangkat) }}" style="height: 300px; width:100%; object-fit:cover" class="img-fluid w-100 rounded-top" alt="Image">
        				                    </div>
        				                    <div class="guide-title text-center rounded-bottom p-2">
        				                        <div class="guide-title-inner" style="height: 200px">
        				                            <h4 class="mt-3">{{ $perangkat->nama }}</h4>
        				                            <p class="mb-3">{{ $perangkat->jabatan }}</p>
													<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate_perangkat{{$perangkat->id_perangkat}}">Edit</a> 
													<a href="{{ route('admin.removePerangkat', $perangkat->id_perangkat) }}" class="btn btn-danger">Remove</a>
													<p class="mt-3">Last Updated by {{ $perangkat->name }} at {{ $perangkat->updated_at }}</p>
        				                        </div>
        				                    </div>

											<!-- Modal Edit perangkat kecamatan -->
											<div class="modal fade" id="modalUpdate_perangkat{{$perangkat->id_perangkat}}" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
   												<div class="modal-dialog">
        											<div class="modal-content">
            											<div class="modal-header">
															<h5 class="modal-title" id="modalTitle">Edit Perangkat Kecamatan</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            											</div>
            											<div class="modal-body">
															<form action="{{ route('admin.updatePerangkat', $perangkat->id_perangkat)}}" method="post" enctype="multipart/form-data">
																@csrf
																<div class="form-group">
																	<label for="nama">Nama</label>
																	<input type="text" class="form-control" name="nama" id="nama" value="{{ $perangkat->nama }}" required>
																</div>
																<div class="form-group">
																	<label for="jabatan">Jabatan</label>
																	<input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ $perangkat->jabatan }}" required>
																</div>
																<div class="form-group">
																	<label for="link_facebook">Link Facebook (Optional)</label>
																	<input type="text" class="form-control" name="link_facebook" id="link_facebook">
																</div>
																<div class="form-group">
																	<label for="link_instagram">Link Instagram (Optional)</label>
																	<input type="text" class="form-control" name="link_instagram" id="link_instagram">
																</div>
																<div class="form-group">
																	<label for="link_tiktok">Link Tiktok (Optional)</label>
																	<input type="text" class="form-control" name="link_tiktok" id="link_tiktok">
																</div>
																<div class="form-group">
																	<label for="gambar_perangkat">Gambar</label>
																	<input type="file" class="form-control-file" name="gambar_perangkat" id="gambar_perangkat">
                												</div>
																</div>
                												<button type="submit" class="btn btn-primary form-control">Save changes</button>
															</form>
						    					        </div>
						    					    </div>
						    					</div>
        				                	</div>
        				            	</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>

						<!-- Modal Tambah Perangkat -->
						<div class="modal fade" id="modalTambah_perangkat" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
   							<div class="modal-dialog">
        						<div class="modal-content">
            						<div class="modal-header">
										<h5 class="modal-title" id="modalTitle">Tambah Perangkat Kecamatan</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            						</div>
            						<div class="modal-body">
										<form action=" {{ route('admin.createPerangkat') }}" method="post" enctype="multipart/form-data">
											@csrf
											<div class="form-group">
												<label for="nama">Nama</label>
												<input type="text" class="form-control" name="nama" id="nama" required>
											</div>
											<div class="form-group">
												<label for="jabatan">Jabatan</label>
												<input type="text" class="form-control" name="jabatan" id="jabatan" required>
											</div>
											<div class="form-group">
												<label for="link_facebook">Link Facebook (Optional)</label>
												<input type="text" class="form-control" name="link_facebook" id="link_facebook">
											</div>
											<div class="form-group">
												<label for="link_instagram">Link Instagram (Optional)</label>
												<input type="text" class="form-control" name="link_instagram" id="link_instagram">
											</div>
											<div class="form-group">
												<label for="link_tiktok">Link Tiktok (Optional)</label>
												<input type="text" class="form-control" name="link_tiktok" id="link_tiktok">
											</div>
											<div class="form-group">
												<label for="gambar_perangkat">Gambar</label>
												<input type="file" class="form-control-file" name="gambar_perangkat" id="gambar_perangkat">
                							</div>
											<button type="submit" class="btn btn-primary form-control">Tambahkan</button>
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
	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
					<p>
						<b>We'll let you know when it's done</b></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace('visi');
	CKEDITOR.replace('misi');
</script>
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