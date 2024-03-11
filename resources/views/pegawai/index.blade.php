@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">Pegawai</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Pegawai</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pegawai</h4>
                        <div class="col-auto">
                            <a tooltip="Sync Data Pegawai" onclick="return confirm('Apakah anda ingin sinkronisasi ke aplikasi PHIS?')" href="{{ url('pegawai/sync') }}" id="create_record" class="btn btn-danger text-white shadow-sm">
                                <i class="bi bi-sync"></i> Sync
                            </a>
                            <a tooltip="Sync Data Pegawai" onclick="return confirm('Apakah anda ingin sinkronisasi id satu sehat?')" href="{{ url('pegawai/sync_satusehat') }}" id="create_record" class="btn btn-danger text-white shadow-sm">
                                <i class="bi bi-sync"></i> Sync Satu Sehat
                            </a>
                            {{-- <a tooltip="Tambah Pegawai Baru" href="{{ url('pegawai/add') }}" id="create_record" class="btn btn-primary text-white shadow-sm">
                                <i class="bi bi-sync"></i> Tambah Pegawai Baru
                            </a> --}}
                            <a href="{{ url('pegawai/export') }}" class="btn btn-success shadow-sm">Excel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pegawai</th>
                                        <th>Nomor Induk</th>
                                        <th>Bagian</th>
                                        <th>Profesi</th>
                                        <th>Struktur Bagian</th>
                                        <th>Satu Sehat ID</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $pegawai)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $pegawai->nama_pegawai }}
                                                @if(is_null($pegawai->tanggal_lahir) && is_null($pegawai->status_kawin) && is_null($pegawai->alamat) && is_null($pegawai->telp_pribadi) && is_null($pegawai->kecamatan))
                                                    <span class="badge badge-danger">Belum Lengkap</span>
                                                @endif
                                            </td>
                                            <td>{{ $pegawai->nip }}</td>
                                            <td>{{ $pegawai->nama_bagian }}</td>
                                            <td>{{ $pegawai->nama_profesi }}</td>
                                            <td>{{ $pegawai->nama_struktur }}</td>
                                            <td>{{ $pegawai->satusehat_id }}</td>
                                            {{-- <td><a onclick="return edit({{ $pegawai->pegawai_id }})" class="btn text-white btn-info">Edit</a></td> --}}
                                            <td>
                                                <a href="{{ url('pegawai/edit/'.Crypt::encrypt($pegawai->pegawai_id)) }}" class="btn text-white btn-info">Edit</a>
                                                <a onclick="return confirm('Apakah anda Yakin ingin menghapus ini?')" href="{{ url('pegawai/hapus_pegawai/'.Crypt::encrypt($pegawai->pegawai_id)) }}" class="btn text-white btn-danger">Hapus</a>
                                                <a onclick="return confirm('Apakah anda Yakin ingin mengecek ID Satu Sehat?')" href="{{ url('pegawai/cek_satusehat/'.Crypt::encrypt($pegawai->pegawai_id)) }}" class="btn text-white btn-warning">Satu Sehat</a>
                                            </td>
                                        </tr>
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

@section('scripts')
<script>
    function edit(id){
        $.ajax({ 
            type : 'get',
            url : "{{ url('user/edit')}}/"+id,
            // data:{'id':id}, 
            success:function(tampil){
                $('#tampildata').html(tampil);
                $('#editModal').modal('show');
            } 
        })
    }
</script>

@endsection