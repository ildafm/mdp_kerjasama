@extends('layouts.master')
@section('title', 'Kategori')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Kategori</h3>

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
            <form action="{{ route('kategoris.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" name='nama_kategori'
                        class="form-control @error('nama_kategori') is-invalid @enderror"
                        placeholder="Masukan Nama Kategori">
                    @error('nama_kategori')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/kategoris" class="btn btn-outline-dark">Kembali</a>
            </form>
        </div>
    </div>
@endsection
