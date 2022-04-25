@extends('layouts.master')
@section('title', 'Usulan')

@section('content')
<div class="card">
    <div class="card-header">
        <!-- <h3 class="card-title">Tabel Daftar Usulan</h3> -->
        <a href="{{ url('/usulans/create') }}" class='btn btn-primary'>Tambah Usulan</a>
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
                    <th>Nama Usulan</th>
                    <th>Bentuk Kerja Sama</th>
                    <th>Rencana Kegiatan</th>
                    <th>Tanggal Rencana Kegiatan</th>
                    <th>Nama Mitra</th>
                    <th>Nama Dosen</th>
                    <th>Nama Unit</th>
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
                        <td>{{ $data->mitra->nama_mitra }}</td>
                        <td>{{ $data->dosen->nama_dosen }}</td>
                        <td>{{ $data->unit->nama_unit }}</td>
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
                <th>Nama Mitra</th>
                <th>Nama Dosen</th>
                <th>Nama Unit</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection