@extends('layouts.master')
@section('title', 'Mitra')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Mitra</h3>

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
            {{-- Form Tambah Data --}}
            <form action="{{ route('mitras.store') }}" method="POST">
                @csrf

                {{-- Nama Mitra --}}
                <div class="form-group">
                    <label for="nama_mitra">Nama Mitra</label>
                    <input type="text" name='nama_mitra' class="form-control @error('nama_mitra') is-invalid @enderror"
                        placeholder="Masukan Nama Mitra">
                    @error('nama_mitra')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Tingkat Mitra --}}
                    <div class="form-group col-lg-4">
                        <label for="tingkat">Tingkat</label>
                        <select class="form-control" name='tingkat'>
                            <option value='I'>Internasional</option>
                            <option value='N'>Nasional</option>
                            <option value='W'>Wilayah/lokal</option>
                        </select>
                        @error('tingkat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Klasifikasi --}}
                    <div class="form-group col-lg-4">
                        <label for="klasifikasi_mitra">Klasifikasi Mitra</label>
                        <select class="form-control select2" name='klasifikasi_mitra'>
                            @foreach ($klasifikasiMitras as $data)
                                <option value="{{ $data->id }}">{{ $data->klasifikasi_mitra }}</option>
                            @endforeach
                        </select>
                        @error('klasifikasi_mitra')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Negara --}}
                    <div class="form-group col-lg-4">
                        <label for="nama_negara">Negara Asal</label>
                        <select class="form-control select2" name='nama_negara'>
                            @foreach ($negaras as $data)
                                <option value="{{ $data->id }}">{{ $data->nama_negara }}</option>
                            @endforeach
                        </select>
                        @error('nama_negara')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/mitras" class="btn btn-outline-dark">Kembali</a>

            </form>
        </div>
    </div>
@endsection
