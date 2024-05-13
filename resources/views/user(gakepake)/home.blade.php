@extends('user.layouts.app')

@section('content')
<div class="main-container container">
    <!-- welcome user -->
    <div class="row mb-4">
        <div class="col-auto">
            <div class="avatar avatar-50 shadow rounded-10">
                <img src="assets/img/user1.jpg" alt="">
            </div>
        </div>
        <div class="col align-self-center ps-0">
            <h4 class="text-color-theme"><span class="fw-normal">Hi</span>, {{ Auth::user()->name }}</h4>
            <p class="text-muted">Halo, Apa Kabar?</p>
        </div>
    </div>


    <!-- summary swiper carousel -->
    <div class="row">
        <div class="col-12 px-0">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md-3 col-lg-3">
                        <div class="card shadow-sm mb-4 alert-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar avatar-40 bg-primary text-white rounded-circle">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                    </div>
                                    <div class="col px-0">
                                        <h6 class="mb-0">0</h6>
                                        <p class="text-muted small">Pendidikan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-3">
                        <div class="card shadow-sm mb-4 alert-warning">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar avatar-40 bg-warning text-white rounded-circle">
                                            <i class="bi bi-cpu"></i>
                                        </div>
                                    </div>
                                    <div class="col px-0">
                                        <h6 class="mb-0">0</h6>
                                        <p class="text-muted small">Pelatihan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-3">
                        <div class="card shadow-sm mb-4 alert-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar avatar-40 bg-success text-white rounded-circle">
                                            <i class="bi bi-folder"></i>
                                        </div>
                                    </div>
                                    <div class="col px-0">
                                        <h6 class="mb-0">0</h6>
                                        <p class="text-muted small">Sertifikasi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-3">
                        <div class="card shadow-sm mb-4 alert-danger">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar avatar-40 bg-danger text-white rounded-circle">
                                            <i class="bi bi-bar-chart"></i>
                                        </div>
                                    </div>
                                    <div class="col px-0">
                                        <h6 class="mb-0">0</h6>
                                        <p class="text-muted small">Kompetensi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <h2>Informasi anda hari ini</h2>
                <hr>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus possimus ipsum placeat necessitatibus, dolores minima iste nobis officia odio ut eveniet vitae sit incidunt. Reiciendis molestias perferendis explicabo inventore expedita!
                </p>
            </div>
        </div>
    </div>
</div>
@endsection