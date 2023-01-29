@extends('layouts.master')
@section('title', 'Klasifikasi Mitra')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Klasifikasi Mitra</h3>

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
            <form action="{{ route('klasifikasi_mitras.store') }}" method="POST" onsubmit="disableBtnSubmitCreateForm()">
                @csrf
                {{-- Klasifikasi Mitra --}}
                <div class="form-group">
                    <label for="klasifikasi_mitra">Klasifikasi Mitra</label>
                    <input required type="text" name='klasifikasi_mitra'
                        class="form-control @error('klasifikasi_mitra') is-invalid @enderror"
                        placeholder="Masukan Klasifikasi Mitra">
                    @error('klasifikasi_mitra')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input required type="text" name='keterangan'
                        class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukan Keterangan">
                    @error('keterangan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                <button id="btn-submit-create" type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/klasifikasi_mitras" class="btn btn-outline-dark">Kembali</a>

            </form>
        </div>
    </div>
@endsection
