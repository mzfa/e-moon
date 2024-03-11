@extends('layouts.tamplate')

@section('content')
<table class="table table-sm mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Status Keluarga</th>
        <th scope="col">Nama Lengkap</th>
        <th scope="col">Usia</th>
        <th scope="col">#</th>
    </tr>
    </thead>
    <tbody>
        @foreach($keluarga_pegawai as $kel)
        <tr>
            @php
                $birthDate = new DateTime($kel->tanggal_lahir_kel);
                $today = new DateTime("today");
                $y = $today->diff($birthDate)->y;
            @endphp
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $kel->status_keluarga }}</td>
            <td>{{ $kel->nama_lengkap_kel }}</td>
            <td>{{ $y }} Tahun</td>
            <td>
                <span class="badge badge-danger" onclick="hapuskeluarga('{{ Crypt::encrypt($kel->keluarga_pegawai_id) }}')">Hapus</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection