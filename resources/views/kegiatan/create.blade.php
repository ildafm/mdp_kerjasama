@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Kegiatan</h3>

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
            <form action="{{ route('kegiatans.store') }}" method="POST">
                @csrf

                {{-- Kerjasama --}}
                <div class="form-group">
                    <label for="kerjasamas">Kerjasama</label>

                    @php
                        if (old('kerjasamas') !== null) {
                            $option = old('kerjasamas');
                        } else {
                            $option = 1;
                        }
                    @endphp

                    <select class="form-control select2" name="kerjasamas" id="">
                        @foreach ($kerjasamas as $data)
                            <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                {{ $data->mitra->nama_mitra }} - {{ $data->nama_kerja_sama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kerjasamas')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bentuk Kegiatan --}}
                <div class="form-group">
                    <label for="bentuk_kegiatan">Bentuk Kegiatan </label>
                    <input type="text" name='bentuk_kegiatan' value="{{ old('bentuk_kegiatan') }}"
                        class="form-control @error('bentuk_kegiatan') is-invalid @enderror"
                        placeholder="Masukan Bentuk Kegiatan">
                    @error('bentuk_kegiatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Tanggal Mulai --}}
                    <div class="form-group col-lg-4">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="" class="form-control"
                            value="{{ old('tanggal_mulai') }}">
                        @error('tanggal_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div class="form-group col-lg-4">
                        <label for="tanggal_sampai">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" id="" class="form-control"
                            value="{{ old('tanggal_sampai') }}">
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
                                $option = 'F';
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

                <div class="row">
                    {{-- Dosen --}}
                    <div class="form-group col-lg-4">
                        <label for="dosens">Dosen</label>

                        @php
                            if (old('dosens') !== null) {
                                $option = old('dosens');
                            } else {
                                $option = 1;
                            }
                        @endphp

                        <select class="form-control select2" name="dosens" id="">
                            @foreach ($dosens as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->id }} - {{ $data->kode_dosen }} - {{ $data->nama_dosen }}
                                </option>
                            @endforeach
                        </select>
                        @error('dosens')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" id="" value="{{ old('keterangan') }}"
                        class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukan Keterangan">
                    @error('keterangan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            &nbsp;
            <a href="/kegiatans" class="btn btn-outline-dark">Kembali</a>
        </div>

    </div>


    </form>

@endsection
