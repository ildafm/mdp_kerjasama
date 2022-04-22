@extends('layouts.master')
@section('title', 'Dosen')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Dosen</h3>
    
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
        <form action="{{ route('dosens.store') }}" method="POST">
            @csrf
        <div class="form-group">
            <label for="kode_dosen">Kode Dosen</label>
            <input type="text" name='kode_dosen' class="form-control @error('kode_dosen') is-invalid @enderror" placeholder="Masukan Kode Dosen">
            @error('kode_dosen')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
            <label for="nama_dosen">Nama Dosen</label>
            <input type="text" name='nama_dosen' class="form-control @error('nama_dosen') is-invalid @enderror" placeholder="Masukan Nama Dosen">
            @error('nama_dosen')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</div>


</form>

@endsection