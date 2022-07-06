@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Kegiatan {{ $kegiatans->nama_kegiatan }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        {{-- Form ubah data --}}
        <form action="{{ route('kegiatans.update', ['kegiatan' => $kegiatans->id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                {{-- Kerjasama --}}
                <div class="form-group">
                    <label for="kerjasamas">Kerjasama</label>
                    @php
                        if (old('kerjasamas') !== null) {
                            $option = old('kerjasamas');
                        } else {
                            $option = $kegiatans->kerjasama_id;
                        }
                    @endphp

                    <select class="form-control select2" name="kerjasamas" id="">
                        @foreach ($kerjasamas as $data)
                            <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                {{ $data->mitra->nama_mitra }} - {{ $data->nama_kerja_sama }}</option>
                        @endforeach
                    </select>
                    @error('kerjasamas')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bentuk Kegiatan --}}
                <div class="form-group">
                    <label for="bentuk_kegiatan">Bentuk Kegiatan </label>
                    <input type="text" name='bentuk_kegiatan'
                        class="form-control @error('bentuk_kegiatan') is-invalid @enderror"
                        placeholder="Masukan Bentuk Kegiatan"
                        value="{{ old('bentuk_kegiatan', $kegiatans->bentuk_kegiatan) }}">
                    @error('bentuk_kegiatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Tanggal Mulai --}}
                    <div class="form-group col-lg-4">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="" class="form-control"
                            value='{{ old('tanggal_mulai', $kegiatans->tanggal_mulai) }}'>
                        @error('tanggal_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div class="form-group col-lg-4">
                        <label for="tanggal_sampai">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" id="" class="form-control"
                            value="{{ old('tanggal_sampai', $kegiatans->tanggal_sampai) }}">
                        @error('tanggal_sampai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PIC --}}
                    <div class="form-group col-lg-4">
                        <label for="PIC">PIC</label>

                        @php
                            if (old('PIC') !== null) {
                                $option = old('PIC');
                            } else {
                                $option = $kegiatans->PIC;
                            }
                        @endphp

                        <select class="form-control" name="PIC" id="">
                            <option value="F" <?= $option == 'F' ? 'selected' : '' ?>>Fakultas</option>
                            <option value="P" <?= $option == 'P' ? 'selected' : '' ?>>Program Studi</option>
                        </select>
                        @error('PIC')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" id=""
                        class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukan Keterangan"
                        value='{{ old('keterangan', $kegiatans->keterangan) }}'>
                    @error('keterangan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


            </div>

            {{-- Button Submit dan Kembali --}}
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/kegiatans" class="btn btn-outline-dark">Kembali</a>
            </div>

        </form>
    </div>
@endsection
