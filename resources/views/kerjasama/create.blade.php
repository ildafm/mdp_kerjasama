@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    {{-- <script>
        document.getElementById("no_mou").addEventListener("load", getStatus(@php echo old('nama_kategori') @endphp));

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
    </script> --}}

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

        <div class="card-body">
            {{-- Form tambah data --}}
            <form action="{{ route('kerjasamas.store') }}" method="POST">
                @csrf

                <div class="row">
                    {{-- Nama Kerjasama --}}
                    <div class="form-group col-lg-6">
                        <label for="nama_kerja_sama">Nama Kerjasama</label>
                        <input type="text" name='nama_kerja_sama' value="{{ old('nama_kerja_sama') }}"
                            class="form-control @error('nama_kerja_sama') is-invalid @enderror"
                            placeholder="Masukan Nama Kerjasama" required>
                        @error('nama_kerja_sama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="nama_kategori">Kategori</label>

                        @php
                            if (old('nama_kategori') != null) {
                                $option = old('nama_kategori');
                            } else {
                                $option = 1;
                            }
                        @endphp

                        <select class="form-control" id="nama_kategori" name='nama_kategori'>
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

                    {{-- Tanggal Berakhir --}}
                    <div class="form-group col-lg-6">
                        <label for="tanggal_sampai"> Tanggal Berakhir : </label>
                        <input type="date" name="tanggal_sampai" id="" class="form-control"
                            value="{{ old('tanggal_sampai') }}">
                        @error('tanggal_sampai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- Usulan --}}
                    <div class="form-group col-lg-4 col-sm-12">
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

                    {{-- Bidang --}}
                    @php
                        $option = old('bidang');
                    @endphp

                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="bidang">Bidang</label>
                        <select class="form-control" name="bidang">
                            <option value='P' {{ $option == 'P' ? 'selected' : '' }}>
                                Pendidikan
                            </option>
                            <option value='N' {{ $option == 'N' ? 'selected' : '' }}>
                                Penelitian
                            </option>
                            <option value='B' {{ $option == 'B' ? 'selected' : '' }}>
                                Pengabdian
                            </option>
                            <option value='A' {{ $option == 'A' ? 'selected' : '' }}>
                                Pendidikan, Penelitian, Pengabdian
                            </option>
                            <option value='L' {{ $option == 'L' ? 'selected' : '' }}>
                                Lain-lain
                            </option>
                        </select>
                        @error('bidang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Status --}}
                    <div class="form-group col-lg-4 col-sm-12">
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

                </div>

                <div class="form-group" hidden>
                    <label for="type">Hidden Type</label>
                    <input type="text" value="{{ $type }}" name='type'
                        class="form-control @error('type') is-invalid @enderror" readonly>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                {{-- &nbsp;
                <a href="/kerjasamas" class="btn btn-outline-dark">Kembali</a> --}}
            </form>
        </div>
    </div>
@endsection
