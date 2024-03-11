@extends('layouts.tamplate')

@section('content')
<table class="table table-sm mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Perusahaan</th>
        <th scope="col">Nama Bagian/Profesi</th>
        <th scope="col">Lama Bekerja</th>
        <th scope="col">#</th>
    </tr>
    </thead>
    <tbody>
        @foreach($riwayat_pekerjaan_pegawai as $kel)
        <tr>
            @php
                $tgl1 = new DateTime($kel->tanggal_masuk_kerja);
                $tgl2 = new DateTime($kel->tanggal_keluar_kerja);
                $jarak = $tgl2->diff($tgl1);
            @endphp
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $kel->nama_perusahaan }}</td>
            <td>{{ $kel->bagian }}</td>
            <td>{{ $jarak->y }} Tahun {{ $jarak->m }} Bulan</td>
            <td>
                <span class="badge badge-danger" onclick="hapuspekerjaan('{{ Crypt::encrypt($kel->riwayat_pekerjaan_pegawai_id) }}')">Hapus</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection