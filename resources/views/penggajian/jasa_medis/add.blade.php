@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Jasa Medis</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">Jasa Medis</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Jasa Medis</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Penggajian</h4>
                        <div class="col-auto">
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <strong>{{ $error }} <br></strong> 
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <form action="{{ url('jasa_medis/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <th>Upload</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $item)
                                        <tr>
                                            <td>{{ $item->nama_pegawai }} @isset($item->file_bukti) <a target="_blank" href="{{ url('document/jasa_medis/'.$item->pegawai_id.'/'.$item->file_bukti) }}" class="badge text-white badge-warning">Sudah ada</a> @endisset
                                            </td>
                                            <td><input type="file" name="file[]" class="form-control"></td>
                                            <input type="hidden" name="pegawai_id[]" value="{{ $item->pegawai_id }}">
                                        </tr>
                                        @endforeach
                                        <input type="hidden" name="periode" value="{{ $periode }}">
                                    </tbody>
                                </table>
                                <button class="btn btn-primary w-100 mt-3" type="submit">Simpan</button>
                            </form>
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
        <form action="{{ url('jasa_medis/add') }}" method="get" >
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
                        <label for="staticEmail" class="col-sm-12 col-form-label">Periode</label>
                        <div class="col-sm-12">
                        <input type="month" class="form-control" id="periode" name="periode" required>
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


@endsection

@section('scripts')
<script>
    $("#datepicker").datepicker( {
        format: "mm-yyyy",
        viewMode: "months", 
        minViewMode: "months"
    });
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