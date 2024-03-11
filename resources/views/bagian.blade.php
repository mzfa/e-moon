@extends('layouts.app')

@section('content')
@php
    $indent = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
@endphp

<section class="section">
    <div class="section-header">
        <h1>Bagian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">Bagian</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Bagian</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Bagian</h4>
                        <div class="col-auto">
                            <a tooltip="Sync Data bagian" href="{{ url('bagian/sync') }}" id="create_record" class="btn btn-danger text-white shadow-sm">
                                <i class="bi bi-sync"></i> Sync
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Bagian</th>
                                        <th>Group </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $bagian1)
                                        @empty($bagian1->referensi_bagian)
                                            <tr class="@if ($bagian1->group_bagian == 'GROUP') text-danger @else text-info @endif">
                                                <td>{{ $bagian1->nama_bagian }}</td>
                                                <td>{{ $bagian1->group_bagian }}</td>
                                            </tr>
                                            @foreach ($data as $bagian2)
                                                @if ($bagian1->bagian_id == $bagian2->referensi_bagian)
                                                    <tr class="@if ($bagian2->group_bagian == 'GROUP') text-danger @else text-info @endif">
                                                        <td>{!! $indent !!}{{ $bagian2->nama_bagian }}</td>
                                                        <td>{{ $bagian2->group_bagian }}</td>
                                                    </tr>
                                                @endif
                                                @foreach ($data as $bagian3)
                                                    @if ($bagian1->bagian_id == $bagian2->referensi_bagian && $bagian2->bagian_id == $bagian3->referensi_bagian)
                                                        <tr class="@if ($bagian3->group_bagian == 'GROUP') text-danger @else text-info @endif">
                                                            <td>{!! $indent . $indent !!}{{ $bagian3->nama_bagian }}</td>
                                                            <td>{{ $bagian3->group_bagian }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endempty
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection