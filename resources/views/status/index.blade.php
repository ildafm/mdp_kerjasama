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
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>Id</th>
<th>Nama Status</th>
</tr>
</thead>
<tbody>
    @foreach($status as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->nama_status }}</td>
        </tr>
    @endforeach
</tbody>
<tfoot>
<tr>
<th>Id</th>
<th>Nama Status</th>
</tr>
</tfoot>
</table>

</div>
</div>
@endsection