@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    <script>
        function getStatus(status) {
            let nk = document.getElementById("nama_kategori")

            let no_mou = document.getElementById("no_mou")

            no_mou.readOnly = false
            if (nk.value == "1") {
                no_mou.readOnly = false
            } else {
                no_mou.value = ""
                no_mou.readOnly = true
            }
        }
    </script>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Kerjasama</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        {{-- Form tambah data --}}
        <form action="{{ route('kerjasamas.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    {{-- Nomor MoU --}}
                    <div class="form-group col-lg-6">
                        <label for="no_mou">Nomor MoU</label>
                        <input type="text" id="no_mou" name='no_mou' value="{{ old('no_mou') }}"
                            class="form-control @error('no_mou') is-invalid @enderror" placeholder="Masukan Nomor MoU">
                        @error('no_mou')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="nama_kategori">Kategori</label>

                        @php
                            if (old('nama_kategori') !== null) {
                                $option = old('nama_kategori');
                            } else {
                                $option = 1;
                            }
                        @endphp

                        <select class="form-control" id="nama_kategori" name='nama_kategori' onchange="getStatus(this)">
                            @foreach ($kategoris as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama_kategori')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Nama Kerjasama --}}
                <div class="form-group">
                    <label for="nama_kerja_sama">Nama Kerjasama</label>
                    <input type="text" name='nama_kerja_sama' value="{{ old('nama_kerja_sama') }}"
                        class="form-control @error('nama_kerja_sama') is-invalid @enderror"
                        placeholder="Masukan Nama Kerja Sama">
                    @error('nama_kerja_sama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    {{-- Tanggal Mulai --}}
                    <div class="form-group col-lg-6">
                        <label for="tanggal_mulai">Tanggal Mulai : </label>
                        <input type="date" name="tanggal_mulai" id="" class="form-control"
                            value="{{ old('tanggal_mulai') }}">
                        @error('tanggal_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div class="form-group col-lg-6">
                        <label for="tanggal_sampai"> Tanggal Sampai : </label>
                        <input type="date" name="tanggal_sampai" id="" class="form-control"
                            value="{{ old('tanggal_sampai') }}">
                        @error('tanggal_sampai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- Nama Status --}}
                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="nama_status">Status</label>

                        @php
                            if (old('nama_status') !== null) {
                                $option = old('nama_status');
                            } else {
                                $option = 1;
                            }
                        @endphp

                        <select class="form-control" name='nama_status'>
                            @foreach ($statuses as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_status }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama_status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Usulan --}}
                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="usulan">Usulan</label>
                        <select class="form-control select2" name='usulan'>

                            @php
                                if (old('usulan') !== null) {
                                    $option = old('usulan');
                                } else {
                                    $option = 1;
                                }
                            @endphp

                            @foreach ($usulans as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->usulan }}
                                </option>
                            @endforeach
                        </select>
                        @error('usulan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/kerjasamas" class="btn btn-outline-dark">Kembali</a>
            </div>
        </form>
    </div>



@endsection
