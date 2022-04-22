@extends('layouts.master')
@section('title', 'Kategori')

@section('content')

<div class="card">
<div class="card-header">
<a href="{{ url('/kategoris/create') }}" class='btn btn-primary'>Tambah Kategori</a>
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
<th>Nama Kategori</th>
</tr>
</thead>
<tbody>
    @foreach($kategoris as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->nama_kategori }}</td>
        </tr>
    @endforeach
</tbody>
<tfoot>
<tr>
<th>Id</th>
<th>Nama Kategori</th>
</tr>
</tfoot>
</table>
</div>
</div>

@endsection