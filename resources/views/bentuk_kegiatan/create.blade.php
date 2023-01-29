@extends('layouts.master')
@section('title', 'Bentuk Kegiatan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Bentuk Kegiatan</h3>

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
            <form action="{{ route('bentuk_kegiatans.store') }}" method="POST" onsubmit="disableBtnSubmitCreateForm()">
                @csrf

                <div class="form-group">
                    <label for="bentuk_kegiatan">Bentuk Kegiatan</label>
                    <input required type="text" name='bentuk_kegiatan'
                        class="form-control @error('bentuk_kegiatan') is-invalid @enderror"
                        placeholder="Masukan Bentuk Kegiatan">
                    @error('bentuk_kegiatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                <button id="btn-submit-create" type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/bentuk_kegiatans" class="btn btn-outline-dark">Kembali</a>

            </form>
        </div>
    </div>
@endsection
