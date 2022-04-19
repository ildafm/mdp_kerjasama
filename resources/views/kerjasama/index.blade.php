@extends('layouts.master')
@section('title', 'Kerja Sama')

@section('content')
<div class="card">
<div class="card-header">
<h3 class="card-title">Tabel Daftar Kerja Sama</h3>
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
<th>Nama Kerja Sama</th>
<th>Tanggal Mulai</th>
<th>Tanggal Sampai</th>
<th>Mitra Id</th>
<th>Kategori Id</th>
<th>Status Id</th>
</tr>
</thead>
<tbody>
    @foreach($kerjasamas as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->nama_kerja_sama }}</td>
            <td>{{ $data->tanggal_mulai }}</td>
            <td>{{ $data->tanggal_sampai }}</td>
            <td>{{ $data->mitras_id }}</td>
            <td>{{ $data->kategoris_id }}</td>
            <td>{{ $data->status_id }}</td>
        </tr>
    @endforeach
</tbody>
<tfoot>
<tr>
<th>Id</th>
<th>Nama Kerja Sama</th>
<th>Tanggal Mulai</th>
<th>Tanggal Sampai</th>
<th>Mitra Id</th>
<th>Kategori Id</th>
<th>Status Id</th>
</tr>
</tfoot>
</table>

</div>

<div class="card-footer">
Footer
</div>

</div>
@endsection