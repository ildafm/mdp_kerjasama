@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')

    <div class="card">
        <div class="card-header">
            @if (Auth::user()->level != 'D')
                {{-- Button Tambah --}}
                <a href="{{ url('/kegiatans/create') }}" class='btn btn-primary'>Tambah Kegiatan</a>
            @else
                <div class="card-title">
                    <h4 class="">Tabel Daftar Kegiatan</h4>
                </div>
            @endif

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

            {{-- form untuk memfilter kegiatan berdasarkan tanggal mulai dan tanggal sampai --}}
            <form action="{{ route('kegiatans.index') }}" method="GET">
                @csrf
                <label for="filter">Filter berdasarkan tanggal</label>
                <div class="row">
                    <div class="form-group col-lg-2">
                        <input type="date" name="filter_tanggal_mulai" class="form-control" value="{{ $tanggal_mulai }}">
                    </div>
                    <span class="btn">Sampai</span>
                    <div class="form-group col-lg-2">
                        <input type="date" name="filter_tanggal_sampai" class="form-control"
                            value="{{ $tanggal_sampai }}">
                    </div>
                    <div class="form-group col-lg-2">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>

            {{-- Tabel Data --}}
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama Kerjasama</th>
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
                        <tr>
                            <td>{{ $nomor++ }}</td>

                            <td>
                                {{-- Button Tampil --}}
                                <a href="{{ url('kegiatans/' . $data->id) }}" class="btn btn-sm btn-primary"><i
                                        class="nav-icon fas fa-eye" title="Tampil"></i></a>

                                @if (Auth::user()->level != 'D')
                                    {{-- Button Ubah --}}
                                    <a href="{{ route('kegiatans.edit', ['kegiatan' => $data->id]) }}"
                                        class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit"
                                            title="Edit"></i></a>

                                    @if (Auth::user()->level == 'A')
                                        {{-- Button Hapus --}}
                                        <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $data->id }}"
                                            data-bentukKegiatan="{{ $data->bentuk_kegiatan }}" data-toggle="modal"
                                            data-target="#modal-sm"><i class="nav-icon fas fa-trash"
                                                title="Hapus"></i></button>
                                    @endif
                                @endif
                            </td>

                            <td>{{ $data->kerjasama->nama_kerja_sama }}</td>

                            <td>{{ $data->bentuk_kegiatan }}</td>

                            <td>{{ $data->keterangan }}</td>

                            <td>{{ $data->user->name }}</td>

                            <td>{{ $data->tanggal_mulai }}</td>

                            <td>{{ $data->tanggal_sampai }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama Kerjasama</th>
                        <th>Bentuk Kegiatan</th>
                        <th>Keterangan</th>
                        <th>PIC Dosen</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Sampai</th>
                    </tr>
                </tfoot>

            </table>

        </div>

    </div>

    {{-- Modal Layout --}}
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
                        {{-- <p>Apakah anda yakin ingin menghapus data ini?</p> --}}
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
    <script>
        // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
        // id disini adalah id kegiatan
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/kegiatans/' + id);

            let dataBentukKegiatan = $(this).attr('data-bentukKegiatan')
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus kegiatan : " + dataBentukKegiatan +
                " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
