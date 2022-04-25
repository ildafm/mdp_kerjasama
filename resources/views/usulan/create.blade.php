@extends('layouts.master')
@section('title', 'Usulan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Usulan</h3>
    
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
        <form action="{{ route('usulans.store') }}" method="POST">
            @csrf
        
        
        <div class="form-group">
            <label for="nama_usulan">Nama Usulan </label>
            <input type="text" name='nama_usulan' class="form-control @error('nama_usulan') is-invalid @enderror" placeholder="Masukan Nama Usulan">
            @error('nama_usulan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="bentuk_kerjasama">Bentuk Kerjasama </label>
            <input type="text" name='bentuk_kerjasama' class="form-control @error('bentuk_kerjasama') is-invalid @enderror" placeholder="Masukan Bentuk Kerjasama">
            @error('bentuk_kerjasama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="rencana_kegiatan">Rencana Kegiatan </label>
            <input type="text" name='rencana_kegiatan' class="form-control @error('rencana_kegiatan') is-invalid @enderror" placeholder="Masukan Rencana Kegiatan">
            @error('rencana_kegiatan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        
            
        

        <div class="row">
        <div class="form-group col-lg-3">
                <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                <input type="date" name="tanggal_kegiatan" id="" class="form-control">
                @error('tanggal_kegiatan')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3">
            <label for="nama_mitra">Nama Mitra </label>
            <select class="form-control" name="nama_mitra" id="">
                    @foreach($mitras as $data)
                    <option value="{{ $data->id }}"> {{ $data->id }} - {{ $data->nama_mitra }}</option>
                    @endforeach
                </select>
            @error('nama_mitra')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group col-lg-3">
            <label for="nama_dosen">Nama Dosen </label>
            <select class="form-control" name="nama_dosen" id="">
                    @foreach($dosens as $data)
                    <option value="{{ $data->id }}"> {{ $data->id }} - {{ $data->nama_dosen }}</option>
                    @endforeach
                </select>
            @error('nama_dosen')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group col-lg-3">
            <label for="nama_unit">Nama Unit </label>
            <select class="form-control" name="nama_unit" id="">
                    @foreach($units as $data)
                    <option value="{{ $data->id }}"> {{ $data->id }} - {{ $data->nama_unit }}</option>
                    @endforeach
                </select>
            @error('nama_unit')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
        </div>    
        
        </div>
        

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</div>


</form>

@endsection