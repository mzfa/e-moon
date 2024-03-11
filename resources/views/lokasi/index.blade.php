@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Lokasi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">Lokasi</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Lokasi</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lokasi</h4>
                        <div class="col-auto">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Lokasi</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1 @endphp
                                    @foreach ($lokasi as $item)
                                        <tr class="bg-info">
                                            <td>
                                                <h5 class="text-white">{{ strtoupper($item['nama_lokasi']).' | '. $item['akronim'] }} @if($item['satusehat_id'] !== null) <i class="fa fa-check"></i> @endif</h5>
                                                @if ($item['parent_id'] == 0)
                                                @else
                                                    <h5 class="text-primary">
                                                        {{ strtoupper($item['nama_lokasi']).' | '. $item['akronim'] }}
                                                    </h5>
                                                @endif
                                                </td>
                                            <td>
                                                <a onclick="return edit({{ $item['lokasi_id'] }})"
                                                    class="btn text-white btn-warning"><i class="fa fa-pen"></i></a>
                                                <a onclick="return tambahsublokasi({{ $item['lokasi_id'] }})"
                                                    class="btn text-white btn-primary"><i class="fa fa-plus"></i></a>
                                                    @if(empty($item['sublokasi']))
                                                    <a href="{{ url('lokasi/delete/' . Crypt::encrypt($item['lokasi_id'])) }}"
                                                        class="btn text-white btn-danger"><i class="fa fa-trash"></i></a>
                                                    @endif
                                            </td>
                                        </tr>
                                        @foreach($item['sublokasi'] as $sublokasi)
                                        <tr class="bg-primary">
                                            <td>
                                                <h5 class="text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($sublokasi['nama_lokasi']).' | '. $sublokasi['akronim'] }}@if($sublokasi['satusehat_id'] !== null) <i class="fa fa-check"></i> @endif</h5>
                                            </td>
                                            <td>
                                                <a onclick="return edit({{ $sublokasi['lokasi_id'] }})"
                                                    class="btn text-white btn-warning"><i class="fa fa-pen"></i></a>
                                                <a onclick="return tambahsublokasi({{ $sublokasi['lokasi_id'] }})"
                                                    class="btn text-white btn-primary"><i class="fa fa-plus"></i></a>
                                                @if(empty($sublokasi['sublokasi1']))
                                                    <a href="{{ url('lokasi/delete/' . Crypt::encrypt($sublokasi['lokasi_id'])) }}"
                                                    class="btn text-white btn-danger"><i class="fa fa-trash"></i></a>
                                                @endif
                                                {{-- <a onclick="return edit({{ $sublokasi['lokasi_id'] }})"
                                                    class="btn text-white btn-info"><i class="fa fa-pen"></i></a>
                                                <a href="{{ url('lokasi/delete/' . Crypt::encrypt($sublokasi['lokasi_id'])) }}"
                                                    class="btn text-white btn-danger"><i class="fa fa-trash"></i></a> --}}
                                            </td>
                                        </tr>
                                            @foreach($sublokasi['sublokasi1'] as $sublokasi1)
                                            <tr class="bg-success">
                                                <td>
                                                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($sublokasi1['nama_lokasi']).' | '. $sublokasi1['akronim'] }}@if($sublokasi1['satusehat_id'] !== null) <i class="fa fa-check"></i> @endif</h5>
                                                </td>
                                                <td>
                                                    <a onclick="return edit({{ $sublokasi1['lokasi_id'] }})"
                                                        class="btn text-white btn-warning"><i class="fa fa-pen"></i></a>
                                                    <a onclick="return tambahsublokasi({{ $sublokasi1['lokasi_id'] }})"
                                                        class="btn text-white btn-primary"><i class="fa fa-plus"></i></a>
                                                    @if(empty($sublokasi1['sublokasi2']))
                                                        <a href="{{ url('lokasi/delete/' . Crypt::encrypt($sublokasi1['lokasi_id'])) }}"
                                                        class="btn text-white btn-danger"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                    {{-- <a onclick="return edit({{ $sublokasi1['lokasi_id'] }})"
                                                        class="btn text-white btn-info"><i class="fa fa-pen"></i></a>
                                                    <a href="{{ url('lokasi/delete/' . Crypt::encrypt($sublokasi1['lokasi_id'])) }}"
                                                        class="btn text-white btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                </td>
                                            </tr>
                                                @foreach($sublokasi1['sublokasi2'] as $sublokasi2)
                                                <tr class="bg-secondary">
                                                    <td>
                                                        <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($sublokasi2['nama_lokasi']).' | '. $sublokasi2['akronim'] }} @if($sublokasi2['satusehat_id'] !== null) <i class="fa fa-check"></i> @endif</h5>
                                                    </td>
                                                    <td>
                                                        <a onclick="return edit({{ $sublokasi2['lokasi_id'] }})"
                                                            class="btn text-white btn-warning"><i class="fa fa-pen"></i></a>
                                                        <a onclick="return tambahsublokasi({{ $sublokasi2['lokasi_id'] }})"
                                                            class="btn text-white btn-primary"><i class="fa fa-plus"></i></a>
                                                        @if(empty($sublokasi2['sublokasi3']))
                                                            <a href="{{ url('lokasi/delete/' . Crypt::encrypt($sublokasi2['lokasi_id'])) }}"
                                                            class="btn text-white btn-danger"><i class="fa fa-trash"></i></a>
                                                        @endif
                                                        {{-- <a onclick="return edit({{ $sublokasi2['lokasi_id'] }})"
                                                            class="btn text-white btn-info"><i class="fa fa-pen"></i></a>
                                                        <a href="{{ url('lokasi/delete/' . Crypt::encrypt($sublokasi2['lokasi_id'])) }}"
                                                            class="btn text-white btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                    </td>
                                                </tr>
                                                    @foreach($sublokasi2['sublokasi3'] as $sublokasi3)
                                                    <tr>
                                                        <td>
                                                            <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($sublokasi3['nama_lokasi']).' | '. $sublokasi3['akronim'] }}@if($sublokasi3['satusehat_id'] !== null) <i class="fa fa-check"></i> @endif</h5>
                                                        </td>
                                                        <td>
                                                            <a onclick="return edit({{ $sublokasi3['lokasi_id'] }})"
                                                                class="btn text-white btn-warning"><i class="fa fa-pen"></i></a>
                                                            <a onclick="return tambahsublokasi({{ $sublokasi3['lokasi_id'] }})"
                                                                class="btn text-white btn-primary"><i class="fa fa-plus"></i></a>
                                                            @if(empty($sublokasi3['sublokasi3']))
                                                                <a href="{{ url('lokasi/delete/' . Crypt::encrypt($sublokasi3['lokasi_id'])) }}"
                                                                class="btn text-white btn-danger"><i class="fa fa-trash"></i></a>
                                                            @endif
                                                            {{-- <a onclick="return edit({{ $sublokasi3['lokasi_id'] }})"
                                                                class="btn text-white btn-info"><i class="fa fa-pen"></i></a>
                                                            <a href="{{ url('lokasi/delete/' . Crypt::encrypt($sublokasi3['lokasi_id'])) }}"
                                                                class="btn text-white btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                        </td>
                                                    </tr>
                                                        @foreach($sublokasi3['sublokasi4'] as $sublokasi4)
                                                        <tr class="bg-info text-white">
                                                            <td>
                                                                <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($sublokasi4['nama_lokasi']).' | '. $sublokasi4['akronim'] }}@if($sublokasi4['satusehat_id'] !== null) <i class="fa fa-check"></i> @endif</h5>
                                                            </td>
                                                            <td>
                                                                <a onclick="return edit({{ $sublokasi4['lokasi_id'] }})"
                                                                    class="btn text-white btn-warning"><i class="fa fa-pen"></i></a>
                                                                <a onclick="return tambahsublokasi({{ $sublokasi4['lokasi_id'] }})"
                                                                    class="btn text-white btn-primary"><i class="fa fa-plus"></i></a>
                                                                @if(empty($sublokasi4['sublokasi4']))
                                                                    <a href="{{ url('lokasi/delete/' . Crypt::encrypt($sublokasi4['lokasi_id'])) }}"
                                                                    class="btn text-white btn-danger"><i class="fa fa-trash"></i></a>
                                                                @endif
                                                                {{-- <a onclick="return edit({{ $sublokasi4['lokasi_id'] }})"
                                                                    class="btn text-white btn-info"><i class="fa fa-pen"></i></a>
                                                                <a href="{{ url('lokasi/delete/' . Crypt::encrypt($sublokasi4['lokasi_id'])) }}"
                                                                    class="btn text-white btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach
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

<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('lokasi/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama lokasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Akronim</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="akronim" name="akronim" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="sublokasiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="sublokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('lokasi/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="nama_lokasi" class="col-sm-2 col-form-label">Nama lokasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Akronim</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="akronim" name="akronim" required>
                        </div>
                    </div>
                    <input type="hidden" name="parent_id" id="parent_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('lokasi/update') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                    <div id="tampildata"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        function edit(id) {
            $.ajax({
                type: 'get',
                url: "{{ url('lokasi/edit') }}/" + id,
                // data:{'id':id}, 
                success: function(tampil) {

                    // console.log(tampil); 
                    $('#tampildata').html(tampil);
                    $('#editModal').modal('show');
                }
            })
        }

        function tambahsublokasi(id) {
            $('#parent_id').val(id);
            $('#sublokasiModal').modal('show');
        }
    </script>
@endsection
