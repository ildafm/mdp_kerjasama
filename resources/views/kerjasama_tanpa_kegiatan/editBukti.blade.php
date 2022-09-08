@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Bukti Kerjasama {{ $buktiKerjasama->nama_bukti_kerjasama }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        {{-- Barisan edit data Bukti --}}
        <form action="{{ route('buktiKerjasama2s.update', ['buktiKerjasama2' => $buktiKerjasama->id]) }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="card-body">

                {{-- Nama Bukti Kerjasama --}}
                <div class="form-group">
                    <label for="nama_bukti_kerjasama">Nama Bukti Kegiatan</label>
                    <input type="text" class="form-control" name="nama_bukti_kerjasama"
                        placeholder="Enter Nama Bukti Kegiatan"
                        value="{{ old('nama_bukti_kerjasama', $buktiKerjasama->nama_bukti_kerjasama) }}">

                    @error('nama_bukti_kerjasama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file">Bukti Kerjasama(Max:5mb | Kosongkan jika tidak ingin mengubah)</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>

                    @error('file')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer">
                {{-- Button Submit --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="{{ url("kerjasama_tanpa_kegiatans/$buktiKerjasama->kerjasama_id") }}"
                    class="btn btn-outline-dark">Kembali</a>
            </div>
        </form>

    </div>

@endsection
