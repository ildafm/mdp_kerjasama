@extends('layouts.master')
@section('title', 'Kerjasama Tanpa Kegiatan')

@section('content')
    {{-- Menu Show --}}
    <div class="card">
        <div class="card-header">

            {{-- Button Kembali --}}
            <a href="{{ url('/kerjasama_tanpa_kegiatans') }}" class='btn btn-primary'>Kembali</a>

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
                        <td>Nama Kerja Sama</td>
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
                        <td>Tanggal Mulai</td>
                        <td>{{ $kerjasama->tanggal_mulai }}</td>
                    </tr>

                    <tr>
                        <td>Tanggal Sampai</td>
                        <td>{{ $kerjasama->tanggal_sampai }}</td>
                    </tr>

                    <tr>
                        <td>Kategori</td>
                        <td>{{ $kerjasama->nama_kategori }}</td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>{{ $kerjasama->nama_status }}</td>
                    </tr>

                    <tr>
                        <td>Usulan</td>
                        <td>{{ $kerjasama->usulan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Navbar Data Bukti Kerjasama dan Kegiatan --}}
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
                {{-- Nav Bukti Kerjasama --}}
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-bukti_kerjasama-tab" data-toggle="pill"
                        href="#custom-tabs-two-bukti_kerjasama" role="tab"
                        aria-controls="custom-tabs-two-bukti_kerjasama" aria-selected="false">Bukti Kerjasama</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
                {{-- Panel Kegiatan --}}
                <div class="tab-pane fade show active" id="custom-tabs-two-kegiatan" role="tabpanel"
                    aria-labelledby="custom-tabs-two-kegiatan-tab">
                    @if (Auth::user()->level != 'D')
                        {{-- Form Menambahkan data Kegiatan --}}
                        <h3>Tambah Data Kegiatan</h3>
                        <form action="{{ route('kerjasama_tanpa_kegiatans.store') }}" method="POST">
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
                        <br><br>
                    @endif
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

                                                @if (Auth::user()->level == 'A')
                                                    {{-- Button Hapus --}}
                                                    <button class="btn btn-sm btn-danger btn-hapus-kegiatan"
                                                        data-id-kegiatan="{{ $data->id }}"
                                                        data-bentukKegiatan="{{ $data->bentuk_kegiatan }}"
                                                        data-toggle="modal" data-target="#modal-sm-kegiatan"><i
                                                            class="nav-icon fas fa-trash" title="Hapus"></i></button>
                                                @endif
                                            @endif
                                        </td>

                                        <td>{{ $data->bentuk_kegiatan }}</td>

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
                </div>

                {{-- Panel Bukti Kerjasama --}}
                <div class="tab-pane fade" id="custom-tabs-two-bukti_kerjasama" role="tabpanel"
                    aria-labelledby="custom-tabs-two-bukti_kerjasama-tab">
                    @if (Auth::user()->level != 'D')
                        {{-- Form Menambahkan data Bukti --}}
                        <h3>Tambah Data Bukti Kerjasama</h3>
                        <form action="{{ route('buktiKerjasama2s.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- Nama Bukti Kerjasama --}}
                            <div class="form-group">
                                <label for="nama_bukti_kerjasama">Nama Bukti Kerjasama</label>
                                <input type="text" class="form-control" name="nama_bukti_kerjasama"
                                    placeholder="Enter Nama Bukti Kerjasama" value="{{ old('nama_bukti_kerjasama') }}">

                                @error('nama_bukti_kerjasama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- add file --}}
                            <div class="form-group">
                                <label for="file">Bukti Kerjasama(Max:5mb)</label>
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
                            <button type="submit" class="btn btn-primary">Tambahkan Bukti</button>
                        </form>
                        <br><br>
                    @endif
                    {{-- Tabel Data Bukti Kerjasama --}}
                    <h3>Tabel Data Bukti Kerjasama</h3>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama Bukti Kerjasama</th>
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
                                            <a href="{{ route('buktiKerjasama2s.edit', ['buktiKerjasama2' => $data->id]) }}"
                                                class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit"
                                                    title="Edit"></i></a>

                                            @if (Auth::user()->level == 'A')
                                                {{-- Button Hapus --}}
                                                <button class="btn btn-sm btn-danger btn-hapus"
                                                    data-id="{{ $data->id }}"
                                                    data-namaBuktiKerjasama="{{ $data->nama_bukti_kerjasama }}"
                                                    data-toggle="modal" data-target="#modal-sm">
                                                    <i class="nav-icon fas fa-trash" title="Hapus"></i>
                                                </button>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $data->nama_bukti_kerjasama }}</td>
                                    <td>{{ $data->tanggalUpload }}</td>
                                </tr>
                            @endforeach

                        </tbody>

                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama Bukti Kerjasama</th>
                                <th>Tanggal Upload</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Layout Bukti --}}
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
    {{-- Script untuk hapus data bukti --}}
    <script>
        // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
        // id disini adalah id buktiKerjasama
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/buktiKerjasama2s/' + id);

            let namaBuktiKerjasama = $(this).attr('data-namaBuktiKerjasama');
            $('#mb-konfirmasi-bukti').text("Apakah anda yakin ingin menghapus bukti : " + namaBuktiKerjasama + " ?")
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
