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
        <form action="{{ route('buktiKerjasamas.update', ['buktiKerjasama' => $buktiKerjasama->id]) }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="row">
                    {{-- Nama File --}}
                    <div class="form-group col-lg-8">
                        <label for="nama_file">Nama File</label>
                        <input type="text" class="form-control" name="nama_file" placeholder="Enter Nama File"
                            value="{{ old('nama_file', $buktiKerjasama->nama_file) }}">

                        @error('nama_file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis File --}}
                    <div class="form-group col-lg-4">
                        <label for="jenis_file">Jenis File</label>
                        @php
                            if (old('jenis_file') != null) {
                                $option = old('jenis_file');
                            } else {
                                $option = $buktiKerjasama->jenis_file;
                            }
                        @endphp

                        <select class="form-control" name="jenis_file" id="">
                            <option value="B" {{ $option == 'B' ? 'selected' : '' }}>
                                Bukti Kerjasama
                            </option>
                            <option value="S" {{ $option == 'S' ? 'selected' : '' }}>
                                SPK
                            </option>
                            @if ($kerjasama->kategori_id == '1')
                                <option value="M" {{ $option == 'M' ? 'selected' : '' }}>
                                    MoU
                                </option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="file">Upload File(pdf,jpg,png,docx,doc | Max:10mb | Kosongkan jika tidak ingin
                        mengubah)</label>
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
                {{-- <a href="{{ url("kegiatans/$buktiKegiatan->kegiatans_id") }}" class="btn btn-outline-dark">Kembali</a> --}}
                <a href="{{ url("kerjasamas/$buktiKerjasama->kerjasama_id") }}" class="btn btn-outline-dark">Kembali</a>
            </div>
        </form>

    </div>

@endsection
