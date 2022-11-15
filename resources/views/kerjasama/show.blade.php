@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    {{-- Menu Show --}}
    <div class="card">
        <div class="card-header">
            {{-- Button Kembali --}}
            <a href="{{ url('/kerjasamas') }}" class='btn btn-primary'>Kembali</a>

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
                        <td>Nomor Mou</td>
                        <td>
                            @if ($kerjasama->no_mou == '')
                                Tanpa MoU
                            @else
                                {{ $kerjasama->no_mou }}
                            @endif
                        </td>
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
                    @if ($kerjasama->status_id != '2' && Auth::user()->level != 'D')
                        {{-- Jika kerjasama tidak memiliki file spk maka form untuk tambah data tidak akan ditampilkan --}}
                        @if (count($kerjasamaBelumMemilikiFileSPK) > 0)
                            <h3>Kerjasama ini belum memiliki file SPK</h3>
                            <p>Silahkan tambahkan file SPK terlebih dahulu di bagian file kerjasama untuk dapat menambahkan
                                kegiatan</p>
                        @else
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
                                    <div class="form-group col-lg-4">
                                        <label for="tanggal_mulai">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" id="" class="form-control"
                                            min="{{ $kerjasama->tanggal_mulai }}" max="{{ $kerjasama->tanggal_sampai }}"
                                            value="{{ old('tanggal_mulai') }}">
                                        @error('tanggal_mulai')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tanggal Sampai --}}
                                    <div class="form-group col-lg-4">
                                        <label for="tanggal_sampai">Tanggal Sampai</label>
                                        <input type="date" name="tanggal_sampai" id="" class="form-control"
                                            min="{{ $kerjasama->tanggal_mulai }}" max="{{ $kerjasama->tanggal_sampai }}"
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

                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" id="" value="{{ old('keterangan') }}"
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
                    @endif

                    @if (Auth::user()->level != 'D')
                        {{-- Jika file belum memiliki spk dan user sekarang bukan dosen, maka tabel ini tidak akan ditampilkan --}}
                        @if (count($kerjasamaBelumMemilikiFileSPK) < 1)
                            {{-- info no mou --}}
                            <h3>
                                @if ($kerjasama->no_mou != null || $kerjasama->no_mou != '')
                                    Nomor MoU : {{ $kerjasama->no_mou }}
                                @else
                                    Tanpa MoU
                                @endif
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
                                    </tr>
                                </tfoot>

                            </table>
                        @endif
                    @else
                        {{-- Jika login adalah dosen, dan kerjasama belum memiliki spk, maka menampilkan tabel koson --}}
                        {{-- info no mou --}}
                        <h3>
                            @if ($kerjasama->no_mou != null || $kerjasama->no_mou != '')
                                Nomor MoU : {{ $kerjasama->no_mou }}
                            @else
                                Tanpa MoU
                            @endif
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
                                        placeholder="Enter Nama File" value="{{ old('nama_file') }}">

                                    @error('nama_file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Jenis File --}}
                                <div class="form-group col-lg-4">
                                    <label for="jenis_file">Jenis File</label>

                                    @php
                                        if (old('jenis_file') !== null) {
                                            $option = old('jenis_file');
                                        } else {
                                            $option = 'B';
                                        }
                                    @endphp

                                    <select class="form-control" name="jenis_file" id="">
                                        <option value="B" {{ $option == 'B' ? 'selected' : '' }}>
                                            Bukti Kerjasama
                                        </option>
                                        <option value="S" {{ $option == 'S' ? 'selected' : '' }}>
                                            SPK
                                        </option>
                                        @if ($kerjasama->kategori_id == '1')
                                            <option value="M" {{ $option == 'M' ? 'selected' : '' }}>
                                                MoU
                                            </option>
                                        @endif
                                    </select>

                                    @error('jenis_file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- add file --}}
                            <div class="form-group">
                                <label for="file">Masukan File(Max:5mb)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file"
                                            id="exampleInputFile">
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
                                <th>Nama File Kerjasama</th>
                                <th>Jenis File</th>
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
                                    <td>
                                        {{-- Button Tampil --}}
                                        <a href="{{ url('storage/kerjasama/' . $data->file) }}"
                                            class="btn btn-sm btn-primary">
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
                                    <td>
                                        @php
                                            if ($data->jenis_file == 'M') {
                                                echo 'MoU';
                                            } elseif ($data->jenis_file == 'S') {
                                                echo 'SPK';
                                            } else {
                                                echo 'Bukti Kerjasama';
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ $data->tanggalUpload }}</td>
                                </tr>
                            @endforeach

                        </tbody>

                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama File Kerjasama</th>
                                <th>Jenis File</th>
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
