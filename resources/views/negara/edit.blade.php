@extends('layouts.master')
@section('title', 'Negara')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Negara {{ $negara->nama_negara }}</h3>

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
            <form action="{{ route('negaras.update', ['negara' => $negara->id]) }}" method="POST">
                @method('PUT')
                @csrf

                {{-- ubah nama --}}
                <div class="form-group">
                    <label for="nama_negara">Nama Negara</label>
                    <input type="text" name='nama_negara' class="form-control @error('nama_negara') is-invalid @enderror"
                        placeholder="Masukan Nama Negara" value="{{ $negara->nama_negara }}">
                    @error('nama_negara')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/negaras" class="btn btn-outline-dark">Kembali</a>
            </form>

        </div>
    </div>

@endsection
