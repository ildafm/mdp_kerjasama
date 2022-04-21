@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')

<div class="card">
<div class="card-header">
<h3 class="card-title">Tabel Daftar Kegiatan</h3>
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
<th>Tanggal Mulai</th>
<th>Tanggal Sampai</th>
<th>Bentuk Kegiatan</th>
<th>PIC</th>
<th>Keterangan</th>
<th>Nama Kerja Sama</th>
<th>Nama Dosen</th>
</tr>
</thead>
<tbody>
    @foreach($kegiatans as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->tanggal_mulai }}</td>
            <td>{{ $data->tanggal_sampai }}</td>
            <td>{{ $data->bentuk_kegiatan }}</td>
            <td>{{ $data->PIC }}</td>
            <td>{{ $data->keterangan }}</td>
            <td>{{ $data->kerjasama->nama_kerja_sama }}</td>
            <td>{{ $data->dosen->nama_dosen }}</td>
        </tr>
    @endforeach
</tbody>
<tfoot>
<tr>
<th>Id</th>
<th>Tanggal Mulai</th>
<th>Tanggal Sampai</th>
<th>Bentuk Kegiatan</th>
<th>PIC</th>
<th>Keterangan</th>
<th>Nama Kerja Sama</th>
<th>Nama Dosen</th>
</tr>
</tfoot>
</table>

</div>
</div>

@endsection