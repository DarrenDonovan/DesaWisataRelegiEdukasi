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
					<li class="nav-item active">
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
		  			<!-- Daftar UMKM -->
					<div class="d-flex justify-content-between align-items-center">
						<h4 class="page-title mt-2">Daftar UMKM</h4>
						<button type="button" class="btn btn-primary mb-4 mt-2" data-bs-toggle="modal" data-bs-target="#modalTambah_umkm">Tambah UMKM</button>	
					</div>
					

					<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-body">
										<table class="table table-striped mt-3">
											<thead>
												<tr>
													<th scope="col">Nama UMKM</th>
													<th scope="col">Jenis UMKM</th>
													<th scope="col">Keterangan</th>
													<th scope="col">Gambar UMKM</th>
													<th scope="col">Last Updated</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
    										@foreach ($umkm as $itemUMKM)
        										<tr>
            										<td>{{ $itemUMKM->nama_umkm }}</td>
													<td>{{ $itemUMKM->jenis_umkm }}</td>
            										<td>{{ $itemUMKM->keterangan }}</td>
            										<td>
                									@if ($itemUMKM->gambar_umkm)
                									    <img src="{{ asset('storage/' . $itemUMKM->gambar_umkm) }}" width="100" height="80" alt="">
                									@else
                									    Tidak ada gambar
                									@endif
													</td>
													<td>Last Updated by {{ $itemUMKM->name }} at {{ $itemUMKM->updated_at }}</td>
													<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate_umkm{{$itemUMKM->id_umkm}}">Edit</a> | <a href="{{route('admin.deleteUMKM', $itemUMKM->id_umkm)}}">Hapus</a></td>
												</tr> 

												<!-- Modal Edit Wisata -->
												<div class="modal fade" id="modalUpdate_umkm{{$itemUMKM->id_umkm}}" tabindex="-1" aria-labelledby="modalTitle{{$itemUMKM->id_umkm}}" aria-hidden="true">
   													<div class="modal-dialog">
        												<div class="modal-content">
            												<div class="modal-header">
																<h5 class="modal-title" id="modalTitle">Edit UMKM</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            												</div>
            												<div class="modal-body">
																<form action="{{ route('admin.updateUMKM', $itemUMKM->id_umkm)}}" method="post" enctype="multipart/form-data">
																	@csrf
																	<div class="form-group">
																		<label for="nama_tempat">Nama Tempat UMKM</label>
																		<input type="text" class="form-control" name="nama_umkm" id="nama_umkm" value="{{ $itemUMKM->nama_umkm }}" required>
																	</div>
																	<div class="form-group">
																		<label for="nama_wilayah">Nama Wilayah</label>
																		<select name="nama_wilayah" class="form-control" required>
														    				<option value="">-- Pilih Wilayah --</option>
														    				@foreach ($wilayah as $itemWilayah)
														    				    <option value="{{ $itemWilayah->id_wilayah }}" 
																				{{ $itemWilayah->id_wilayah == $itemWisata->id_wilayah ? 'selected' : '' }}>
																				{{ $itemWilayah->nama_wilayah }}
																				</option>
														    				@endforeach
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="jenis_umkm">Jenis UMKM</label>
																		<select name="jenis_umkm" class="form-control" required>
														    				<option value="">-- Pilih Jenis UMKM --</option>
														    				@foreach ($jenis_umkm as $itemJenisUMKM)
														    				    <option value="{{ $itemJenisUMKM->id_jenis_umkm }}" 
																				{{ $itemJenisUMKM->id_jenis_umkm == $itemUMKM->id_jenis_umkm ? 'selected' : '' }}>
																				{{ $itemJenisUMKM->jenis_umkm }}
																				</option>
														    				@endforeach
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="keterangan">Keterangan</label>
																		<textarea name="keterangan" class="form-control" id="keterangan" cols="50" rows="4" required>{{ $itemUMKM->keterangan }}</textarea>
																	</div>
																	<div class="form-group">					
																		<label for="gambar_wisata">Gambar UMKM</label>
																		<input type="file" name="gambar_umkm" id="gambar_umkm" class="form-control-file">
																	</div>
                													<button type="submit" class="btn btn-primary form-control">Save changes</button>
																</form>
												            </div>
												        </div>
												    </div>
												</div>
												@endforeach
											</tbody>
										</table>
										<div class="mb-4">
										{{ $umkm->links() }}
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal Tambah UMKM (Sementara) -->
						<div class="modal fade" id="modalTambah_umkm" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
   							<div class="modal-dialog">
        						<div class="modal-content">
            						<div class="modal-header">
										<h5 class="modal-title" id="modalTitle">Tambah UMKM Baru</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            						</div>
            						<div class="modal-body">
										<form action=" {{ route('admin.createUMKM') }}" method="post" enctype="multipart/form-data">
											@csrf
											<div class="form-group">
												<label for="nama_umkm">Nama UMKM</label>
												<input type="text" class="form-control" name="nama_umkm" id="nama_umkm" required>
											</div>
											<div class="form-group">
												<label for="nama_wilayah">Nama Wilayah</label>
												<select name="nama_wilayah" class="form-control" required>
												    <option value="">-- Pilih Wilayah --</option>
												    @foreach ($wilayahNoKec as $item)
												        <option value="{{ $item->id_wilayah }}">{{ $item->nama_wilayah }}</option>
												    @endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="jenis_umkm">Jenis UMKM</label>
												<select name="jenis_umkm" class="form-control" required>
													<option value="">-- Pilih Jenis UMKM --</option>
													@foreach ($jenis_umkm as $itemJenisUMKM)
													    <option value="{{ $itemJenisUMKM->id_jenis_umkm }}">{{ $itemJenisUMKM->jenis_umkm }}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="keterangan">Keterangan</label>
												<textarea name="keterangan" class="form-control" id="keterangan" cols="50" rows="4" required></textarea>					
											</div>
											<div class="form-group">
												<label for="gambar_umkm">Gambar Wisata</label>
												<input type="file" class="form-control-file" name="gambar_umkm" id="gambar_umkm">
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