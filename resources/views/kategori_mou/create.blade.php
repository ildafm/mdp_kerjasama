@extends('layouts.master')
@section('title', 'Kategori MOU')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Kategori MOU</h3>

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
            <form action="{{ route('kategori_mous.store') }}" method="POST" onsubmit="disableBtnSubmitCreateForm()">
                @csrf

                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input required type="text" name='nama_kategori'
                        class="form-control @error('nama_kategori') is-invalid @enderror"
                        placeholder="Masukan Nama Kategori">
                    @error('nama_kategori')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                {{-- Button --}}
                <button id="btn-submit-create" type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/kategori_mous" class="btn btn-outline-dark">Kembali</a>
            </form>
        </div>
    </div>
@endsection
