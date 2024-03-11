@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/home') }}">Home</a></div>
            <div class="breadcrumb-item">User</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">User</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User</h4>
                        <div class="col-auto">
                            <a tooltip="Sync Data User" href="{{ url('user/sync') }}" id="create_record" class="btn btn-danger text-white shadow-sm">
                                <i class="bi bi-sync"></i> Sync
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Level User </th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->nama_hakakses }}</td>
                                        <td><a onclick="return akses({{ $item->id }})" class="btn text-white btn-info">Kasih Akses</a></td>
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

<div class="modal fade" id="aksesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="aksesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ url('user/update') }}" method="post">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aksesModalLabel">User Akses</h5>
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
    function akses(id){
        $.ajax({ 
            type : 'get',
            url : "{{ url('user/edit')}}/"+id,
            // data:{'id':id}, 
            success:function(tampil){
                $('#tampildata').html(tampil);
                $('#aksesModal').modal('show');
            } 
        })
    }
</script>

@endsection