@extends('layouts.master')
@section('title', 'Usulan')

@section('content')
    {{-- card informasi lengkap terkait usulan --}}
    <div class="card">
        <div class="card-header">
            {{-- Button Kembali --}}
            <a href="{{ url('/usulans') }}" class='btn btn-primary'>Kembali</a>

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
                        <td>Usulan</td>
                        <td>{{ $usulan->usulan }}</td>
                    </tr>

                    <tr>
                        <td>Bentuk Kerjasama</td>
                        <td>{{ $usulan->bentuk_kerjasama }}</td>
                    </tr>

                    <tr>
                        <td>Rencana Kegiatan</td>
                        <td>{{ $usulan->rencana_kegiatan }}</td>
                    </tr>

                    <tr>
                        <td>Nama Mitra</td>
                        <td>{{ $usulan->mitra->nama_mitra }}</td>
                    </tr>

                    <tr>
                        <td>Kontak Kerjasama</td>
                        <td>{{ $usulan->kontak_kerjasama }}</td>
                    </tr>

                    <tr>
                        <td>Nama Pengusul</td>
                        <td>{{ $usulan->user->name }}</td>
                    </tr>

                    <tr>
                        <td>Nama Unit</td>
                        <td>{{ $usulan->unit->nama_unit }}</td>
                    </tr>

                    <tr>
                        <td>Hasil Penjajakan</td>
                        <td>
                            @php
                                if ($usulan->hasil_penjajakan == null || $usulan->hasil_penjajakan == '') {
                                    echo 'Belum Ditentukan';
                                } elseif ($usulan->hasil_penjajakan == 'L') {
                                    echo 'Lanjut';
                                } else {
                                    echo 'Tidak Lanjut';
                                }
                            @endphp
                        </td>
                    </tr>

                    <tr>
                        <td>Keterangan Hasil Penjajakan</td>
                        <td>
                            @if ($usulan->keterangan == null || $usulan->keterangan == '')
                                Belum ada keterangan
                            @else
                                {{ $usulan->keterangan }}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Type</td>
                        <td>
                            @if ($usulan->type == 'I')
                                IN
                            @else
                                OUT
                            @endif
                        </td>
                    </tr>
                    @if ($usulan->hasil_penjajakan == 'B' && Auth::user()->level != 'D')
                        <tr>
                            <td>Aksi</td>
                            <td>
                                {{-- Button Ubah --}}
                                <a href="{{ route('usulans.edit', ['usulan' => $usulan->id]) }}"
                                    class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit" title="Edit"></i></a>
                                @if (Auth::user()->level == 'A')
                                    {{-- Button Hapus --}}
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $usulan->id }}"
                                        data-namaUsulan="{{ $usulan->usulan }}" data-toggle="modal"
                                        data-target="#modal-sm"><i class="nav-icon fas fa-trash"
                                            title="Hapus"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @if ($usulan->hasil_penjajakan == 'L')
        @if (Auth::user()->level != 'D')
            <script>
                function getStatus(status) {
                    let nk = document.getElementById("nama_kategori")

                    let no_mou = document.getElementById("no_mou")

                    no_mou.readOnly = false
                    if (nk.value == "1") {
                        no_mou.readOnly = false
                    } else {
                        no_mou.value = ""
                        no_mou.readOnly = true
                    }
                }
            </script>
            {{-- Card Menambah Data Kerjasama --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Menambah Data Kerjasama</h3>
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
                    {{-- Form tambah data kerjasamas --}}
                    <form action="{{ route('usulans.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            {{-- Nomor MoU --}}
                            <div class="form-group col-lg-8">
                                <label for="no_mou">Nomor MoU</label>
                                <input type="text" id="no_mou" name='no_mou' value="{{ old('no_mou') }}"
                                    class="form-control @error('no_mou') is-invalid @enderror"
                                    placeholder="Masukan Nomor MoU">
                                @error('no_mou')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kategori --}}
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="nama_kategori">Kategori</label>

                                @php
                                    if (old('nama_kategori') !== null) {
                                        $option = old('nama_kategori');
                                    } else {
                                        $option = 1;
                                    }
                                @endphp

                                <select class="form-control" id="nama_kategori" name='nama_kategori'
                                    onchange="getStatus(this)">
                                    @foreach ($kategoris as $data)
                                        <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('nama_kategori')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Nama Kerjasama --}}
                        <div class="form-group">
                            <label for="nama_kerja_sama">Nama Kerjasama</label>
                            <input type="text" name='nama_kerja_sama' value="{{ old('nama_kerja_sama') }}"
                                class="form-control @error('nama_kerja_sama') is-invalid @enderror"
                                placeholder="Masukan Nama Kerjasama">
                            @error('nama_kerja_sama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            {{-- Tanggal Mulai --}}
                            <div class="form-group col-lg-4">
                                <label for="tanggal_mulai">Tanggal Mulai : </label>
                                <input type="date" name="tanggal_mulai" id="" class="form-control"
                                    value="{{ old('tanggal_mulai') }}">
                                @error('tanggal_mulai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal Sampai --}}
                            <div class="form-group col-lg-4">
                                <label for="tanggal_sampai">Tanggal Sampai : </label>
                                <input type="date" name="tanggal_sampai" id="" class="form-control"
                                    value="{{ old('tanggal_sampai') }}">
                                @error('tanggal_sampai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nama Status --}}
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="nama_status">Status</label>

                                @php
                                    if (old('nama_status') !== null) {
                                        $option = old('nama_status');
                                    } else {
                                        $option = 1;
                                    }
                                @endphp

                                <select class="form-control" name='nama_status'>
                                    @foreach ($statuses as $data)
                                        <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama_status }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('nama_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- getUsulanID --}}
                        <div class="form-group" hidden>
                            <label for="usulan_id">Usulan ID</label>
                            <input type="text" name='usulan_id' value="{{ $usulan->id }}"
                                class="form-control @error('usulan_id') is-invalid @enderror"
                                placeholder="Masukan Usulan ID" readonly>
                            @error('usulan_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        {{-- Button Submit --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        @endif

        {{-- tabel Daftar Kerjasama --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabel Daftar Kerjasama</h3>
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
                {{-- Tabel Data --}}
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Nama Kerjasama</th>
                            <th>Nomor MoU</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Sampai</th>
                            <th>Kategori</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1;
                        @endphp

                        @foreach ($getKerjasama as $data)
                            <tr>
                                <td>
                                    {{ $nomor++ }}
                                </td>

                                <td>
                                    {{-- Button Tampil --}}
                                    <a href="{{ url('kerjasamas/' . $data->id_kerjasama) }}"
                                        class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"
                                            title="Tampil"></i></a>

                                    @if (Auth::user()->level != 'D')
                                        {{-- Button Ubah --}}
                                        <a href="{{ route('kerjasamas.edit', ['kerjasama' => $data->id_kerjasama]) }}"
                                            class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit"
                                                title="Edit"></i></a>

                                        @if (Auth::user()->level == 'A')
                                            {{-- Button Hapus --}}
                                            <button class="btn btn-sm btn-danger btn-hapus"
                                                data-id_kerjasama="{{ $data->id_kerjasama }}"
                                                data-namaKerjasama="{{ $data->nama_kerja_sama }}" data-toggle="modal"
                                                data-target="#modal-sm"><i class="nav-icon fas fa-trash"
                                                    title="Hapus"></i></button>
                                        @endif
                                    @endif
                                </td>

                                <td>{{ $data->nama_kerja_sama }}</td>
                                <td>
                                    @if ($data->no_mou == '')
                                        Tanpa MoU
                                    @else
                                        {{ $data->no_mou }}
                                    @endif
                                </td>
                                <td>{{ $data->tanggal_mulai }}</td>
                                <td>{{ $data->tanggal_sampai }}</td>
                                <td>{{ $data->nama_kategori }}</td>
                                <td>{{ $data->nama_status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Nama Kerjasama</th>
                            <th>Nomor MoU</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Sampai</th>
                            <th>Kategori</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>
    @endif

    {{-- Modal Layout delete kerjasama --}}
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
                    <div class="modal-body" id="mb-konfirmasi">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Iya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Layout delete usulan --}}
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
                    <div class="modal-body" id="mb-konfirmasi">

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
    {{-- Script delete kerjasama --}}
    <script>
        // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
        // id disini adalah id kerjasama
        $('.btn-hapus').click(function() {
            let id_kerjasama = $(this).attr('data-id_kerjasama');
            $('#formDelete').attr('action', '/kerjasamas/customDestroyKerjasama/' + id_kerjasama);

            let nama_kerja_sama = $(this).attr('data-namaKerjasama');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus Kerjasama " + nama_kerja_sama + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

    {{-- Script delete usulan --}}
    <script>
        // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
        // id disini adalah id usulan
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/usulans/' + id);

            let namaUsulan = $(this).attr('data-namaUsulan');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus usulan : " + namaUsulan + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
