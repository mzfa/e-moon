@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">Akses Proyek</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <strong>{{ $error }} <br></strong>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h5 class="card-title">User </h5>

                            <!-- Table with stripped rows -->
                            @if (Session::has('success'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ url('hakakses/akses_proyek') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Simpan
                                    Akses</button>
                                <input type="hidden" name="hakakses_id" value="{{ $id }}">
                                <table class="table nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Proyek</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                        $menu_akses = explode (",", $data_hakakses[0]->proyek_id);
                                        // $menu_akses = [];
                                        // dump($data_hakakses);
                                        
                                        @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>
                                                    <?php
                                                    $status = null;
                                                    foreach ($menu_akses as $cekmenu) {
                                                        if ($cekmenu == $item->proyek_id) {
                                                            $status = 'active';
                                                        }
                                                    }
                                                    ?>
                                                    <input type="checkbox" <?php if ($status != null) {
                                                        echo 'checked';
                                                    } ?> class="checkbox"
                                                        name="proyek_id[]" value="{{ $item->proyek_id }}">
                                                </td>
                                                <td>
                                                    <h5 class="text-success">{{ strtoupper($item->nama_proyek) }}</h5>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
