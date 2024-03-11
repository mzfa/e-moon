@extends('admin.layouts.app')

@section('content')

<div class="main-container container">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                </div>
                <div class="col px-0 align-self-center">
                    <h5 class="mb-0 text-color-theme">Data Pendidikan</h5>
                    <p class="text-muted size-12"></p>
                </div>
                <div class="col-auto">
                    <button tooltip="Tambah Data" id="create_record" class="btn btn-primary text-white shadow-sm" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-plus"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control " id="search" placeholder="Search">
                    <label class="form-control-label" for="search">Search User</label>
                    <button type="button" class="text-color-theme tooltip-btn">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm mb-4">
                            <ul class="list-group list-group-flush bg-none">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-auto">
                                            <figure class="avatar avatar-50 rounded-10 shadow-sm">
                                                <img src="assets/img/user1.jpg" alt="">
                                            </figure>
                                        </div>
                                        <div class="col px-0">
                                            <p>Ajinkya McMohan<br><small class="text-muted">Jr. Software Engineer</small>
                                            </p>
                                        </div>
                                        <div class="col-auto text-end">
                                            <p>
                                                <small class="text-muted size-12">Online <span
                                                        class="avatar avatar-6 rounded-circle bg-success d-inline-block"></span></small>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-auto">
                                            <figure class="avatar avatar-50 rounded-10 shadow-sm">
                                                <img src="assets/img/user2.jpg" alt="">
                                            </figure>
                                        </div>
                                        <div class="col px-0">
                                            <p>Ajinkya McMohan<br><small class="text-muted">Project Manager</small></p>
                                        </div>
                                        <div class="col-auto text-end">
                                            <p>
                                                <small class="text-muted size-12">Online <span
                                                        class="avatar avatar-6 rounded-circle bg-success d-inline-block"></span></small>
                                            </p>
                                        </div>
                                    </div>
                                </li>
    
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-auto">
                                            <figure class="avatar avatar-50 rounded-10 shadow-sm">
                                                <img src="assets/img/user3.jpg" alt="">
                                            </figure>
                                        </div>
                                        <div class="col px-0">
                                            <p>Ajinkya McMohan<br><small class="text-muted">Lead UX Designer</small></p>
                                        </div>
                                        <div class="col-auto text-end">
                                            <p>
                                                <small class="text-muted size-12">Online <span
                                                        class="avatar avatar-6 rounded-circle bg-success d-inline-block"></span></small>
                                            </p>
                                        </div>
                                    </div>
                                </li>
    
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-auto">
                                            <figure class="avatar avatar-50 rounded-10 shadow-sm">
                                                <img src="assets/img/user1.jpg" alt="">
                                            </figure>
                                        </div>
                                        <div class="col px-0">
                                            <p>Ajinkya McMohan<br><small class="text-muted">Sr. Marketing Head</small></p>
                                        </div>
                                        <div class="col-auto text-end">
                                            <p>
                                                <small class="text-muted size-12">Online <span
                                                        class="avatar avatar-6 rounded-circle bg-success d-inline-block"></span></small>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('pendidikan/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama Pendidikan</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_pendidikan" name="nama_pendidikan" required>
                        </div>
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

<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ url('pendidikan/update') }}" method="post">
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