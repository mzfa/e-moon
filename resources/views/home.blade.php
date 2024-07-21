@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
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
        @php
            $key1= 0;
            $key2= 0;
            if (!empty($indikator1)) {
                # code...
                $rencana = explode(',',$indikator1);
                end($rencana);         // move the internal pointer to the end of the array
                $key1 = key($rencana);
            }
            if (!empty($indikator2)) {
                # code...
                $realisasi = explode(',',$indikator2);
                end($realisasi);         // move the internal pointer to the end of the array
                $key2 = key($realisasi);
            }
        @endphp

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl-3 col-md-3 ">
                            <div class="card info-card revenue-card bg-secondary">
                                <div class="card-body">
                                    <h5 class="card-title text-white">MANHOURS</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="ps-3">
                                            <h6 class="text-white">{{ $hse[0]->manhours ?? 0 }} </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3 ">
                            <div class="card info-card revenue-card bg-success">
                                <div class="card-body">
                                    <h5 class="card-title text-white">FIRST AID INJURY</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="ps-3">
                                            <h6 class="text-white">{{ $hse[0]->first_aid_injury ?? 0 }} </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3 ">
                            <div class="card info-card revenue-card bg-warning">
                                <div class="card-body">
                                    <h5 class="card-title text-white">MEDICAL TREATMENT INJURY</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="ps-3">
                                            <h6 class="text-white">{{ $hse[0]->medical_treatment ?? 0 }} </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3 ">
                            <div class="card info-card revenue-card bg-danger">
                                <div class="card-body">
                                    <h5 class="card-title text-white">FATALITY</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="ps-3">
                                            <h6 class="text-white">{{ $hse[0]->fatality ?? 0 }} </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Sales Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Rencana</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-journal-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $rencana[$key1] ?? 0 }} %</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Realisasi</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-graph-up-arrow"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $realisasi[$key2] ?? 0 }} %</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Hari dilewatkan</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="d-flex align-items-center justify-content-center">
                                            <br>
                                        </div>
                                        <div class="ps-3 mt-3">
                                            <h6>{{ $hari_dilewati ?? 0 }} Hari</h6>
                                            <div class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Sisa Hari</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="ps-3 mt-3">
                                            <h6>{{ $hari_belum_dilewati ?? 0 }} Hari</h6>
                                            <div class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->
                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Kurva S </h5>

                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [{
                                                    name: 'Rencana',
                                                    data: [{!! $indikator1 !!}]
                                                }, {
                                                    name: 'Realisasi',
                                                    data: [{!! $indikator2 !!}]
                                                }],
                                                chart: {
                                                    height: 350,
                                                    type: 'area',
                                                    toolbar: {
                                                        show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 4
                                                },
                                                // '#4154f1',
                                                colors: ['#2eca6a', '#ff771d'],
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                xaxis: {
                                                    type: 'string',
                                                    categories: [{!! $keterangan !!}]
                                                },
                                                tooltip: {
                                                    x: {
                                                        format: 'dd/MM/yy HH:mm'
                                                    },
                                                }
                                            }).render();
                                        });
                                    </script>
                                    <!-- End Line Chart -->

                                </div>

                            </div>
                        </div><!-- End Reports -->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="https://www.hik-connect.com/views/login/index.html?jump=1#/login" target="_blank">
                                        <div class="card card-body" style="height: 80% !important;">
                                            <center>
                                                <img src="{{ asset('assets/img/cctv.png') }}" alt="" style="width: 200px" class="mt-3">
                                            </center>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="https://b2.autodesk.com/login?_ga=2.170821480.914496400.1702462562-889765754.1701084963" target="_blank">
                                        <div class="card card-body" style="height: 80% !important;"">
                                            <center>
                                                <img src="{{ asset('assets/img/bim.png') }}" alt="" style="width: 200px" class="mt-3">
                                            </center>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="mt-3">
                                        &nbsp;
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main>
@endsection
