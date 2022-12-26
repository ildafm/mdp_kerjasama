@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')

    <script>
        function getTanggalDanSPK() {
            let kerjasamas = document.getElementById("kerjasamas");
            let tanggal_mulai = document.getElementById("tanggal_mulai");
            let tanggal_sampai = document.getElementById("tanggal_sampai");
            let spk = document.getElementById('spk')
            spk.innerHTML = ""

            let text = kerjasamas.options[kerjasamas.selectedIndex].text;
            let id_kerjasama = kerjasamas.options[kerjasamas.selectedIndex].value;
            // console.log(id_kerjasama)

            // Mengubah text menjadi array
            let texts = text.split("|");

            tanggal_mulai.setAttribute("min", texts[2]) //set atribut min tanggal mulai
            tanggal_mulai.setAttribute("max", texts[3]) //set atribut max tanggal mulai
            tanggal_mulai.setAttribute("value", texts[2]) //set atribut value tanggal mulai

            tanggal_sampai.setAttribute("min", texts[2]) //set atribut min tanggal sampai
            tanggal_sampai.setAttribute("max", texts[3]) //set atribut max tanggal sampai
            tanggal_sampai.setAttribute("value", texts[3]) //set atribut value tanggal sampai

            //get SPK
            fetch("{{ url('kegiatans/create/') }}/" + id_kerjasama)
                .then((response) => response.json())
                .then((data) => {
                    // console.log(data.spk)
                    let spk = data.spk
                    spk.forEach(getSPK);
                })
        }


        function getSPK(item, index) {
            // text += index + ": " + item + "<br>";
            // console.log(item)
            var option = document.createElement("option");
            option.value = item.id;
            option.text = item.nama_file;
            spk.appendChild(option);
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

                <div class="row">
                    {{-- Kerjasama --}}
                    <div class="form-group col-lg-6">
                        <label for="kerjasamas">Nama Kerjasama</label>

                        @php
                            if (old('kerjasamas') !== null) {
                                $option = old('kerjasamas');
                            } else {
                                $option = 1;
                            }
                        @endphp

                        <select class="form-control select2" name="kerjasamas" id="kerjasamas"
                            onchange="getTanggalDanSPK(); ">
                            <option value="">-- Pilih
                                Kerjasama --</option>
                            @if (count($kerjasamas) > 0)
                                @foreach ($kerjasamas as $data)
                                    <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama_kerja_sama }} | {{ $data->nama_mitra }}
                                        |{{ $data->tanggal_mulai }}|{{ $data->tanggal_sampai }}
                                    </option>

                                    {{-- <option value="{{ route('kegiatans.create'), ['id_kerjasama' => $data->id] }}"
                                        {{ $option == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama_kerja_sama }} | {{ $data->nama_mitra }}
                                        |{{ $data->tanggal_mulai }}|{{ $data->tanggal_sampai }}
                                    </option> --}}
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
                                $getIdFromSortingQuerry = DB::select('SELECT * FROM bentuk_kegiatans ORDER BY bentuk ASC LIMIT 1');
                                if (count($getIdFromSortingQuerry) > 0) {
                                    $option = $getIdFromSortingQuerry[0]->id;
                                }
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
                    {{-- Tanggal Mulai --}}
                    <div class="form-group col-lg-3">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                            value="{{ old('tanggal_mulai') }}" min="">
                        @error('tanggal_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div class="form-group col-lg-3">
                        <label for="tanggal_sampai">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control"
                            value="{{ old('tanggal_sampai') }}">
                        @error('tanggal_sampai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PIC --}}
                    <div class="form-group col-lg-3">
                        <label for="pic_dosen">PIC</label>

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
                    {{-- SPK --}}
                    <div class="form-group col-lg-3">
                        <label for="spk">SPK</label>

                        {{-- @php
                            if (old('spk') !== null) {
                                $option = old('spk');
                            } else {
                                $SPK = DB::select("SELECT * FROM bukti_kerjasamas
                                WHERE jenis_file = 'S' AND kerjasama_id = $kerjasama->id");
                                if (count($SPK) > 0) {
                                    $option = $getIdFromSortingQuerry[0]->id;
                                }
                                $option = 1;
                            }
                        @endphp --}}

                        <select class="form-control select2" name="spk" id="spk">
                            <option value="">-- Pilih SPK --</option>
                            @foreach ($SPK as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_file }}
                                </option>
                            @endforeach
                        </select>
                        @error('spk')
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

                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                {{-- &nbsp;
                <a href="/kegiatans" class="btn btn-outline-dark">Kembali</a> --}}
            </form>
        </div>
    </div>

    <script>
        // function getSPK() {
        //     fetch("{{ url('kegiatans/create/54') }}")
        //         .then((response) => response.json())
        //         .then((data) => console.log(data));
        // }
    </script>
@endsection
