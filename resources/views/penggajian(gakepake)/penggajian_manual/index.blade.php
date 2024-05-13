@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Penggajian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">Penggajian</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Penggajian</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Penggajian</h4>
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
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>Periode</th>
                                        <th>NPWP - Norek</th>
                                        <th>Bagian</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($penggajian_manual as $item)
                                        @php
                                            $bulan = ['01' => 'Januari','02' => 'Februari','03' => 'Maret','04' => 'April','05' => 'Mei','06' => 'Juni','07' => 'Juli','08' => 'Agustus','09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'];
                                            // dd($bulan[01]);
                                            $bulan_periode = substr($item->periode_gaji, -2);
                                            $bulan_fix = $bulan[$bulan_periode];
                                            $periode_gajian = $bulan_fix." ". substr($item->periode_gaji,0, 4);
                                        @endphp
                                        <tr>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $periode_gajian }}</td>
                                            <td>{{ $item->npwp .' - '. $item->no_rek }}</td>
                                            <td>{{ $item->bagian  }}</td>
                                            <td>
                                                <a onclick="return edit({{ $item->penggajian_id }})" class="btn text-white btn-info">Edit</a>
                                                <a href="{{ url('penggajian_manual/detail/'.Crypt::encrypt($item->penggajian_id)) }}" class="btn text-white btn-warning">Detail</a>
                                                <a href="{{ url('penggajian_manual/delete/'.Crypt::encrypt($item->penggajian_id)) }}" class="btn text-white btn-danger">Hapus</a>
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
        <form action="{{ url('penggajian_manual/import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data <a href="{{ url('FORMAT IMPORT DATA.xlsx') }}" class="btn btn-warning">Download Tamplate</a></h5>
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