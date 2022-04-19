@extends('layouts.master')
@section('title', 'Unit')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Daftar Unit</h3>
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
                    <th>Nama Usulan</th>
                    <th>Bentuk Kerja Sama</th>
                    <th>Rencana Kegiatan</th>
                    <th>Tanggal Rencana Kegiatan</th>
                    <th>Mitra Id</th>
                    <th>Dosen Id</th>
                    <th>Unit Id</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usulans as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->nama_usulan }}</td>
                        <td>{{ $data->bentuk_kerjasama }}</td>
                        <td>{{ $data->rencana_kegiatan }}</td>
                        <td>{{ $data->tanggal_rencana_kegiatan }}</td>
                        <td>{{ $data->mitras_id }}</td>
                        <td>{{ $data->dosens_id }}</td>
                        <td>{{ $data->units_id }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Nama Usulan</th>
                <th>Bentuk Kerja Sama</th>
                <th>Rencana Kegiatan</th>
                <th>Tanggal Rencana Kegiatan</th>
                <th>Mitra Id</th>
                <th>Dosen Id</th>
                <th>Unit Id</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <div class="card-footer">
    Footer
    </div>
</div>
@endsection