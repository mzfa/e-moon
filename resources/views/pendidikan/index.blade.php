@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Pendidikan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">Pendidikan</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Pendidikan</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pendidikan</h4>
                        <div class="col-auto">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <strong>{{$error}} <br></strong> 
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Jenis Pendidikan</th>
                                        <th>Nama Instansi - Jurusan</th>
                                        <th>Tahun Mulai - Lulus</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{ $item->nama_pendidikan }}</td>
                                            <td>{{ $item->nama_instansi .' - '. $item->jurusan }}</td>
                                            <td>{{ $item->tahun_mulai .' - '. $item->tahun_lulus }}</td>
                                            <td>
                                                <a onclick="return edit({{ $item->pendidikan_id }})" class="btn text-white btn-info">Edit</a>
                                                <a href="{{ url('pendidikan/delete/'.Crypt::encrypt($item->pendidikan_id)) }}" class="btn text-white btn-danger">Hapus</a>
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

<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('pendidikan/store') }}" method="post" enctype="multipart/form-data">
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
                        <label for="staticEmail" class="col-sm-12 col-form-label">Jenis Pendidikan</label>
                        <div class="col-sm-12">
                            <select name="jenis_pendidikan_id" id="jenis_pendidikan_id" class="form-control">
                                @foreach($pendidikan as $item)
                                    <option value="{{ $item->jenis_pendidikan_id }}">{{ $item->nama_pendidikan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-12 col-form-label">Nama Instansi</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-12 col-form-label">Tahun Mulai</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="tahun_mulai" name="tahun_mulai" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-12 col-form-label">Tahun Lulus</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-12 col-form-label" for="address4">Jurusan/Fakultas</label>
                        
                        <div class="col-sm-12">
                            <input type="text" list="datalistjurusan" name="jurusan" class="form-control"
                            id="address4" placeholder="Select Jurusan">
                            <datalist id="datalistjurusan">
                                @foreach($jurusan as $item)
                                    <option value="{{ $item->jurusan }}">
                                @endforeach
                            </datalist>
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


<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ url('pendidikan/update') }}" method="post">
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
    function edit(id){
        // let filter = $(this).attr('id'); 
        // filter = filter.split("-");
        // var tfilter = $(this).attr('id');
        // console.log(id);
        $.ajax({ 
            type : 'get',
            url : "{{ url('pendidikan/edit')}}/"+id,
            // data:{'id':id}, 
            success:function(tampil){

                // console.log(tampil); 
                $('#tampildata').html(tampil);
                $('#editModal').modal('show');
            } 
        })
    }
</script>

@endsection