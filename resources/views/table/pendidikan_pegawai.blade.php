@extends('layouts.tamplate')

@section('content')
<table class="table table-sm mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Jenis Pendidikan</th>
        <th scope="col">Nama Sekolah/Instansi</th>
        <th scope="col">Tanggal Lulus</th>
        <th scope="col">Nomor Ijazah</th>
        <th scope="col">#</th>
    </tr>
    </thead>
    <tbody>
        @foreach($pendidikan_pegawai as $pend)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $pend->nama_pendidikan }}</td>
            <td>{{ $pend->nama_sekolah }}</td>
            <td>{{ $pend->tanggal_lulus }}</td>
            <td>{{ $pend->nomor_ijazah }}</td>
            <td>
                <span class="badge badge-danger" onclick="hapuspendidikan('{{ Crypt::encrypt($pend->pendidikan_pegawai_id) }}')">Hapus</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection