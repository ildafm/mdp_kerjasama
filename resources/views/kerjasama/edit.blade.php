@extends('layouts.master')
@section('title', 'Kerja Sama')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ubah Data Kerja Sama {{ $kerjasama->nama_kerja_sama }}</h3>
    
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
        <form action="{{ route('kerjasamas.update', ['kerjasama'=>$kerjasama->id]) }}" method="POST">
            @csrf

        <div class="form-group">
            <label for="nama_kerja_sama">Nama Kerja Sama</label>
            <input type="text" value="{{ $kerjasama->nama_kerja_sama }}" name='nama_kerja_sama' class="form-control @error('nama_kerja_sama') is-invalid @enderror" placeholder="Masukan Nama Kerja Sama">
            @error('nama_kerja_sama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
        <div class="form-group col-lg-6">
            <!-- <div class="row"> -->
                <!-- <div class='col-lg-6 col-xs-12'> -->
                    <label for="tanggal_mulai">Tanggal Mulai : </label>
                    <input type="date" name="tanggal_mulai" value="{{ $kerjasama->tanggal_mulai }}" id="" class="form-control">
                    @error('tanggal_mulai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                <!-- </div> -->
        </div>
        <div class="form-group col-lg-6">
                <!-- <div class="col-lg-6 col-xs-12"> -->
                    <label for="tanggal_sampai"> Tanggal Sampai : </label>
                    <input type="date" name="tanggal_sampai" value="{{ $kerjasama->tanggal_sampai }}" id=""  class="form-control">
                    @error('tanggal_sampai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                <!-- </div> -->
            <!-- </div> -->
        </div>
        </div>
        <div class="form-group">
            <label for="nama_mitra">Nama Mitra</label>
            <select class="form-control" name='nama_mitra'>
                @foreach($mitras as $data)
                    <option value="{{ $data->id }}" <?= ($data->id == '{{ $data->id }}') ? 'selected' : '' ?>>{{ $data->id }} - {{ $data->nama_mitra }}</option>
                @endforeach
            </select>
            @error('nama_mitra')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
        <div class="form-group col-lg-6">
            <label for="nama_kategori">Nama Kategori</label>
            <select class="form-control" name='nama_kategori'>
                @foreach($kategoris as $data)
                    <option value="{{ $data->id }}">{{ $data->id }} - {{ $data->nama_kategori }}</option>
                @endforeach
            </select>
            @error('nama_kategori')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-lg-6">
            <label for="nama_status">Nama Status</label>
            <select class="form-control" name='nama_status'>
                @foreach($statuses as $data)
                    <option value="{{ $data->id }}">{{ $data->id }} - {{ $data->nama_status }}</option>
                @endforeach
            </select>
            @error('nama_status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</div>


</form>

@endsection