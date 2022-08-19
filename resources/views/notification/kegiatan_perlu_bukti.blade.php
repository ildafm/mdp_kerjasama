@extends('layouts.master')
@section('title', 'Kegiatan Tanpa Bukti')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Kegiatan Tanpa Bukti</h3>
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

            {{-- Tabel Data untuk login admin --}}
            @if (Auth::user()->level != 'D')
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

                        @foreach ($listKegiatanTanpaBuktiForAdmin as $data)
                            @if ($data->total_bukti == 0)
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

                                            {{-- Button Hapus --}}
                                            <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $data->id }}"
                                                data-bentukKegiatan="{{ $data->bentuk_kegiatan }}" data-toggle="modal"
                                                data-target="#modal-sm"><i class="nav-icon fas fa-trash"
                                                    title="Hapus"></i></button>
                                        @endif
                                    </td>

                                    <td>{{ $data->nama_kerja_sama }}</td>

                                    <td>{{ $data->bentuk_kegiatan }}</td>

                                    <td>{{ $data->keterangan }}</td>

                                    <td>{{ $data->name }}</td>

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
                            <th>Nama Kerjasama</th>
                            <th>Bentuk Kegiatan</th>
                            <th>Keterangan</th>
                            <th>PIC Dosen</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Sampai</th>
                        </tr>
                    </tfoot>

                </table>

                {{-- Tabel Data Untuk login dosen --}}
            @else
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

                        @foreach ($listKegiatanTanpaBukti as $data)
                            @if ($data->total_bukti == 0)
                                <tr>
                                    <td>{{ $nomor++ }}</td>

                                    <td>
                                        {{-- Button Tampil --}}
                                        <a href="{{ url('kegiatans/' . $data->id) }}" class="btn btn-sm btn-primary"><i
                                                class="nav-icon fas fa-eye" title="Tampil"></i></a>
                                    </td>

                                    <td>{{ $data->nama_kerja_sama }}</td>

                                    <td>{{ $data->bentuk_kegiatan }}</td>

                                    <td>{{ $data->keterangan }}</td>

                                    <td>{{ $data->name }}</td>

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
                            <th>Nama Kerjasama</th>
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
