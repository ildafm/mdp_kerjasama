@extends('layouts.master')
@section('title', 'Kategori Kerjasama')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Kategori {{ $kategori->nama_kategori }}</h3>

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
            {{-- Form edit data --}}
            <form action="{{ route('kategoris.update', ['kategori' => $kategori->id]) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" value="{{ $kategori->nama_kategori }}" name='nama_kategori'
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
