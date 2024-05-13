@extends('layouts.app')

@section('content')

<script>
    let angka = 0;
    function pertanyaan_password(){
        if(angka < 3){
            var pertanyaan = prompt("Isikan Password Detail yang sudah di buat pada halaman utama setelah login");
            if (pertanyaan === "{{ Session('password_detail') }}") {
                alert('Berhasil, Silahkan melanjutkan aktivitas anda');
            }else{
                angka++;
                alert('Password anda salah... Ini adalah password detail yang di buat pada halaman utama setelah login.')
                pertanyaan_password();
            }
            console.log(angka);
        }else{
            alert('Password anda salah silahkan menghubungi IT')
            window.location.href = "{{ url('home') }}";
        }
    }
    pertanyaan_password();
</script>

<section class="section">
    <div class="section-header">
        <h1>Slip Gaji</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">Slip Gaji</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Slip Gaji</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Slip Gaji</h4>
                        <div class="col-auto">
                            {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> Tambah
                            </button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Bagian</th>
                                        <th>Pendidikan</th>
                                        <th>Gaji Bersih</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                        @php
                                            $bulan = ['01' => 'Januari','02' => 'Februari','03' => 'Maret','04' => 'April','05' => 'Mei','06' => 'Juni','07' => 'Juli','08' => 'Agustus','09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'];
                                            // dd($bulan[01]);
                                            $bulan_periode = substr($item->periode_gaji, -2);
                                            $bulan_fix = $bulan[$bulan_periode];

                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $bulan_fix }} {{ substr($item->periode_gaji,0, 4) }}</td>
                                            <td>{{ $item->bagian }}</td>
                                            <td>{{ $item->pendidikan }}</td>
                                            <td>Rp. {{ number_format($item->gaji_bersih) }}</td>
                                            <td>
                                                <a href="{{ url('slip_gaji/detail/'.Crypt::encrypt($item->penggajian_id)) }}" class="btn text-white btn-danger">Detail</a>
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
        <form action="{{ url('jenis_kompetensi/store') }}" method="post" enctype="multipart/form-data">
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
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama Kompetensi</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_jenis_kompetensi" name="nama_jenis_kompetensi" required>
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
      <form action="{{ url('jenis_kompetensi/update') }}" method="post">
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
            url : "{{ url('jenis_kompetensi/edit')}}/"+id,
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