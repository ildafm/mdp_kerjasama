@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Menambahkan Bukti Kerjasama</h3>

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
            <form action="{{ route('buktiKerjasamas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    {{-- Nama Bukti Kerjasama 1 --}}
                    <div class="form-group col-lg-6">
                        <label for="nama_bukti_kerjasama">Nama Bukti Kerjasama 1</label>
                        <input type="text" class="form-control" name="nama_bukti_kerjasama1"
                            placeholder="Enter nama bukti kerjasama 1">

                        @error('nama_bukti_kerjasama1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- add file 1 --}}
                    <div class="form-group col-lg-6">
                        <label for="foto">Bukti Kerjasama 1</label>
                        <input type="file" class="form-control" name="foto1">

                        @error('foto')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- Nama Bukti Kerjasama 2 --}}
                    <div class="form-group col-lg-6">
                        <label for="nama_bukti_kerjasama2">Nama Bukti Kerjasama 2</label>
                        <input type="text" class="form-control" name="nama_bukti_kerjasama2"
                            placeholder="Enter nama bukti kerjasama">

                        @error('nama_bukti_kerjasama2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- add file 2 --}}
                    <div class="form-group col-lg-6">
                        <label for="foto2">Bukti Kerjasama 2</label>
                        <input type="file" class="form-control" name="foto2">

                        @error('foto2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- Nama Bukti Kerjasama 3 --}}
                    <div class="form-group col-lg-6">
                        <label for="nama_bukti_kerjasama3">Nama Bukti Kerjasama 3</label>
                        <input type="text" class="form-control" name="nama_bukti_kerjasama3"
                            placeholder="Enter nama bukti kerjasama">

                        @error('nama_bukti_kerjasama3')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- add file 3 --}}
                    <div class="form-group col-lg-6">
                        <label for="foto3">Bukti Kerjasama 3</label>
                        <input type="file" class="form-control" name="foto3">

                        @error('foto3')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kerjasama ID --}}
                <div class="form-group">
                    <input type="hidden" value="{{ $kerjasama->id }}" name="kerjasama_id">
                    @error('kerjasama_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Button Submit --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </div>
        </form>

    </div>



@endsection
