@extends('layouts.master')
@section('title', 'Mitra')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Mitra {{ $mitra->nama_mitra }}</h3>

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
            <form action="{{ route('mitras.update', ['mitra' => $mitra->id]) }}" method="POST">
                @method('PUT')
                @csrf

                {{-- ubah nama --}}
                <div class="form-group">
                    <label for="nama_mitra">Nama Mitra</label>
                    <input type="text" name='nama_mitra' class="form-control @error('nama_mitra') is-invalid @enderror"
                        placeholder="Masukan Nama Mitra" value="{{ $mitra->nama_mitra }}">
                    @error('nama_mitra')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ubah tingkat --}}
                <div class="form-group">
                    <label for="tingkat">Tingkat</label>
                    <select class="form-control" name='tingkat'>
                        <option value='I' <?= $mitra->tingkat == 'I' ? 'selected' : '' ?>>Internasional</option>
                        <option value='N' <?= $mitra->tingkat == 'N' ? 'selected' : '' ?>>Nasional</option>
                        <option value='W' <?= $mitra->tingkat == 'W' ? 'selected' : '' ?>>Wilayah/lokal</option>
                    </select>
                    @error('tingkat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/mitras" class="btn btn-outline-dark">Kembali</a>
            </form>

        </div>
    </div>

@endsection
