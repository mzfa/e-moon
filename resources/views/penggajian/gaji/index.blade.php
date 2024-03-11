@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Gaji</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">Gaji</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Gaji</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <h4>This Week Stats</h4>
                      <div class="card-header-action">
                        <div class="dropdown">
                          <a href="#" class="dropdown-toggle btn btn-primary" data-toggle="dropdown">Filter</a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i> Electronic</a>
                            <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i> T-shirt</a>
                            <a href="#" class="dropdown-item has-icon"><i class="far fa-circle"></i> Hat</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">View All</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="summary">
                        <div class="summary-info">
                          <h4>{{ Auth::user()->name }}</h4>
                          <div class="text-muted">Riwayat Gaji RS Umum Pekerja</div>
                        </div>
                        <div class="summary-item">
                          <h6>Riwayat Gaji <span class="text-muted"></span></h6>
                          <hr>
                          <ul class="list-unstyled list-unstyled-border">
                            <a href="{{ url('gaji/detail/1') }}">
                            <li class="media">
                                <div class="media-body">
                                    <div class="media-right">Rp. 10.000.000 <br>
                                        <a class="badge badge-primary media-right text-white" href="{{ url('gaji/detail/1') }}">Detail</a>
                                    </div>
                                    <div class="media-title"><a href="{{ url('gaji/detail/1') }}">Gaji Periode Januari 2023</a></div>
                                    <div class="text-muted text-small">Dikirim 24-05-2023 08:10:00 <div class="bullet"></div> Terkirim</div>
                                  </div>
                              </li>
                                
                            </a>
                          </ul>
                        </div>
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
        <form action="{{ url('Gaji_manual/import') }}" method="post" enctype="multipart/form-data">
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
                        <label for="staticEmail" class="col-sm-12 col-form-label">Priode</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="periode" name="periode" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-12 col-form-label">File Import</label>
                        <div class="col-sm-12">
                        <input type="file" class="form-control" id="file" name="file" required>
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
      <form action="{{ url('Gaji/update') }}" method="post">
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
            url : "{{ url('Gaji/edit')}}/"+id,
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