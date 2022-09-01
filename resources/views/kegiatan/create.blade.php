@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')

    <script>
        getTanggal();

        function getTanggal() {
            let kerjasamas = document.getElementById("kerjasamas");
            let tanggal_mulai = document.getElementById("tanggal_mulai");
            let tanggal_sampai = document.getElementById("tanggal_sampai");
            let bentuk_kegiatan = document.getElementById("bentuk_kegiatan");

            let text = kerjasamas.options[kerjasamas.selectedIndex].text;
            // Mengubah text menjadi array
            let texts = text.split("|");

            tanggal_mulai.setAttribute("min", texts[2]) //set atribut min tanggal mulai
            tanggal_mulai.setAttribute("max", texts[3]) //set atribut max tanggal mulai
            tanggal_mulai.setAttribute("value", texts[2]) //set atribut value tanggal mulai

            tanggal_sampai.setAttribute("min", texts[2]) //set atribut min tanggal sampai
            tanggal_sampai.setAttribute("max", texts[3]) //set atribut max tanggal sampai
            tanggal_sampai.setAttribute("value", texts[3]) //set atribut value tanggal sampai
        }
    </script>

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
                    <label for="kerjasamas">Nama Kerjasama</label>

                    @php
                        if (old('kerjasamas') !== null) {
                            $option = old('kerjasamas');
                        } else {
                            $option = 1;
                        }
                    @endphp

                    <select class="form-control select2" name="kerjasamas" id="kerjasamas" onchange="getTanggal()">
                        <option value="">-- Pilih Kerjasama --</option>
                        @foreach ($kerjasamas as $data)
                            <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                {{ $data->nama_kerja_sama }} | {{ $data->usulan->mitra->nama_mitra }}
                                |{{ $data->tanggal_mulai }}|{{ $data->tanggal_sampai }}
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
                    <input id="bentuk_kegiatan" type="text" name='bentuk_kegiatan' value="{{ old('bentuk_kegiatan') }}"
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
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                            value="{{ old('tanggal_mulai') }}" min="">
                        @error('tanggal_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div class="form-group col-lg-4">
                        <label for="tanggal_sampai">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control"
                            value="{{ old('tanggal_sampai') }}">
                        @error('tanggal_sampai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Dosen --}}
                    <div class="form-group col-lg-4">
                        <label for="pic_dosen">PIC Dosen</label>

                        @php
                            if (old('pic_dosen') !== null) {
                                $option = old('pic_dosen');
                            } else {
                                $option = 1;
                            }
                        @endphp

                        <select class="form-control select2" name="pic_dosen" id="">
                            @foreach ($users as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->kode_dosen }} - {{ $data->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('pic_dosen')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PIC --}}
                    {{-- <div class="form-group col-lg-4">
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
                    </div> --}}
                </div>

                {{-- get Dosen/User --}}
                {{-- <input type="hidden" name="user" value="{{ Auth::user()->id }}" class="form-control" readonly> --}}

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" id="" value="{{ old('keterangan') }}"
                        class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukan Keterangan">
                    @error('keterangan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/kegiatans" class="btn btn-outline-dark">Kembali</a>
            </form>
        </div>
    </div>
@endsection
