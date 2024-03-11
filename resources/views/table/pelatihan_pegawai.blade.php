@extends('layouts.tamplate')

@section('content')
<table class="table table-sm mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Bukti Pelatihan</th>
        <th scope="col">Nama Pelatihan</th>
        <th scope="col">Penyelenggara</th>
        <th scope="col">Jumlah Jam Pelajaran</th>
        <th scope="col">Tanggal Pelatihan</th>
        <th scope="col">#</th>
    </tr>
    </thead>
    <tbody>
        @foreach($pelatihan_pegawai as $kel)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td><a href="{{ url('document/pelatihan/'.$kel->bukti_pelatihan) }}" target="_blank" rel="noopener noreferrer">Lihat Bukti</a></td>
            <td>{{ $kel->nama_pelatihan }}</td>
            <td>{{ $kel->penyelenggara }}</td>
            <td>{{ $kel->jam_pelajaran }}</td>
            <td>{{ $kel->tanggal_pelatihan }}</td>
            <td>
                <span class="badge badge-danger" onclick="hapuspelatihan('{{ Crypt::encrypt($kel->pelatihan_pegawai_id) }}')">Hapus</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection