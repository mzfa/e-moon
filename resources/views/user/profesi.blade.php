@extends('admin.layouts.app')

@section('content')

<div class="main-container container">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                </div>
                <div class="col px-0 align-self-center">
                    <h5 class="mb-0 text-color-theme">Data Karyawan</h5>
                    <p class="text-muted size-12"></p>
                </div>
                <div class="col-auto">
                    <button tooltip="Sync Data User" id="create_record" class="btn btn-danger text-white shadow-sm">
                        <i class="bi bi-sync"></i> Sync
                    </button>
                </div>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="allData" class="table nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Nama Jenis Profesi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection