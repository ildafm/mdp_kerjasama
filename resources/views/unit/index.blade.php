@extends('layouts.master')
@section('title', 'Unit')

@section('content')
<div class="card">
    <div class="card-header">
        <!-- <h3 class="card-title">Tabel Daftar Unit</h3> -->
        <a href="{{ url('/units/create') }}" class='btn btn-primary'>Tambah Unit</a>
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
                    <th>Nama Unit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($units as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->nama_unit }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Nama Unit</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection