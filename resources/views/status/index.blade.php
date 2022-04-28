@extends('layouts.master')
@section('title', 'Status')

@section('content')
<div class="card">
<div class="card-header">
<!-- <h3 class="card-title">Tabel Daftar Status</h3> -->
<a href="{{ url('/statuses/create') }}" class='btn btn-primary'>Tambah Status</a>
<div class="card-tools">
<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
<i class="fas fa-minus"></i>
</button>
<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
<i class="fas fa-times"></i>
</button>
</div>
</div>
<div class="card-body">
        @if(session()->has('pesan'))
        <div class='alert alert-success'>
            {{ session()->get('pesan') }}
        </div>
        @endif
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>Id</th>
<th>Nama Status</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
    @foreach($statuses as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->nama_status }}</td>
            <td>
                <a href="{{ route('statuses.edit', ['status'=>$data->id]) }}" class="btn btn-block btn-primary">Ubah</a>
                
                <form method="POST" action="{{ route('statuses.destroy', ['status'=>$data->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="form-group">
                        <input type="submit" class="btn btn-danger btn-block delete-user" value="Hapus">
                    </div>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
<tfoot>
<tr>
<th>Id</th>
<th>Nama Status</th>
<th>Aksi</th>
</tr>
</tfoot>
</table>

</div>
</div>
@endsection