@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')

    <script>
        getTanggal();

        function getTanggal() {
            let kerjasamas = document.getElementById("kerjasamas");
            let tanggal_mulai = document.getElementById("tanggal_mulai");
            let tanggal_sampai = document.getElementById("tanggal_sampai");

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

        <div class="card-body">
            {{-- Form ubah data --}}
            <form action="{{ route('kegiatans.update', ['kegiatan' => $kegiatans->id]) }}" method="POST">
                @method('PUT')
                @csrf

                {{-- Kerjasama --}}
                <div class="form-group">
                    <label for="kerjasamas">Nama Kerjasama</label>
                    @php
                        if (old('kerjasamas') !== null) {
                            $option = old('kerjasamas');
                        } else {
                            $option = $kegiatans->kerjasama_id;
                        }
                    @endphp

                    <select class="form-control select2" name="kerjasamas" id="kerjasamas" onchange="getTanggal()">
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
                    <input type="text" name='bentuk_kegiatan'
                        class="form-control @error('bentuk_kegiatan') is-invalid @enderror"
                        placeholder="Masukan Bentuk Kegiatan"
                        value="{{ old('bentuk_kegiatan', $kegiatans->bentuk_kegiatan) }}">
                    @error('bentuk_kegiatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    @php
                        // Mengambil tanggal mulai dan tanggal sampai dari tabel kerjasama
                        // untuk dijadikan atribut max dan atribut min
                        $initial_tanggal_mulai_dan_tanggal_sampai_kerjasama = DB::select("SELECT kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai
                        FROM kerjasamas
                        JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
                        WHERE kegiatans.id = $kegiatans->id")
                    @endphp
                    {{-- Tanggal Mulai --}}
                    <div class="form-group col-lg-4">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                            value='{{ old('tanggal_mulai', $kegiatans->tanggal_mulai) }}' min="{{ $initial_tanggal_mulai_dan_tanggal_sampai_kerjasama[0]->tanggal_mulai }}" max="{{ $initial_tanggal_mulai_dan_tanggal_sampai_kerjasama[0]->tanggal_sampai }}">
                        @error('tanggal_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div class="form-group col-lg-4">
                        <label for="tanggal_sampai">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control"
                            value="{{ old('tanggal_sampai', $kegiatans->tanggal_sampai) }}" min="{{ $initial_tanggal_mulai_dan_tanggal_sampai_kerjasama[0]->tanggal_mulai }}" max="{{ $initial_tanggal_mulai_dan_tanggal_sampai_kerjasama[0]->tanggal_sampai }}">
                        @error('tanggal_sampai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PIC Dosen --}}
                    <div class="form-group col-lg-4">
                        <label for="pic_dosen">PIC Dosen</label>

                        @php
                            if (old('pic_dosen') !== null) {
                                $option = old('pic_dosen');
                            } else {
                                $option = $kegiatans->user_id;
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
                                $option = $kegiatans->PIC;
                            }
                        @endphp

                        <select class="form-control" name="PIC" id="">
                            <option value="F">Fakultas</option>
                            <option value="P">Program Studi</option>
                        </select>
                        @error('PIC')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
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

                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/kegiatans" class="btn btn-outline-dark">Kembali</a>
            </form>
        </div>
    </div>
@endsection
