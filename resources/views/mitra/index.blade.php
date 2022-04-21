@extends('layouts.master')
@section('title', 'Mitra')

@section('content')
<div class="card">
<div class="card-header">
<!-- <h3 class="card-title">Tabel Daftar Mitra</h3> -->
<a href="{{ url('/mitras/create') }}" class='btn btn-primary'>Tambah Mitra</a>
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
<th>Nama Mitra</th>
<th>Tingkat</th>
</tr>
</thead>
<tbody>
    @foreach($mitras as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->nama_mitra }}</td>
            <td>{{ $data->tingkat }}</td>
        </tr>
    @endforeach
</tbody>
<tfoot>
<tr>
<th>Id</th>
<th>Nama Mitra</th>
<th>Tingkat</th>
</tr>
</tfoot>
</table>
</div>
</div>
@endsection