@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Proyek</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">Proyek</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detail Proyek</h5>
                            <div class="row">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Proyek</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText"
                                            value="{{ $data->nama_proyek }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Lokasi Proyek</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText"
                                            value="{{ $data->alamat_proyek }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pemberi Tugas</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText"
                                            value="{{ $data->pemberi_tugas }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Manajemen Konstruksi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText"
                                            value="{{ $data->manajemen_konstruksi }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Konsultan Perencana</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText"
                                            value="{{ $data->konsultan_perencana }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kontraktor</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText"
                                            value="{{ $data->kontraktor }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sub Kontraktor</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText"
                                            value="{{ $data->sub_kontraktor }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu Mulai - Selesai</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="inputText"
                                            value="{{ $data->waktu_pelaksanaan_mulai }}" disabled>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="inputText"
                                            value="{{ $data->waktu_pelaksanaan_berakhir }}" disabled>
                                    </div>
                                </div>
                                <iframe src="{{ $data->lokasi }}" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection

@section('scripts')
    <script>
        function edit(id) {
            $.ajax({
                type: 'get',
                url: "{{ url('proyek/edit') }}/" + id,
                success: function(tampil) {
                    $('#tampildata').html(tampil);
                    $('#editModal').modal('show');
                }
            })
        }
    </script>
@endsection
