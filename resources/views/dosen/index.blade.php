@extends('layouts.master')
@section('title', 'Dosen')

@section('content')

<div class="card">
<div class="card-header">
<h3 class="card-title">Tabel Daftar Dosen</h3>
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
<th>Kode Dosen</th>
<th>Nama Dosen</th>
</tr>
</thead>
<tbody>
    @foreach($dosens as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->kode_dosen }}</td>
            <td>{{ $data->nama_dosen }}</td>
        </tr>
    @endforeach
</tbody>
<tfoot>
<tr>
<th>Id</th>
<th>Kode Dosen</th>
<th>Nama Dosen</th>
</tr>
</tfoot>
</table>

</div>

<div class="card-footer">
Footer
</div>

</div>

@endsection