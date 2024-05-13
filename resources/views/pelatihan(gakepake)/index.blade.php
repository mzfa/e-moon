@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Pelatihan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">Pelatihan</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Pelatihan</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pelatihan</h4>
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
                                        <th>Nama Pelatihan</th>
                                        <th>Jenis Pelatihan</th>
                                        <th>Waktu Pelatihan</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{ $item->nama_pelatihan }}</td>
                                            <td>{{ $item->nama_jenis_pelatihan }}</td>
                                            <td>{{ date('l, d-F-Y', strtotime($item->tanggal_pelatihan)) }}</td>
                                            <td>
                                                <a onclick="return edit({{ $item->pelatihan_id }})" class="btn text-white btn-info">Edit</a>
                                                <a href="{{ url('pelatihan/delete/'.Crypt::encrypt($item->pelatihan_id)) }}" class="btn text-white btn-danger">Hapus</a>
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
        <form action="{{ url('pelatihan/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class=" row">
                        <label for="staticEmail" class="col-sm-12 col-form-label">Nama Pelatihan</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="nama_pelatihan" name="nama_pelatihan" required>
                        </div>
                    </div>
                    <div class=" row">
                        <label for="staticEmail" class="col-sm-12 col-form-label">Jenis Pelatihan</label>
                        <div class="col-sm-12">
                        <select class="form-control" name="jenis_pelatihan_id" id="jenis_pelatihan_id"  required>
                            @foreach($jenis_pelatihan as $item)
                            <option value="{{ $item->jenis_pelatihan_id }}">{{ $item->nama_jenis_pelatihan }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class=" row">
                        <label for="staticEmail" class="col-sm-12 col-form-label">Tanggal Pelatihan</label>
                        <div class="col-sm-12">
                        <input type="date" class="form-control" id="tanggal_pelatihan" name="tanggal_pelatihan" required>
                        </div>
                    </div>
                    <div class=" row">
                        <label for="staticEmail" class="col-sm-12 col-form-label">Penyelenggara</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" required>
                        </div>
                    </div>
                    <div class=" row">
                        <label for="staticEmail" class="col-sm-12 col-form-label">Bukti Pelatihan</label>
                        <div class="col-sm-12">
                        <input type="file" class="form-control" id="bukti_pelatihan" accept="image/*"  name="bukti_pelatihan" required>
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
      <form action="{{ url('pelatihan/update') }}" method="post">
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
            url : "{{ url('pelatihan/edit')}}/"+id,
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