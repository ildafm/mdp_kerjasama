@extends('layouts.master')
@section('title', 'Klasifikasi Mitra')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Klasifikasi Mitra {{ $klasifikasiMitra->klasifikasi_mitra }}</h3>

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
            {{-- Form Ubah Data --}}
            <form action="{{ route('klasifikasi_mitras.update', ['klasifikasi_mitra' => $klasifikasiMitra->id]) }}" method="POST">
                @method('PUT')
                @csrf

                {{-- ubah nama --}}
                <div class="form-group">
                    <label for="klasifikasi_mitra">Klasifikasi Mitra</label>
                    <input type="text" name='klasifikasi_mitra' class="form-control @error('klasifikasi_mitra') is-invalid @enderror"
                        placeholder="Masukan Klasifikasi Mitra" value="{{ $klasifikasiMitra->klasifikasi_mitra }}">
                    @error('klasifikasi_mitra')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ubah keterangan --}}
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name='keterangan' class="form-control @error('keterangan') is-invalid @enderror"
                        placeholder="Masukan Keterangan" value="{{ $klasifikasiMitra->keterangan }}">
                    @error('keterangan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/klasifikasi_mitras" class="btn btn-outline-dark">Kembali</a>
            </form>

        </div>
    </div>

@endsection
