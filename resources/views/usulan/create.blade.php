@extends('layouts.master')
@section('title', 'Usulan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Usulan</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        {{-- Form Tambah Data --}}
        <form action="{{ route('usulans.store') }}" method="POST">
            @csrf
            <div class="card-body">
                {{-- Nama Usulan --}}
                <div class="form-group">
                    <label for="usulan">Usulan </label>
                    <input type="text" name='usulan' class="form-control @error('usulan') is-invalid @enderror"
                        placeholder="Masukan Nama Usulan" value="{{ old('usulan') }}">
                    @error('usulan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Bentuk Kerjasama --}}
                    <div class="form-group col-lg-6">
                        <label for="bentuk_kerjasama">Bentuk Kerjasama </label>
                        <input type="text" name='bentuk_kerjasama'
                            class="form-control @error('bentuk_kerjasama') is-invalid @enderror"
                            placeholder="Masukan Bentuk Kerjasama" value="{{ old('bentuk_kerjasama') }}">
                        @error('bentuk_kerjasama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kontak Kerjasama --}}
                    <div class="form-group col-lg-6">
                        <label for="kontak_kerjasama">Kontak Kerjasama </label>
                        <input type="text" name='kontak_kerjasama'
                            class="form-control @error('kontak_kerjasama') is-invalid @enderror"
                            placeholder="Masukan Kontak Kerjasama" value="{{ old('kontak_kerjasama') }}">
                        @error('kontak_kerjasama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Rencana Kegiatan --}}
                <div class="form-group">
                    <label for="rencana_kegiatan">Rencana Kegiatan </label>
                    <input type="text" name='rencana_kegiatan'
                        class="form-control @error('rencana_kegiatan') is-invalid @enderror"
                        placeholder="Masukan Rencana Kegiatan" value="{{ old('rencana_kegiatan') }}">
                    @error('rencana_kegiatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Nama Pengusul --}}
                    <div class="form-group col-lg-3">
                        <label for="nama_pengusul">Nama Pengusul</label>
                        @php
                            if (old('nama_pengusul') !== null) {
                                $option = old('nama_pengusul');
                            } else {
                                $option = 1;
                            }
                        @endphp

                        <select class="form-control select2" name="nama_pengusul" id="">
                            @foreach ($users as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->kode_dosen }} - {{ $data->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama_pengusul')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Mitra --}}
                    <div class="form-group col-lg-3">
                        <label for="nama_mitra">Nama Mitra </label>

                        @php
                            if (old('nama_mitra') !== null) {
                                $option = old('nama_mitra');
                            } else {
                                $option = 1;
                            }
                        @endphp

                        <select class="form-control select2" name="nama_mitra" id="">
                            @foreach ($mitras as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_mitra }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama_mitra')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Unit --}}
                    <div class="form-group col-lg-3">
                        <label for="nama_unit">Nama Unit </label>

                        @php
                            if (old('nama_unit') !== null) {
                                $option = old('nama_unit');
                            } else {
                                $option = 1;
                            }
                        @endphp

                        <select class="form-control select2" name="nama_unit" id="">
                            @foreach ($units as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_unit }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama_unit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Type --}}
                    <div class="form-group col-lg-3">
                        <label for="type">Type</label>
                        @php
                            if (old('type') !== null) {
                                $option = old('type');
                            } else {
                                $option = 'I';
                            }
                        @endphp

                        <select class="form-control" name="type" id="">
                            <option value="I" <?= $option == 'I' ? 'selected' : '' ?>>IN</option>
                            <option value="O" <?= $option == 'O' ? 'selected' : '' ?>>OUT</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/usulans" class="btn btn-outline-dark">Kembali</a>
            </div>

        </form>
    </div>
@endsection
