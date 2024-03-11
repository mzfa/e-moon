@extends('layouts.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Kategori Status</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item active">Kategori Status</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kategori Status <button type="button" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#basicModal">
                                <i class="bi bi-plus"></i> Tambah
                            </button></h5>

                        <!-- Table with stripped rows -->
                        <table class="table" id="table-1">
                            <thead>
                                <tr>
                                    <th>Nama Kategori Status</th>
                                    <th>Keterangan</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->nama_kategori_status }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                            <a onclick="return edit({{ $item->kategori_status_id }})"
                                                class="btn text-white btn-warning"><i class="bi bi-pen"></i></a>
                                            <a onclick="return confirm('Apakah anda yakin ini akan di hapus?')" href="{{ url('kategori_status/delete/' . Crypt::encrypt($item->kategori_status_id)) }}" class="btn text-white btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ url('kategori_status/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="staticEmail" class="form-label">Nama Ketegori Status</label>
                        <input type="text" class="form-control" id="nama_kategori_status" name="nama_kategori_status" required>
                    </div>
                    <div class="mb-3">
                        <label for="staticEmail" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1"> 
    <div class="modal-dialog">
      <form action="{{ url('kategori_status/update') }}" method="post">
        @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div id="tampildata"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            url : "{{ url('kategori_status/edit')}}/"+id,
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