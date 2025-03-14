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

		<!-- TinyMCE -->
		<script src="https://cdn.tiny.cloud/1/jnkfs9zvfl13vly0k5556lcy3znx17cwejz9ng8k3hyk3uau/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

		<script>
		  tinymce.init({
		    selector: '#visi', 
		    plugins: 'code table lists',
		    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
		  });

		  tinymce.init({
		    selector: '#misi', 
		    plugins: 'code table lists',
		    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
		  });

		  tinymce.init({
		    selector: '#konten_berita', 
		    plugins: 'code table lists image',
		    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image'
		  });
		</script>
	</head>
<body>
   <!-- Topbar Start -->
   <div class="container-fluid bg-primary px-5 d-none d-lg-block">
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
	<!-- <div class="wrapper">
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<ul class="nav">
						<li class="nav-item active">
							<a href="{{ url('admin') }}">
								<p>Dashboard</p>
								<span class="badge badge-count">5</span>
							</a>
						</li>
						<li class="nav-item">
								<i class="la la-table"></i>
								<p>Components</p>
								<span class="badge badge-count">14</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="forms.html">
								<i class="la la-keyboard-o"></i>
								<p>Forms</p>
								<span class="badge badge-count">50</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="tables.html">
								<i class="la la-th"></i>
								<p>Tables</p>
								<span class="badge badge-count">6</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="notifications.html">
								<i class="la la-bell"></i>
								<p>Notifications</p>
								<span class="badge badge-success">3</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="typography.html">
								<i class="la la-font"></i>
								<p>Typography</p>
								<span class="badge badge-danger">25</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="icons.html">
								<i class="la la-fonticons"></i>
								<p>Icons</p>
							</a>
						</li>
						<li class="nav-item update-pro">
							<button  data-toggle="modal" data-target="#modalUpdate">
								<i class="la la-hand-pointer-o"></i>
								<p>Update To Pro</p>
							</button>
						</li>
					</ul>
				</div>
			</div> -->

			<div class="main-panel">
					<div class="container-fluid">
						@if (Session::has('message'))
							<p class="alert alert-success mt-2">{{ Session::get('message') }}</p>
						@endif
						
						<!-- Kegiatan Terbaru -->
						<h4 class="page-title mt-2">Kegiatan Terbaru</h4>
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-body">
										<table class="table table-striped mt-3">
											<thead>
												<tr>
													<th scope="col">Nama Kegiatan</th>
													<th scope="col">Jenis Kegiatan</th>
													<th scope="col">Nama Wilayah</th>
													<th scope="col">Keterangan</th>
													<th scope="col">Gambar Kegiatan</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@if($kegiatanterbaru)
        										<tr>
            										<td>{{ $kegiatanterbaru->nama_kegiatan }}</td>
													<td>{{ $kegiatanterbaru->nama_jenis_kegiatan }}</td>
													<td>{{ $kegiatanterbaru->nama_wilayah }}</td>
            										<td>{{ $kegiatanterbaru->keterangan }}</td>
            										<td>
                									@if ($kegiatanterbaru->gambar_kegiatan)
                									    <img src="{{ asset('storage/' . $kegiatanterbaru->gambar_kegiatan) }}" width="100" alt="">
                									@else
                									    Tidak ada gambar
                									@endif
													</td>
													<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalKegiatan_terbaru">Edit</a></td>
												</tr>
												@endif
											</tbody>
										</table>
									</div>
								</div>
							
								<!-- Modal Kegiatan Terbaru -->
								<div class="modal fade" id="modalKegiatan_terbaru" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
   									<div class="modal-dialog">
        								<div class="modal-content">
            								<div class="modal-header">
												<h5 class="modal-title" id="modalTitle">Edit Kegiatan Terbaru</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            								</div>
            								<div class="modal-body">
												<form action="{{ route('admin.updateKegiatan', $kegiatanterbaru->id_kegiatan)}}" method="post" enctype="multipart/form-data">
													@csrf
													<div class="form-group">
														<label for="nama_kegiatan">Nama Kegiatan</label>
														<input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" value="{{ $kegiatanterbaru->nama_kegiatan }}" required>
													</div>
													<div class="form-group">
														<label for="jenis_kegiatan">Jenis Kegiatan</label>
														<select name="jenis_kegiatan" class="form-control" required>
														    <option value="">-- Pilih Jenis Kegiatan --</option>
														    @foreach ($jenis_kegiatan as $item)
														        <option value="{{ $item->id_jenis_kegiatan }}" 
																{{ $item->id_jenis_kegiatan == $kegiatanterbaru->id_jenis_kegiatan ? 'selected' :'' }}>
																{{ $item->nama_jenis_kegiatan }}
																</option>
														    @endforeach
														</select>
													</div>
													<div class="form-group">
														<label for="nama_wilayah">Nama Wilayah</label>
														<select name="nama_wilayah" class="form-control" required>
														    <option value="">-- Pilih Wilayah --</option>
														    @foreach ($wilayah as $itemWilayah)
														        <option value="{{ $itemWilayah->id_wilayah }}" 
																{{ $itemWilayah->id_wilayah == $kegiatanterbaru->id_wilayah ? 'selected' :'' }}>
																{{ $itemWilayah->nama_wilayah }}
																</option>
														    @endforeach
														</select>
													</div>
													<div class="form-group">
														<label for="keterangan">Keterangan</label>
														<textarea name="keterangan" class="form-control" id="keterangan" cols="50" rows="4" required>{{ $kegiatanterbaru->keterangan }}</textarea>					
													</div>
													<div class="form-group">
														<label for="gambar_kegiatan">Gambar Kegiatan</label>
														<input type="file" class="form-control-file" name="gambar_kegiatan" id="gambar_kegiatan">
                									</div>
													<button type="submit" class="btn btn-primary form-control">Save changes</button>
												</form>
								            </div>
								        </div>
								    </div>
								</div>

					<!-- Daftar Kegiatan -->
					<div class="d-flex justify-content-between align-items-center">
						<h4 class="page-title mt-1">Daftar Kegiatan</h4>
						<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalTambah_kegiatan">Tambah Kegiatan</button>	
					</div>				
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-body">
										<table class="table table-striped mt-3">
											<thead>
												<tr>
													<th scope="col">Nama Kegiatan</th>
													<th scope="col">Jenis Kegiatan</th>
													<th scope="col">Nama Wilayah</th>
													<th scope="col">Keterangan</th>
													<th scope="col">Gambar Kegiatan</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
    										@foreach ($kegiatan as $items)
        										<tr>
            										<td>{{ $items->nama_kegiatan }}</td>
													<td>{{ $items->nama_jenis_kegiatan }}</td>
													<td>{{ $items->nama_wilayah }}</td>
            										<td>{{ $items->keterangan }}</td>
            										<td>
                									@if ($items->gambar_kegiatan)
                									    <img src="{{ asset('storage/' . $items->gambar_kegiatan) }}" width="100" alt="">
                									@else
                									    Tidak ada gambar
                									@endif
													</td>
													<td><a href="#" data-bs-toggle="modal" data-bs-target="#myModal{{$items->id_kegiatan}}">Edit</a> | <a href="{{route('admin.deleteKegiatan', $items->id_kegiatan)}}">Hapus</a></td>
												</tr>

												<!-- Modal Edit Kegiatan -->
												<div class="modal fade" id="myModal{{$items->id_kegiatan}}" tabindex="-1" aria-labelledby="modalTitle{{$items->id_kegiatan}}" aria-hidden="true">
   													<div class="modal-dialog">
        												<div class="modal-content">
            												<div class="modal-header">
																<h5 class="modal-title" id="modalTitle">Edit Kegiatan Terbaru</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            												</div>
            												<div class="modal-body">
																<form action="{{ route('admin.updateKegiatan', $items->id_kegiatan)}}" method="post" enctype="multipart/form-data">
																	@csrf
																	<div class="form-group">
																		<label for="nama_kegiatan">Nama Kegiatan</label>
																		<input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" value="{{ $items->nama_kegiatan }}" required>
																	</div>
																	<div class="form-group">
																		<label for="jenis_kegiatan">Jenis Kegiatan</label>
																		<select name="jenis_kegiatan" class="form-control" required>
														    				<option value="">-- Pilih Jenis Kegiatan --</option>
														    				@foreach ($jenis_kegiatan as $jenis)
														    				    <option value="{{ $jenis->id_jenis_kegiatan }}" 
																				{{ $jenis->id_jenis_kegiatan == $items->id_jenis_kegiatan ? 'selected' : '' }}>
																				{{ $jenis->nama_jenis_kegiatan }}
																				</option>
														    				@endforeach
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="nama_wilayah">Nama Wilayah</label>
																		<select name="nama_wilayah" class="form-control" required>
														    				<option value="">-- Pilih Wilayah --</option>
														    				@foreach ($wilayah as $itemWilayah)
														    				    <option value="{{ $itemWilayah->id_wilayah }}" 
																				{{ $itemWilayah->id_wilayah == $items->id_wilayah ? 'selected' : '' }}>
																				{{ $itemWilayah->nama_wilayah }}
																				</option>
														    				@endforeach
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="keterangan">Keterangan</label>
																		<textarea name="keterangan" class="form-control" id="keterangan" cols="50" rows="4" required>{{ $items->keterangan }}</textarea>
																	</div>
																	<div class="form-group">					
																		<label for="gambar_kegiatan">Gambar Kegiatan</label>
																		<input type="file" name="gambar_kegiatan" id="gambar_kegiatan" class="form-control-file">
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
										{{ $kegiatan->links() }}
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal Tambah Kegiatan -->
						<div class="modal fade" id="modalTambah_kegiatan" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
   							<div class="modal-dialog">
        						<div class="modal-content">
            						<div class="modal-header">
										<h5 class="modal-title" id="modalTitle">Tambah Kegiatan Terbaru</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            						</div>
            						<div class="modal-body">
										<form action=" {{ route('admin.createKegiatan') }}" method="post" enctype="multipart/form-data">
											@csrf
											<div class="form-group">
												<label for="nama_kegiatan">Nama Kegiatan</label>
												<input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" required>
											</div>
											<div class="form-group">
												<label for="jenis_kegiatan">Jenis Kegiatan</label>
												<select name="jenis_kegiatan" class="form-control" required>
												    <option value="">-- Pilih Jenis Kegiatan --</option>
												    @foreach ($jenis_kegiatan as $item)
												        <option value="{{ $item->id_jenis_kegiatan }}">{{ $item->nama_jenis_kegiatan }}</option>
												    @endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="nama_wilayah">Nama Wilayah</label>
												<select name="nama_wilayah" class="form-control" required>
												    <option value="">-- Pilih Wilayah --</option>
												    @foreach ($wilayah as $item)
												        <option value="{{ $item->id_wilayah }}">{{ $item->nama_wilayah }}</option>
												    @endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="keterangan">Keterangan</label>
												<textarea name="keterangan" class="form-control" id="keterangan" cols="50" rows="4" required></textarea>					
											</div>
											<div class="form-group">
												<label for="gambar_kegiatan">Gambar Kegiatan</label>
												<input type="file" class="form-control-file" name="gambar_kegiatan" id="gambar_kegiatan">
                							</div>
											<button type="submit" class="btn btn-primary form-control">Tambahkan</button>
										</form>
						            </div>
						        </div>
						    </div>
						</div>

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
											<img src="{{ asset('storage/' . $about->gambar_about) }}" width="275" alt="">
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h4 class="card-title text-center mb-1">Bagan Organisasi</h4>
											<img src="{{ asset('storage/' . $about->bagan_organisasi) }}" width="275px" alt="">
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="card">
										<div class="card-header">
											<h4 class="card-title">Konten Kecamatan</h4>
											<p class="card-category">Visi dan Misi</p>
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

						<!-- Perangkat Kecamatan -->
						<div class="d-flex justify-content-between align-items-center">
							<h4 class="page-title mt-1">Perangkat Kecamatan</h4>
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
        				                        <div class="guide-title-inner" style="height: 150px">
        				                            <h4 class="mt-3">{{ $perangkat->nama }}</h4>
        				                            <p class="mb-3">{{ $perangkat->jabatan }}</p>
													<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate_perangkat{{$perangkat->id_perangkat}}">Edit</a> 
													<a href="{{ route('admin.removePerangkat', $perangkat->id_perangkat) }}" class="btn btn-danger">Remove</a>
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

				<!-- Berita -->
					<div class="d-flex justify-content-between align-items-center">
						<h4 class="page-title mt-1">Daftar Berita</h4>
						<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalTambah_berita">Tambah Berita</button>	
					</div>				
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-body">
										<table class="table table-striped mt-3">
											<thead>
												<tr>
													<th scope="col">Judul</th>
													<th scope="col">Penulis</th>
													<th scope="col">Tanggal</th>
													<th scope="col">Konten</th>
													<th scope="col">Thumbnail</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
    										@foreach ($berita as $itemBerita)
        										<tr>
            										<td>{{ $itemBerita->judul_berita }}</td>
													<td>{{ $itemBerita->penulis_berita }}</td>
													<td>{{ $itemBerita->tanggal_berita }}</td>
            										<td>{!! Str::limit($itemBerita->konten_berita, 40, '...') !!}</td>
													@if($itemBerita->gambar_berita)
													<td><img src="{{ asset('storage/' . $itemBerita->gambar_berita) }}" width="100" alt=""></td>
													@else
													Tidak ada gambar
													@endif
													<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalView_Berita{{$itemBerita->id_berita}}">View</a> | <a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate_Berita{{$itemBerita->id_berita}}">Edit</a> | <a href="{{ route('admin.deleteBerita', $itemBerita->id_berita) }}">Hapus</a></td>
												</tr>

		  										<!-- Modal View Berita -->
		  										<div class="modal fade" id="modalView_Berita{{$itemBerita->id_berita}}" tabindex="-1" aria-labelledby="modalTitle{{$itemBerita->id_berita}}" aria-hidden="true">
   													<div class="modal-dialog">
        												<div class="modal-content">
            												<div class="modal-header">
																<h5 class="modal-title" id="modalTitle">Detail Berita</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            												</div>
            												<div class="modal-body">
															<div>
                                							    <p class="mb-3">Posted By: {{ $itemBerita->penulis_berita }}</p>
																<p class="mb-3">Tanggal: {{ $itemBerita->tanggal_berita }}</p>
                                							    <p class="mb-3">{{ $itemBerita->judul_berita }}</p>
                                							    <p class="my-3">{!! $itemBerita->konten_berita !!}</p>
                                							</div>
															</div>
												        </div>
												    </div>
												</div>

												<!-- Modal Edit Berita -->
												<div class="modal fade" id="modalUpdate_Berita{{$itemBerita->id_berita}}" tabindex="-1" aria-labelledby="modalTitle{{$itemBerita->id_berita}}" aria-hidden="true">
   													<div class="modal-dialog">
        												<div class="modal-content">
            												<div class="modal-header">
																<h5 class="modal-title" id="modalTitle">Edit Berita</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            												</div>
            												<div class="modal-body">
																<form action="{{ route('admin.updateBerita', $itemBerita->id_berita) }}" method="post" enctype="multipart/form-data">
																	@csrf
																	<div class="form-group">
																		<label for="judul_berita">Judul Berita</label>
																		<input type="text" class="form-control" name="judul_berita" id="judul_berita" value="{{ $itemBerita->judul_berita }}" required>
																	</div>
																	<div class="form-group">
																		<label for="penulis_berita">Penulis Berita</label>
																		<input type="text" name="penulis_berita" class="form-control" id="penulis_berita" value="{{ $itemBerita->penulis_berita }}" required></textarea>
																	</div>
																	<div class="form-group">
																		<label for="tanggal_berita">Tanggal Berita</label>
																		<input type="date" name="tanggal_berita" class="form-control" id="tanggal_berita" value="{{ $itemBerita->tanggal_berita }}" required></textarea>
																	</div>
																	<div class="form-group">
																		<label for="nama_wilayah">Nama Wilayah</label>
																		<select name="nama_wilayah" class="form-control" required>
														    				<option value="">-- Pilih Wilayah --</option>
														    				@foreach ($wilayah as $itemsWilayah)
														    				    <option value="{{ $itemsWilayah->id_wilayah }}" 
																				{{ $itemsWilayah->id_wilayah == $itemBerita->id_wilayah ? 'selected' : '' }}>
																				{{ $itemsWilayah->nama_wilayah }}
																				</option>
														    				@endforeach
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="gambar_berita">Thumbnail</label>
																		<input type="file" class="form-control-file" name="gambar_berita" id="gambar_berita">
                													</div>
																	<div class="form-group">
		  																<label for="konten_berita">Konten Berita</label>
																		<textarea name="konten_berita" id="konten_berita" class="form-control" rows="4" cols="50">{!! $itemBerita->konten_berita !!}</textarea>
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
										{{ $berita->links() }}
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal Tambah Berita -->
						<div class="modal fade" id="modalTambah_berita" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
   							<div class="modal-dialog">
        						<div class="modal-content">
            						<div class="modal-header">
										<h5 class="modal-title" id="modalTitle">Tambah Berita</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            						</div>
            						<div class="modal-body">
										<form action="{{ route('admin.createBerita') }}" method="post" enctype="multipart/form-data">
											@csrf
											<div class="form-group">
												<label for="judul_berita">Judul Berita</label>
												<input type="text" class="form-control" name="judul_berita" id="judul_berita" required>
											</div>
											<div class="form-group">
												<label for="penulis_berita">Penulis Berita</label>
												<input type="text" name="penulis_berita" class="form-control" id="penulis_berita" required></textarea>
											</div>
											<div class="form-group">
												<label for="tanggal_berita">Tanggal Berita</label>
												<input type="date" name="tanggal_berita" class="form-control" id="tanggal_berita" required></textarea>
											</div>
											<div class="form-group">
												<label for="nama_wilayah">Nama Wilayah</label>
												<select name="nama_wilayah" class="form-control" required>
												    <option value="">-- Pilih Wilayah --</option>
												    @foreach ($wilayah as $item)
												        <option value="{{ $item->id_wilayah }}">{{ $item->nama_wilayah }}</option>
												    @endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="gambar_berita">Thumbnail</label>
												<input type="file" class="form-control-file" name="gambar_berita" id="gambar_berita">
                							</div>
											<div class="form-group">
		  										<label for="konten_berita">Konten Berita</label>
												<textarea name="konten_berita" id="konten_berita" class="form-control" rows="4" cols="50"></textarea>
											</div>
											<button type="submit" class="btn btn-primary form-control">Tambahkan</button>
										</form>
						            </div>
						        </div>
						    </div>
						</div>

					<!-- Edit Chart Data -->
					<!-- Barchart Jumlah Penduduk -->
					<div class="d-flex justify-content-between align-items-center">
						<h4 class="page-title mt-1">Infografis</h4>
					</div>	
					@if(Auth::check() && Auth::user()->role==='superadmin')
					<!-- Chart Jumlah Penduduk di Kecamatan -->
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">BarChart Jumlah Penduduk Kecamatan Tigaraksa</h4>
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
												<tr>
													<th>Action</th>
            										@foreach ($jumlah_penduduk as $jumlahPenduduk)
            											<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate_JumlahPenduduk{{$jumlahPenduduk->id_wilayah}}">Edit</a></td>
														</td>
														<!-- Modal Edit Jumlah Penduduk -->
														<div class="modal fade" id="modalUpdate_JumlahPenduduk{{$jumlahPenduduk->id_wilayah}}" tabindex="-1" aria-labelledby="modalTitle{{$jumlahPenduduk->id_wilayah}}" aria-hidden="true">
   															<div class="modal-dialog">
        														<div class="modal-content">
            														<div class="modal-header">
																		<h5 class="modal-title" id="modalTitle">Edit Jumlah Penduduk</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            														</div>
            														<div class="modal-body">
																		<form action="{{ route('admin.updateJumlahPenduduk', $jumlahPenduduk->id_wilayah) }}" method="post" enctype="multipart/form-data">
																			@csrf
																			<div class="form-group">
																				<label for="nama_wilayah">Nama Wilayah</label>
																				<input type="text" class="form-control" name="nama_wilayah" id="nama_wilayah" value="{{ $jumlahPenduduk->nama_wilayah }}" disabled>
																			</div>
																			<div class="form-group">
																				<label for="jumlah_penduduk">Jumlah Penduduk</label>
																				<input type="text" class="form-control" name="jumlah_penduduk" id="jumlah_penduduk" value="{{ $jumlahPenduduk->jumlah_penduduk }}" required>
                															</div>
                															<button type="submit" class="btn btn-primary form-control">Save changes</button>
																		</form>
														            </div>
														        </div>
														    </div>
														</div>
													@endforeach
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- Chart Jumlah Dusun di Kecamatan -->
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">BarChart Jumlah Dusun Kecamatan Tigaraksa</h4>
									</div>
									<div class="card-body">
										<canvas id="Chart2"></canvas>
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
													<th>Nama Dusun</th>
													@foreach ($jumlah_dusun as $jumlahDusun)
            											<td>{{ $jumlahDusun->nama_wilayah }}</td>
													@endforeach
												</tr>
												<tr>
													<th>Jumlah Dusun</th>
            										@foreach ($jumlah_dusun as $jumlahDusun)
            											<td>{{ $jumlahDusun->jumlah_dusun }}</td>
													@endforeach
												</tr>
												<tr>
													<th>Action</th>
            										@foreach ($jumlah_dusun as $jumlahDusun)
            											<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate_JumlahDusun{{$jumlahDusun->id_wilayah}}">Edit</a></td>
														</td>
														<!-- Modal Edit Jumlah Penduduk -->
														<div class="modal fade" id="modalUpdate_JumlahDusun{{$jumlahDusun->id_wilayah}}" tabindex="-1" aria-labelledby="modalTitle{{$jumlahDusun->id_wilayah}}" aria-hidden="true">
   															<div class="modal-dialog">
        														<div class="modal-content">
            														<div class="modal-header">
																		<h5 class="modal-title" id="modalTitle">Edit Jumlah Dusun</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            														</div>
            														<div class="modal-body">
																		<form action="{{ route('admin.updateJumlahDusun', $jumlahDusun->id_wilayah) }}" method="post" enctype="multipart/form-data">
																			@csrf
																			<div class="form-group">
																				<label for="nama_wilayah">Nama Wilayah</label>
																				<input type="text" class="form-control" name="nama_wilayah" id="nama_wilayah" value="{{ $jumlahDusun->nama_wilayah }}" disabled>
																			</div>
																			<div class="form-group">
																				<label for="jumlah_dusun">Jumlah Dusun</label>
																				<input type="text" class="form-control" name="jumlah_dusun" id="jumlah_dusun" value="{{ $jumlahDusun->jumlah_dusun }}" required>
                															</div>
                															<button type="submit" class="btn btn-primary form-control">Save changes</button>
																		</form>
														            </div>
														        </div>
														    </div>
														</div>
													@endforeach
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						@endif

						@if(Auth::check() && Auth::user()->role==='admin')
						<!-- Chart Jumlah Penduduk di Dusun setiap wilayah -->
						<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">BarChart Jumlah Penduduk Dusun di {{ $wilayaheach->nama_wilayah }}</h4>
									</div>
									<div class="card-body">
										<canvas id="Chart7"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Tabel Data Jumlah Penduduk Dusun di {{ $wilayaheach->nama_wilayah }}</h4>
									</div>
									<div class="card-body">
										<table class="table table-striped mt-3">
											<thead>
												<tr>
													<th scope="col">Nama Dusun</th>
													<th scope="col">Jumlah Penduduk</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($jumlah_dusun_per_wilayah as $dusunPerWilayah)
        										<tr>
            										<td>{{ $dusunPerWilayah->nama_dusun }}</td>
													<td>{{ $dusunPerWilayah->jumlah_penduduk }}</td>
													<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate_dusunPerWilayah{{$dusunPerWilayah->id_dusun}}">Edit</a></td>
													<!-- Modal Edit Kelompok Umur -->
													<div class="modal fade" id="modalUpdate_dusunPerWilayah{{$dusunPerWilayah->id_dusun}}" tabindex="-1" aria-labelledby="modalTitle{{$dusunPerWilayah->id_dusun}}" aria-hidden="true">
   														<div class="modal-dialog">
        													<div class="modal-content">
            													<div class="modal-header">
																	<h5 class="modal-title" id="modalTitle">Edit Dusun Per Wilayah</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            													</div>
            													<div class="modal-body">
																	<form action="{{ route('admin.updateDusunPerWilayah', $dusunPerWilayah->id_dusun) }}" method="post" enctype="multipart/form-data">
																		@csrf
																		<div class="form-group">
																			<label for="nama_dusun">Nama Dusun</label>
																			<input type="text" class="form-control" name="nama_dusun" id="nama_dusun" value="{{ $dusunPerWilayah->nama_dusun}}" disabled>
																		</div>
																		<div class="form-group">
																			<label for="jumlah_penduduk">Jumlah Penduduk</label>
																			<input type="text" class="form-control" name="jumlah_penduduk" id="jumlah_penduduk" value="{{ $dusunPerWilayah->jumlah_penduduk }}" required>
                														</div>
                														<button type="submit" class="btn btn-primary form-control">Save changes</button>
																	</form>
													            </div>
													        </div>
													    </div>
													</div>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						@endif
							
							<!-- Sebaran Penduduk berdasarkan kelompok umur -->
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Sebaran Penduduk Berdasarkan Kelompok Umur</h4>
									</div>
									<div class="card-body">
										<canvas id="Chart3"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Tabel Data Penduduk Berdasarkan Kelompok Umur</h4>
									</div>
									<div class="card-body">
										<table class="table table-striped mt-3">
											<thead>
												<tr>
													<th scope="col">Kelompok Umur</th>
													<th scope="col">Jumlah Penduduk</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($kel_umur_penduduk as $kelompok_umur)
        										<tr>
            										<td>{{ $kelompok_umur->kelompok_umur }}</td>
													<td>{{ $kelompok_umur->jumlah_orang }}</td>
													<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate_KelompokUmur{{$kelompok_umur->id}}">Edit</a></td>
													<!-- Modal Edit Kelompok Umur -->
													<div class="modal fade" id="modalUpdate_KelompokUmur{{$kelompok_umur->id}}" tabindex="-1" aria-labelledby="modalTitle{{$kelompok_umur->id}}" aria-hidden="true">
   														<div class="modal-dialog">
        													<div class="modal-content">
            													<div class="modal-header">
																	<h5 class="modal-title" id="modalTitle">Edit Kelompok Umur</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            													</div>
            													<div class="modal-body">
																	<form action="{{ route('admin.updateKelompokUmur', $kelompok_umur->id) }}" method="post" enctype="multipart/form-data">
																		@csrf
																		<div class="form-group">
																			<label for="kelompok_umur">Kelompok Umur</label>
																			<input type="text" class="form-control" name="kelompok_umur" id="kelompok_umur" value="{{ $kelompok_umur->kelompok_umur}}" disabled>
																		</div>
																		<div class="form-group">
																			<label for="jumlah_penduduk">Jumlah Penduduk</label>
																			<input type="text" class="form-control" name="jumlah_penduduk" id="jumlah_penduduk" value="{{ $kelompok_umur->jumlah_orang }}" required>
                														</div>
                														<button type="submit" class="btn btn-primary form-control">Save changes</button>
																	</form>
													            </div>
													        </div>
													    </div>
													</div>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
		  					
							<!-- Sebaran Penduduk berdasarkan pekerjaan -->
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Sebaran Penduduk Berdasarkan Pekerjaan</h4>
									</div>
									<div class="card-body">
										<canvas id="Chart4"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Tabel Data Penduduk Berdasarkan Pekerjaan</h4>
									</div>
									<div class="card-body">
										<table class="table table-striped mt-3">
											<thead>
												<tr>
													<th scope="col">Nama Pekerjaan</th>
													<th scope="col">Jumlah Pekerja</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($pekerjaan_penduduk as $pekerjaanPenduduk)
        										<tr>
            										<td>{{ $pekerjaanPenduduk->pekerjaan }}</td>
													<td>{{ $pekerjaanPenduduk->jumlah_pekerja }}</td>
													<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate_pekerjaanPenduduk{{$pekerjaanPenduduk->id}}">Edit</a></td>
													<!-- Modal Edit Kelompok Umur -->
													<div class="modal fade" id="modalUpdate_pekerjaanPenduduk{{$pekerjaanPenduduk->id}}" tabindex="-1" aria-labelledby="modalTitle{{$pekerjaanPenduduk->id}}" aria-hidden="true">
   														<div class="modal-dialog">
        													<div class="modal-content">
            													<div class="modal-header">
																	<h5 class="modal-title" id="modalTitle">Edit Pekerjaan Penduduk</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            													</div>
            													<div class="modal-body">
																	<form action="{{ route('admin.updatePekerjaanPenduduk', $pekerjaanPenduduk->id) }}" method="post" enctype="multipart/form-data">
																		@csrf
																		<div class="form-group">
																			<label for="pekerjaan">Pekerjaan</label>
																			<input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="{{ $pekerjaanPenduduk->pekerjaan}}" disabled>
																		</div>
																		<div class="form-group">
																			<label for="jumlah_pekerja">Jumlah Penduduk</label>
																			<input type="text" class="form-control" name="jumlah_pekerja" id="jumlah_pekerja" value="{{ $pekerjaanPenduduk->jumlah_pekerja }}" required>
                														</div>
                														<button type="submit" class="btn btn-primary form-control">Save changes</button>
																	</form>
													            </div>
													        </div>
													    </div>
													</div>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<!-- Sebaran Penduduk berdasarkan agama -->
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Sebaran Penduduk Berdasarkan Agama</h4>
									</div>
									<div class="card-body">
										<canvas id="Chart5"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Tabel Data Penduduk Berdasarkan Pekerjaan</h4>
									</div>
									<div class="card-body">
										<table class="table table-striped mt-3">
											<thead>
												<tr>
													<th scope="col">Agama</th>
													<th scope="col">Jumlah Penganut</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($agama_penduduk as $agamaPenduduk)
        										<tr>
            										<td>{{ $agamaPenduduk->agama }}</td>
													<td>{{ $agamaPenduduk->jumlah_penganut }}</td>
													<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate_agamaPenduduk{{$agamaPenduduk->id}}">Edit</a></td>
													<!-- Modal Edit Kelompok Umur -->
													<div class="modal fade" id="modalUpdate_agamaPenduduk{{$agamaPenduduk->id}}" tabindex="-1" aria-labelledby="modalTitle{{$agamaPenduduk->id}}" aria-hidden="true">
   														<div class="modal-dialog">
        													<div class="modal-content">
            													<div class="modal-header">
																	<h5 class="modal-title" id="modalTitle">Edit Agama Penduduk</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            													</div>
            													<div class="modal-body">
																	<form action="{{ route('admin.updateAgamaPenduduk', $agamaPenduduk->id) }}" method="post" enctype="multipart/form-data">
																		@csrf
																		<div class="form-group">
																			<label for="agama">Agama</label>
																			<input type="text" class="form-control" name="agama" id="agama" value="{{ $agamaPenduduk->agama}}" disabled>
																		</div>
																		<div class="form-group">
																			<label for="jumlah_penganut">Jumlah Penganut</label>
																			<input type="text" class="form-control" name="jumlah_penganut" id="jumlah_penganut" value="{{ $agamaPenduduk->jumlah_penganut }}" required>
                														</div>
                														<button type="submit" class="btn btn-primary form-control">Save changes</button>
																	</form>
													            </div>
													        </div>
													    </div>
													</div>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<!-- Sebaran Penduduk berdasarkan pendidikan -->
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Sebaran Penduduk Berdasarkan Pendidikan</h4>
									</div>
									<div class="card-body">
										<canvas id="Chart6"></canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Tabel Data Penduduk Berdasarkan Pendidikan</h4>
									</div>
									<div class="card-body">
										<table class="table table-striped mt-3">
											<thead>
												<tr>
													<th scope="col">Tingkat Pendidikan</th>
													<th scope="col">Jumlah Orang</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($pendidikan_penduduk as $pendidikanPenduduk)
        										<tr>
            										<td>{{ $pendidikanPenduduk->pendidikan }}</td>
													<td>{{ $pendidikanPenduduk->jumlah_orang }}</td>
													<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate_pendidikanPenduduk{{$pendidikanPenduduk->id}}">Edit</a></td>
													<!-- Modal Edit Kelompok Umur -->
													<div class="modal fade" id="modalUpdate_pendidikanPenduduk{{$pendidikanPenduduk->id}}" tabindex="-1" aria-labelledby="modalTitle{{$pendidikanPenduduk->id}}" aria-hidden="true">
   														<div class="modal-dialog">
        													<div class="modal-content">
            													<div class="modal-header">
																	<h5 class="modal-title" id="modalTitle">Edit Pendidikan Penduduk</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            													</div>
            													<div class="modal-body">
																	<form action="{{ route('admin.updatePendidikanPenduduk', $pendidikanPenduduk->id) }}" method="post" enctype="multipart/form-data">
																		@csrf
																		<div class="form-group">
																			<label for="pendidikan">Tingkat Pendidikan</label>
																			<input type="text" class="form-control" name="pendidikan" id="pendidikan" value="{{ $pendidikanPenduduk->pendidikan}}" disabled>
																		</div>
																		<div class="form-group">
																			<label for="jumlah_penduduk">Jumlah Penduduk</label>
																			<input type="text" class="form-control" name="jumlah_penduduk" id="jumlah_penduduk" value="{{ $pendidikanPenduduk->jumlah_orang }}" required>
                														</div>
                														<button type="submit" class="btn btn-primary form-control">Save changes</button>
																	</form>
													            </div>
													        </div>
													    </div>
													</div>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>

						</div>
					












				</div>
				<footer class="footer">
					<div class="container-fluid">
						<nav class="pull-left">
							<ul class="nav">
								<li class="nav-item">
									<a class="nav-link" href="http://www.themekita.com">
										ThemeKita
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">
										Help
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="https://themewagon.com/license/#free-item">
										Licenses
									</a>
								</li>
							</ul>
						</nav>
						<div class="copyright ml-auto">
							2018, made with <i class="la la-heart heart text-danger"></i> by <a href="http://www.themekita.com">ThemeKita</a>
						</div>				
					</div>
				</footer>
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
                label: 'Jumlah Dusun',
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
            type: 'bar',
            data: {
              labels: {!! json_encode($pekerjaan_penduduk->pluck('pekerjaan')) !!},
              datasets: [{
                label: 'Jumlah Pekerja',
                data: {!! json_encode($pekerjaan_penduduk->pluck('jumlah_pekerja')) !!},
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
              labels: {!! json_encode($agama_penduduk->pluck('agama')) !!}, 
              datasets: [{
                label: 'Jumlah Penganut',
                data: {!! json_encode($agama_penduduk->pluck('jumlah_penganut')) !!}, 
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
              labels: {!! json_encode($pendidikan_penduduk->pluck('pendidikan')) !!},
              datasets: [{
                label: 'Jumlah Orang',
                data: {!! json_encode($pendidikan_penduduk->pluck('jumlah_orang')) !!},
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

		  const ctx7 = document.getElementById('Chart7');
          new Chart(ctx7, {
            type: 'bar',
            data: {
              labels: {!! json_encode($jumlah_dusun_per_wilayah->pluck('nama_dusun')) !!},
              datasets: [{
                label: 'Jumlah Pekerja',
                data: {!! json_encode($jumlah_dusun_per_wilayah->pluck('jumlah_penduduk')) !!},
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
</html>