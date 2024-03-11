@extends('layouts.app')

@section('content')
    <div class="main-container container">

        <!-- user information -->
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-auto" >
                        <a onclick="changePicture()">
                            <figure class="avatar avatar-60 rounded-10">
                                <img src="{{ asset('images/profile/'.$data->foto_profile) }}" alt="No Profile">
                            </figure>
                        </a>
                    </div>
                    <div class="col px-0 align-self-center">
                        <h3 class="mb-0 text-color-theme">{{ Auth::user()->name }}</h3>
                        <p class="text-muted">{{ $data->nama_bagian }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row text-center py-2">
                    <ul class="nav nav-pills text-center" id="pills-tab" role="tablist">
                        <li class="nav-item col" role="presentation">
                            <button class="nav-link active w-100" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true"><i class="nav-icon bi bi-person-lines-fill"></i><br> Profile</button>
                        </li>
                        <li class="nav-item col" role="presentation">
                            <button class="nav-link w-100" id="pills-address-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-address" type="button" role="tab" aria-controls="pills-address"
                                aria-selected="false"><i class="nav-icon bi bi-geo-alt-fill"></i><br> Address</button>
                        </li>
                        <li class="nav-item col" role="presentation">
                            <button class="nav-link w-100" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false"><i class="nav-icon bi bi-telephone-inbound-fill"></i><br>Contact</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- profile information -->

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="row mb-3">
                    <div class="col">
                        <h6>Basic Information</h6>
                    </div>
                </div>
                <div class="row h-100 mb-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group form-floating  mb-3">
                            <input type="text" class="form-control" value="{{ $data->nama_pegawai }}" disabled readonly placeholder="Name"
                                id="names">
                            <label for="names">Nama</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group form-floating  mb-3">
                            <input type="text" class="form-control" value="{{ $data->nip }}" disabled readonly placeholder="Name"
                                id="names">
                            <label for="names">NIP</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group form-floating  mb-3">
                            <input type="text" class="form-control" value="{{ $data->nik }}" disabled readonly placeholder="Name"
                                id="names">
                            <label for="names">NIK</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group form-floating  mb-3">
                            <input type="text" class="form-control" value="{{ $data->username }}" disabled readonly placeholder="Name"
                                id="names">
                            <label for="names">Username Login</label>
                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-group form-floating">
                            <input type="file" class="form-control" id="fileupload">
                            <label for="fileupload">Uplaod File</label>
                        </div>
                    </div> --}}
                </div>
                <div class="row h-100 ">
                    <div class="col-12 mb-4">
                        <button type="submit" class="btn btn-default btn-lg w-100">Update</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-address" role="tabpanel" aria-labelledby="pills-address-tab"
                tabindex="0">
                <div class="row mb-3">
                    <div class="col">
                        <h6>Alamat</h6>
                    </div>
                </div>
                <form action="{{ url('profile/alamat') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="form-group form-floating">
                                <input type="text" class="form-control" name="alamat_lengkap" value="{{ $data->alamat_lengkap }}" id="address1"
                                    placeholder="Your Name">
                                <label class="form-control-label" for="address1">Alamat Lengkap</label>
                            </div>
                        </div>
                        <input type="hidden" name="pegawai_id" value="{{ $data->idpeg }}">
                        <input type="hidden" name="pegawai_detail_id" value="{{ $data->pegawai_detail_id }}">
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="form-group form-floating">
                                <input type="text" list="datalistProvinsi" name="provinsi" class="form-control" value="{{ $data->provinsi }}"
                                    id="address4" placeholder="Select Country">
                                <datalist id="datalistProvinsi">
                                    {{-- <option value="DKI Jakarta">
                                    <option value="Jawa Barat"> --}}
                                    @foreach($provinsi as $item)
                                        <option value="{{ $item->provinsi }}">
                                    @endforeach
                                </datalist>
                                <label class="form-control-label" for="address4">Provinsi</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="form-group form-floating">
                                <input type="text" list="datalistKab" name="kabupaten" class="form-control" value="{{ $data->kabupaten }}"
                                    id="address5" placeholder="Select State">
                                <datalist id="datalistKab">
                                    {{-- <option value="Jakarta Utara"> --}}
                                    @foreach($kabupaten as $item)
                                        <option value="{{ $item->kabupaten }}">
                                    @endforeach
                                </datalist>
                                <label class="form-control-label" for="address5">Kab/Kota</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="form-group form-floating">
                                <input type="text" class="form-control" name="kelurahan" value="{{ $data->kelurahan }}" id="address6"
                                    placeholder="Kelurahan">
                                <label class="form-control-label" for="address6">Kelurahan</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="form-group form-floating">
                                <input type="text" class="form-control" name="kode_pos" value="{{ $data->kode_pos }}" id="address7"
                                    placeholder="Kode Pos">
                                <label class="form-control-label" for="address7">Kode Pos</label>
                            </div>
                        </div>
                    </div>
                    <div class="row h-100 ">
                        <div class="col-12 mb-4">
                            <button type="submit" class="btn btn-default btn-lg w-100">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                tabindex="0">
                <div class="row mb-3">
                    <div class="col">
                        <h6>Contact</h6>
                    </div>
                </div>
                <form action="{{ url('profile/kontak') }}" method="post">
                    @csrf
                    <input type="hidden" name="pegawai_id" value="{{ $data->idpeg }}">
                    <input type="hidden" name="pegawai_detail_id" value="{{ $data->pegawai_detail_id }}">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="form-group form-floating">
                                <input type="text" class="form-control" value="{{ $data->telp_pribadi }}" id="telp_pribadi" name="telp_pribadi" placeholder="Telp Pribadi">
                                <label class="form-control-label" for="telp_pribadi">Telp Pribadi</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="form-group form-floating">
                                <input type="text" class="form-control" value="{{ $data->telp_keluarga }}" id="telp_keluarga" name="telp_keluarga" placeholder="Telp keluarga">
                                <label class="form-control-label" for="telp_keluarga">Telp Keluarga</label>
                            </div>
                        </div>
                    </div>
                    <div class="row h-100 ">
                        <div class="col-12 mb-4">
                            <button type="submit" class="btn btn-default btn-lg w-100">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ url('profile/updateProfile') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pegawai_id" value="{{ $data->idpeg }}">
        <input type="hidden" name="pegawai_detail_id" value="{{ $data->pegawai_detail_id }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Ubah Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <input type="hidden" name="image" value="{{ $data->foto_profile }}">
                    <div class="form-group form-floating">
                        <input type="file" name="foto_profile" class="form-control" id="fileupload">
                        <label for="fileupload">Uplaod File</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function changePicture(){
        // $('#tampildata').html(tampil);
        $('#editModal').modal('show');
    }
</script>

@endsection
