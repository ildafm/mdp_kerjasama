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
            <h3 class="card-title">Ubah Data Kegiatan {{ $kegiatan->nama_kegiatan }}</h3>

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
            <form action="{{ route('kegiatans.update', ['kegiatan' => $kegiatan->id]) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="row">
                    {{-- Kerjasama --}}
                    <div class="form-group col-lg-6">
                        <label for="kerjasamas">Nama Kerjasama</label>
                        @php
                            if (old('kerjasamas') !== null) {
                                $option = old('kerjasamas');
                            } else {
                                $option = $kegiatan->kerjasama_id;
                            }
                        @endphp

                        <select class="form-control select2" name="kerjasamas" id="kerjasamas" onchange="getTanggal()">
                            @if (count($kerjasamas) > 0)
                                @foreach ($kerjasamas as $data)
                                    <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama_kerja_sama }} | {{ $data->nama_mitra }}
                                        |{{ $data->tanggal_mulai }}|{{ $data->tanggal_sampai }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('kerjasamas')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bentuk Kegiatan --}}
                    <div class="form-group col-lg-6">
                        <label for="bentuk_kegiatan">Bentuk Kegiatan</label>

                        @php
                            if (old('bentuk_kegiatan') !== null) {
                                $option = old('bentuk_kegiatan');
                            } else {
                                $option = $kegiatan->bentuk_kegiatan_id;
                            }
                        @endphp

                        <select class="form-control select2" name="bentuk_kegiatan" id="">
                            @foreach ($bentukKegiatans as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->bentuk }}
                                </option>
                            @endforeach
                        </select>
                        @error('bentuk_kegiatan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    @php
                        // Mengambil tanggal mulai dan tanggal sampai dari tabel kerjasama
                        // untuk dijadikan atribut max dan atribut min
                        $initial_tanggal_mulai_dan_tanggal_sampai_kerjasama = DB::select("SELECT kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai
                        FROM kerjasamas
                        JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
                        WHERE kegiatans.id = $kegiatan->id");
                    @endphp
                    {{-- Tanggal Mulai --}}
                    <div class="form-group col-lg-4">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                            value='{{ old('tanggal_mulai', $kegiatan->tanggal_mulai) }}'
                            min="{{ $initial_tanggal_mulai_dan_tanggal_sampai_kerjasama[0]->tanggal_mulai }}"
                            max="{{ $initial_tanggal_mulai_dan_tanggal_sampai_kerjasama[0]->tanggal_sampai }}">
                        @error('tanggal_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div class="form-group col-lg-4">
                        <label for="tanggal_sampai">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control"
                            value="{{ old('tanggal_sampai', $kegiatan->tanggal_sampai) }}"
                            min="{{ $initial_tanggal_mulai_dan_tanggal_sampai_kerjasama[0]->tanggal_mulai }}"
                            max="{{ $initial_tanggal_mulai_dan_tanggal_sampai_kerjasama[0]->tanggal_sampai }}">
                        @error('tanggal_sampai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PIC --}}
                    <div class="form-group col-lg-4">
                        <label for="pic_dosen">PIC</label>

                        @php
                            if (old('pic_dosen') !== null) {
                                $option = old('pic_dosen');
                            } else {
                                $option = $kegiatan->user_id;
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

                </div>

                {{-- Keterangan --}}
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" id=""
                        class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukan Keterangan"
                        value='{{ old('keterangan', $kegiatan->keterangan) }}'>
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
