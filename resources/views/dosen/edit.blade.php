@extends('layouts.master')
@section('title', 'Dosen')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ubah Data Dosen {{ $dosen->nama_dosen }}</h3>
    
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
        <form action="{{ route('dosens.update', ['dosen'=>$dosen->id]) }}" method="POST">
            {{-- @csrf --}}
            {{ csrf_field() }}
            {{ method_field('PUT') }}
        <div class="form-group">
            <label for="kode_dosen">Kode Dosen</label>
            <input type="text" name='kode_dosen' value="{{ $dosen->kode_dosen }}" class="form-control @error('kode_dosen') is-invalid @enderror" placeholder="Masukan Kode Dosen">
            @error('kode_dosen')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
            <label for="nama_dosen">Nama Dosen</label>
            <input type="text" name='nama_dosen' value="{{ $dosen->nama_dosen }}" class="form-control @error('nama_dosen') is-invalid @enderror" placeholder="Masukan Nama Dosen">
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

{{-- Kesalahan --}}
{{-- pesan eror akan merefresh halaman --}}