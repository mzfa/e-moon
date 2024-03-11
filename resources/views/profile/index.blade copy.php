@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Profile</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile" aria-selected="true">Data Diri</a>
                                        </li>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-toggle="tab" href="#address"
                                            role="tab" aria-controls="address" aria-selected="false">Alamat</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Kontak-tab" data-toggle="tab" href="#Kontak" role="tab"
                                            aria-controls="Kontak" aria-selected="false">Kontak</a>
                                    </li>
                                </ul>
                            </h4>

                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="staticEmail" class="col-sm-12 col-form-label">Nama
                                                    Lengkap</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->nama_pegawai }}" disabled readonly
                                                        id="nama_pegawai" name="nama_pegawai" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="staticEmail" class="col-sm-12 col-form-label">NIP</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" value="{{ $data->nip }}"
                                                        disabled readonly id="nip" name="nip" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="staticEmail" class="col-sm-12 col-form-label">NIK</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" value="{{ $data->nik }}"
                                                        disabled readonly id="nik" name="nik" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="staticEmail" class="col-sm-12 col-form-label">Username</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" value="{{ $data->username }}"
                                                        disabled readonly id="username" name="username" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="staticEmail" class="col-sm-12 col-form-label">Nama
                                                    Bagian</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->nama_bagian }}" disabled readonly id="nama_bagian"
                                                        name="nama_bagian" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="staticEmail" class="col-sm-12 col-form-label">Nama
                                                    Profesi</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->nama_profesi }}" disabled readonly
                                                        id="nama_profesi" name="nama_profesi" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <form action="{{ url('profile/alamat') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="pegawai_id" value="{{ $data->idpeg }}">
                                        <input type="hidden" name="pegawai_detail_id"
                                            value="{{ $data->pegawai_detail_id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label for="staticEmail" class="col-sm-12 col-form-label">Alamat
                                                        Lengkap</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->alamat_lengkap }}" id="alamat_lengkap"
                                                            name="alamat_lengkap" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label for="staticEmail"
                                                        class="col-sm-12 col-form-label">Provinsi</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->provinsi }}" id="provinsi" name="provinsi"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label for="staticEmail"
                                                        class="col-sm-12 col-form-label">Kabupaten/Kota</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->kabupaten }}" id="kabupaten"
                                                            name="kabupaten" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label for="staticEmail"
                                                        class="col-sm-12 col-form-label">Kelurahan</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->kelurahan }}" id="kelurahan"
                                                            name="kelurahan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label for="staticEmail" class="col-sm-12 col-form-label">Kode
                                                        Pos</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->kode_pos }}" id="kode_pos" name="kode_pos"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12"><button class="btn btn-primary w-100 mt-3"
                                                    type="submit">Simpan</button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="Kontak" role="tabpanel" aria-labelledby="Kontak-tab">
                                    <form action="{{ url('profile/kontak') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="pegawai_id" value="{{ $data->idpeg }}">
                                        <input type="hidden" name="pegawai_detail_id"
                                            value="{{ $data->pegawai_detail_id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label for="staticEmail" class="col-sm-12 col-form-label">Telepon
                                                        Pribadi</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->telp_pribadi }}" id="telp_pribadi"
                                                            name="telp_pribadi" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label for="staticEmail" class="col-sm-12 col-form-label">Telp
                                                        Keluarga</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->telp_keluarga }}" id="telp_keluarga"
                                                            name="telp_keluarga" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12"><button class="btn btn-primary w-100 mt-3"
                                                type="submit">Simpan</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function edit(id) {
            // let filter = $(this).attr('id'); 
            // filter = filter.split("-");
            // var tfilter = $(this).attr('id');
            // console.log(id);
            $.ajax({
                type: 'get',
                url: "{{ url('pendidikan/edit') }}/" + id,
                // data:{'id':id}, 
                success: function(tampil) {

                    // console.log(tampil); 
                    $('#tampildata').html(tampil);
                    $('#editModal').modal('show');
                }
            })
        }
    </script>
@endsection
