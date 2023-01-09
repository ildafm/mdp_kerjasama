@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    <script>
        document.getElementById("nomor_file").addEventListener("load", getStatus(@php echo old('jenis_file') @endphp));

        function getStatus(status) {
            let jenis_file = document.getElementById("jenis_file")
            let nomor_file = document.getElementById("nomor_file")

            let opt_kategori_mou = document.getElementsByName("opt_kategori_mou")
            let select_kategori_mou = document.getElementById("select_kategori_mou")
            let bukan_mou = document.getElementById("bukan_mou")

            if (jenis_file.value != "L") {
                nomor_file.readOnly = false
                nomor_file.required = true

            } else {
                nomor_file.value = ""
                nomor_file.readOnly = true
                nomor_file.required = false
            }

            if (jenis_file.value == "M") {
                select_kategori_mou.value = 1
                for (let i = 0; i < opt_kategori_mou.length; i++) {
                    opt_kategori_mou[i].hidden = false;
                }
                bukan_mou.hidden = true
            } else {
                select_kategori_mou.value = ""
                for (let i = 0; i < opt_kategori_mou.length; i++) {
                    opt_kategori_mou[i].hidden = true;
                }
                bukan_mou.hidden = false
            }


        }
    </script>

    {{-- Menu Show --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $kerjasama->nama_kerja_sama }}</h3>

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
            {{-- Tampilkan Pesan --}}
            @if (session()->has('pesan'))
                <div class='alert alert-success'>
                    {{ session()->get('pesan') }}
                </div>
            @endif

            {{-- Tabel Data --}}
            <table id="" class="table table-bordered table-striped">

                <tbody>
                    <tr>
                        <td>Nama Kerjasama</td>
                        <td>{{ $kerjasama->nama_kerja_sama }}</td>
                    </tr>

                    <tr>
                        <td>Bidang</td>
                        <td>
                            @php
                                if ($kerjasama->bidang == 'P') {
                                    echo 'Pendidikan';
                                } elseif ($kerjasama->bidang == 'N') {
                                    echo 'Penelitian';
                                } elseif ($kerjasama->bidang == 'B') {
                                    echo 'Pengabdian';
                                } elseif ($kerjasama->bidang == 'A') {
                                    echo 'Pendidikan, Penelitian, Pengabdian';
                                } else {
                                    echo 'Lain-lain';
                                }
                            @endphp
                        </td>
                    </tr>

                    <tr>
                        <td>Tanggal Mulai</td>
                        <td>{{ $kerjasama->tanggal_mulai }}</td>
                    </tr>

                    <tr>
                        <td>Tanggal Sampai</td>
                        <td>{{ $kerjasama->tanggal_sampai }}</td>
                    </tr>

                    <tr>
                        <td>Kategori</td>
                        <td>{{ $kerjasama->kategori->nama_kategori }}</td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>{{ $kerjasama->status->nama_status }}</td>
                    </tr>

                    <tr>
                        <td>Usulan</td>
                        <td>{{ $kerjasama->usulan->usulan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Navbar Data File Kerjasama dan Kegiatan --}}
    <div class="card card-default card-tabs">
        {{-- Navbar --}}
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="pt-2 px-3">
                    <h3 class="card-title">Data</h3>
                </li>
                {{-- Nav Kegiatan --}}
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-kegiatan-tab" data-toggle="pill"
                        href="#custom-tabs-two-kegiatan" role="tab" aria-controls="custom-tabs-two-kegiatan"
                        aria-selected="true">Kegiatan</a>
                </li>

                {{-- Nav File Kerjasama --}}
                <li class="nav-item active">
                    <a class="nav-link" id="custom-tabs-two-file_kerjasama-tab" data-toggle="pill"
                        href="#custom-tabs-two-file_kerjasama" role="tab" aria-controls="custom-tabs-two-file_kerjasama"
                        aria-selected="false">File Kerjasama</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
                {{-- Panel Kegiatan --}}
                <div class="tab-pane fade show active" id="custom-tabs-two-kegiatan" role="tabpanel"
                    aria-labelledby="custom-tabs-two-kegiatan-tab">
                    @php
                        $getKerjasamaID = $kerjasama->id;
                        $kerjasamaBelumMemilikiFileSPK = DB::select("SELECT * FROM kerjasamas WHERE id NOT IN ( SELECT kerjasama_id FROM bukti_kerjasamas WHERE bukti_kerjasamas.jenis_file = 'S') AND id = $getKerjasamaID");
                    @endphp
                    {{-- Form Menambahkan data Kegiatan jika kerjasama tidak kadaluarsa dan login bukan dosen --}}
                    @if (Auth::user()->level != 'D')
                        {{-- Jika kerjasama tidak memiliki file spk maka form untuk tambah data kegiatan tidak akan ditampilkan --}}
                        @if (count($kerjasamaBelumMemilikiFileSPK) > 0)
                            @if ($kerjasama->status_id != 2)
                                <h3>Kerjasama ini belum memiliki file SPK/MoA</h3>
                                <p>Silahkan tambahkan file SPK/MoA terlebih dahulu di bagian file kerjasama untuk dapat
                                    menambahkan
                                    kegiatan</p>
                            @else
                                <h3>Kerjasama ini sudah kadaluarsa dan belum memiliki file SPK/MoA</h3>
                            @endif
                        @elseif($kerjasama->status_id == 2)
                            <h2>Kerjasama ini sudah kadaluarsa</h2>
                        @else
                            {{-- Form tambah data kegiatan --}}
                            <h3>Tambah Data Kegiatan</h3>
                            <form action="{{ route('kerjasamas.store') }}" method="POST">
                                @csrf

                                {{-- getKerjasamaID --}}
                                <div class="form-group" hidden>
                                    <label for="kerjasama_id">getKerjasamaID </label>
                                    <input type="text" name='kerjasama_id' value="{{ $kerjasama->id }}"
                                        class="form-control @error('kerjasama_id') is-invalid @enderror"
                                        placeholder="Masukan ID Kerjasama" readonly>
                                    @error('kerjasama_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Bentuk Kegiatan --}}
                                <div class="form-group">
                                    <label for="bentuk_kegiatan">Bentuk Kegiatan </label>

                                    @php
                                        if (old('bentuk_kegiatan') !== null) {
                                            $option = old('bentuk_kegiatan');
                                        } else {
                                            $option = 1;
                                        }
                                    @endphp

                                    <select class="form-control select2" name="bentuk_kegiatan" id="">
                                        @foreach ($bentukKegiatans as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $option == $data->id ? 'selected' : '' }}>
                                                {{ $data->bentuk }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bentuk_kegiatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    {{-- Tanggal Mulai --}}
                                    <div class="form-group col-lg-3">
                                        <label for="tanggal_mulai">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" id="" class="form-control"
                                            min="{{ $kerjasama->tanggal_mulai }}" max="{{ $kerjasama->tanggal_sampai }}"
                                            value="{{ old('tanggal_mulai') }}">
                                        @error('tanggal_mulai')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tanggal Sampai --}}
                                    <div class="form-group col-lg-3">
                                        <label for="tanggal_sampai">Tanggal Sampai</label>
                                        <input type="date" name="tanggal_sampai" id="" class="form-control"
                                            min="{{ $kerjasama->tanggal_mulai }}" max="{{ $kerjasama->tanggal_sampai }}"
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
                                                <option value="{{ $data->id }}"
                                                    {{ $option == $data->id ? 'selected' : '' }}>
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

                                        @php
                                            if (old('spk') !== null) {
                                                $option = old('spk');
                                            } else {
                                                $option = 1;
                                            }
                                        @endphp

                                        <select class="form-control select2" name="spk" id="">
                                            @foreach ($SPK as $data)
                                                <option value="{{ $data->id }}"
                                                    {{ $option == $data->id ? 'selected' : '' }}>
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
                                    <input type="text" name="keterangan" id=""
                                        value="{{ old('keterangan') }}"
                                        class="form-control @error('keterangan') is-invalid @enderror"
                                        placeholder="Masukan Keterangan">
                                    @error('keterangan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <br>
                                {{-- Button --}}
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        @endif
                        <br><br>

                        {{-- Jika Kerjasama ini sudah kadaluarsa --}}

                    @endif

                    @if (Auth::user()->level != 'D')
                        {{-- Jika file belum memiliki spk dan user sekarang bukan dosen, maka tabel ini tidak akan ditampilkan --}}
                        @if (count($kerjasamaBelumMemilikiFileSPK) < 1)
                            <h3>
                                Tabel Daftar Kegiatan
                            </h3>
                            {{-- Tabel data Kegiatan --}}
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>Bentuk Kegiatan</th>
                                        <th>Keterangan</th>
                                        <th>PIC</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Sampai</th>
                                        <th>Mengacu pada SPK</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @php
                                        $nomor = 1;
                                    @endphp

                                    @foreach ($kegiatans as $data)
                                        @if ($data->kerjasama_id == $kerjasama->id)
                                            <tr>
                                                <td>{{ $nomor++ }}</td>

                                                <td>
                                                    {{-- Button Tampil --}}
                                                    <a href="{{ url('kegiatans/' . $data->id) }}"
                                                        class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"
                                                            title="Tampil"></i></a>

                                                    @if (Auth::user()->level != 'D')
                                                        {{-- Button Ubah --}}
                                                        <a href="{{ route('kegiatans.edit', ['kegiatan' => $data->id]) }}"
                                                            class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit"
                                                                title="Edit"></i></a>
                                                    @endif

                                                    @if (Auth::user()->level == 'A')
                                                        {{-- Button Hapus --}}
                                                        <button class="btn btn-sm btn-danger btn-hapus-kegiatan"
                                                            data-id-kegiatan="{{ $data->id }}"
                                                            data-bentukKegiatan="{{ $data->bentukKegiatan->bentuk }}"
                                                            data-toggle="modal" data-target="#modal-sm-kegiatan"><i
                                                                class="nav-icon fas fa-trash" title="Hapus"></i></button>
                                                    @endif
                                                </td>

                                                <td>{{ $data->bentukKegiatan->bentuk }}</td>

                                                <td>{{ $data->keterangan }}</td>

                                                <td>{{ $data->user->name }}</td>

                                                <td>{{ $data->tanggal_mulai }}</td>

                                                <td>{{ $data->tanggal_sampai }}</td>

                                                <td>{{ $data->buktiKerjasamaSpk->nama_file }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>Bentuk Kegiatan</th>
                                        <th>Keterangan</th>
                                        <th>PIC Dosen</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Sampai</th>
                                        <th>Mengacu pada SPK</th>
                                    </tr>
                                </tfoot>

                            </table>
                        @endif
                    @else
                        {{-- Jika login adalah dosen, dan kerjasama belum memiliki spk, maka menampilkan tabel kosong --}}
                        <h3>
                            Tabel Daftar Kegiatan
                        </h3>
                        {{-- Tabel data Kegiatan --}}
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Bentuk Kegiatan</th>
                                    <th>Keterangan</th>
                                    <th>PIC Dosen</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Sampai</th>
                                    <th>Mengacu pada SPK</th>
                                </tr>
                            </thead>

                            <tbody>

                                @php
                                    $nomor = 1;
                                @endphp

                                @foreach ($kegiatans as $data)
                                    @if ($data->kerjasama_id == $kerjasama->id)
                                        <tr>
                                            <td>{{ $nomor++ }}</td>

                                            <td>
                                                {{-- Button Tampil --}}
                                                <a href="{{ url('kegiatans/' . $data->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"
                                                        title="Tampil"></i></a>

                                                @if (Auth::user()->level != 'D')
                                                    {{-- Button Ubah --}}
                                                    <a href="{{ route('kegiatans.edit', ['kegiatan' => $data->id]) }}"
                                                        class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit"
                                                            title="Edit"></i></a>
                                                @endif

                                                @if (Auth::user()->level == 'A')
                                                    {{-- Button Hapus --}}
                                                    <button class="btn btn-sm btn-danger btn-hapus-kegiatan"
                                                        data-id-kegiatan="{{ $data->id }}"
                                                        data-bentukKegiatan="{{ $data->bentukKegiatan->bentuk }}"
                                                        data-toggle="modal" data-target="#modal-sm-kegiatan"><i
                                                            class="nav-icon fas fa-trash" title="Hapus"></i></button>
                                                @endif
                                            </td>

                                            <td>{{ $data->bentukKegiatan->bentuk }}</td>

                                            <td>{{ $data->keterangan }}</td>

                                            <td>{{ $data->user->name }}</td>

                                            <td>{{ $data->tanggal_mulai }}</td>

                                            <td>{{ $data->tanggal_sampai }}</td>

                                            <td>{{ $data->buktiKerjasamaSpk->nama_file }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Bentuk Kegiatan</th>
                                    <th>Keterangan</th>
                                    <th>PIC Dosen</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Sampai</th>
                                    <th>Mengacu pada SPK</th>
                                </tr>
                            </tfoot>

                        </table>
                    @endif
                </div>

                {{-- Panel File --}}
                <div class="tab-pane fade" id="custom-tabs-two-file_kerjasama" role="tabpanel"
                    aria-labelledby="custom-tabs-two-file_kerjasama-tab">
                    @if (Auth::user()->level != 'D')
                        {{-- Form Menambahkan data File --}}
                        <h3>Tambah Data File</h3>
                        <form action="{{ route('buktiKerjasamas.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- Nama File --}}
                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="nama_file">Nama File</label>
                                    <input type="text" class="form-control" name="nama_file"
                                        placeholder="Enter Nama File" value="{{ old('nama_file') }}" required>

                                    @error('nama_file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Jenis File --}}
                                <div class="form-group col-lg-2">
                                    <label for="jenis_file">Jenis File</label>

                                    @php
                                        if (old('jenis_file') !== null) {
                                            $option = old('jenis_file');
                                        } else {
                                            $option = 'B';
                                        }
                                    @endphp

                                    <select class="form-control" name="jenis_file" id="jenis_file"
                                        onchange="getStatus(this)">
                                        <option value="L" {{ $option == 'L' ? 'selected' : '' }}>
                                            Lain-lain
                                        </option>
                                        <option value="S" {{ $option == 'S' ? 'selected' : '' }}>
                                            SPK/MoA
                                        </option>
                                        @if ($kerjasama->kategori_id == '1')
                                            @php
                                                $getMoU = DB::select("SELECT kerjasamas.id, kerjasamas.nama_kerja_sama, bukti_kerjasamas.nama_file, bukti_kerjasamas.jenis_file
                                                FROM kerjasamas
                                                JOIN bukti_kerjasamas ON bukti_kerjasamas.kerjasama_id = kerjasamas.id
                                                WHERE kerjasamas.id = $kerjasama->id AND bukti_kerjasamas.jenis_file = 'M'");
                                            @endphp
                                            {{-- Jika 1 MoU sudah diupload, maka tidak bisa upload MoU lagi --}}
                                            @if (count($getMoU) < 1)
                                                <option value="M" {{ $option == 'M' ? 'selected' : '' }}>
                                                    MoU
                                                </option>
                                            @endif
                                        @endif
                                    </select>
                                    @error('jenis_file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- kategori mou --}}
                                <div class="form-group col-lg-2">
                                    <label for="kategori_mou">Kategori MoU</label>

                                    @php
                                        if (old('kategori_mou') !== null) {
                                            $option = old('kategori_mou');
                                        } else {
                                            $option = null;
                                        }
                                    @endphp

                                    <select class="form-control" name="kategori_mou" id="select_kategori_mou">
                                        <option value="" id="bukan_mou">
                                            -- Bukan MoU --
                                        </option>
                                        @foreach ($kategoriMous as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $option == $data->id ? 'selected' : '' }} name="opt_kategori_mou"
                                                hidden>
                                                {{ $data->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_mou')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- nomor file --}}
                            <div class="form-group">
                                <label for="nomor_file">Nomor File</label>
                                <input type="text" class="form-control" name="nomor_file" id="nomor_file"
                                    placeholder="Enter Nomor File" value="{{ old('nomor_file') }}" readonly>
                                @error('nomor_file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- add file --}}
                            <div class="form-group">
                                <label for="file">Upload File(pdf,jpg,png,docx,doc|Max:10MB)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file"
                                            id="exampleInputFile" required>
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

                            {{-- getKerjasamaID --}}
                            <input type="hidden" value="{{ $kerjasama->id }}" name="kerjasama_id">
                            @error('kerjasama_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <br>
                            {{-- Button --}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <br><br>
                    @endif
                    {{-- Tabel Data File Kerjasamas --}}
                    <h3>Tabel Data File Kerjasama</h3>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama File</th>
                                <th>Nomor File</th>
                                <th>Jenis File</th>
                                <th>Kategori MoU</th>
                                <th>Tanggal Upload</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                                $nomor = 1;
                            @endphp

                            @foreach ($buktiKerjasama as $data)
                                <tr>
                                    <td> {{ $nomor++ }} </td>
                                    {{-- Button Aksi --}}
                                    <td>
                                        {{-- Button Tampil --}}
                                        <a href="{{ url('storage/kerjasama/' . $data->file) }}"
                                            class="btn btn-sm btn-primary" target="_blank">
                                            <i class="nav-icon fas fa-eye" title="Tampil"></i></a>

                                        @if (Auth::user()->level != 'D')
                                            {{-- Button Ubah --}}
                                            <a href="{{ route('buktiKerjasamas.edit', ['buktiKerjasama' => $data->id]) }}"
                                                class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit"
                                                    title="Edit"></i></a>
                                        @endif

                                        @if (Auth::user()->level == 'A')
                                            {{-- Button Hapus --}}
                                            <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $data->id }}"
                                                data-namaFileKerjasama="{{ $data->nama_file }}" data-toggle="modal"
                                                data-target="#modal-sm">
                                                <i class="nav-icon fas fa-trash" title="Hapus"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ $data->nama_file }}</td>
                                    <td>{{ $data->nomor_file }}</td>
                                    <td>
                                        @php
                                            if ($data->jenis_file == 'M') {
                                                echo 'MoU';
                                            } elseif ($data->jenis_file == 'S') {
                                                echo 'SPK/MoA';
                                            } else {
                                                echo 'Lain-lain';
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ $data->nama_kategori }}</td>

                                    <td>{{ $data->tanggal_upload }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama File</th>
                                <th>Nomor File</th>
                                <th>Jenis File</th>
                                <th>Kategori MoU</th>
                                <th>Tanggal Upload</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Layout File --}}
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" method="POST" id="formDelete">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Peringatan !!!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="mb-konfirmasi-bukti">
                        {{-- <p id="text_modal"></p> --}}
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Iya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Layout Kegiatan --}}
    <div class="modal fade" id="modal-sm-kegiatan">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" method="POST" id="formDelete-kegiatan">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Peringatan !!!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="mb-konfirmasi-kegiatan">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Iya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    {{-- Script untuk hapus data file --}}
    <script>
        // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
        // id disini adalah id buktiKerjasama
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/buktiKerjasamas/' + id);

            let namaFileKerjasama = $(this).attr('data-namaFileKerjasama');
            $('#mb-konfirmasi-bukti').text("Apakah anda yakin ingin menghapus file : " + namaFileKerjasama + " ?")

        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

    {{-- Script untuk hapus data kegiatan --}}
    <script>
        // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
        // id disini adalah id kegiatan
        $('.btn-hapus-kegiatan').click(function() {
            let id_kegiatan = $(this).attr('data-id-kegiatan');
            $('#formDelete-kegiatan').attr('action', '/kegiatans/customDestroyKegiatan/' + id_kegiatan);

            let dataBentukKegiatan = $(this).attr('data-bentukKegiatan')
            $('#mb-konfirmasi-kegiatan').text("Apakah anda yakin ingin menghapus kegiatan : " + dataBentukKegiatan +
                " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete-kegiatan [type="submit"]').click(function() {
            $('#formDelete-kegiatan').submit();
        })
    </script>

@endsection
