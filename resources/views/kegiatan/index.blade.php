@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')

    <div class="card">
        <div class="card-header">
            {{-- Button Tambah --}}
            <a href="{{ url('/kegiatans/create') }}" class='btn btn-primary'>Tambah Kegiatan</a>

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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama Kerjasama</th>
                        <th>Bentuk Kegiatan</th>
                        <th>PIC</th>
                        <th>Keterangan</th>
                        <th>Nama Dosen</th>
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

                                {{-- Button Ubah --}}
                                <a href="{{ route('kegiatans.edit', ['kegiatan' => $data->id]) }}"
                                    class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit" title="Edit"></i></a>

                                @if (Auth::user()->level == 'A')
                                    {{-- Button Hapus --}}
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $data->id }}"
                                        data-bentukKegiatan="{{ $data->bentuk_kegiatan }}" data-toggle="modal"
                                        data-target="#modal-sm"><i class="nav-icon fas fa-trash"
                                            title="Hapus"></i></button>
                                @endif
                            </td>

                            @if (Auth::user()->level == 'A')
                                <td>{{ $data->kerjasama->nama_kerja_sama }}</td>
                            @else
                                <td>{{ $data->nama_kerja_sama }}</td>
                            @endif

                            <td>{{ $data->bentuk_kegiatan }}</td>

                            <td>{{ Status::kegiatan($data->PIC) }}</td>

                            <td>{{ $data->keterangan }}</td>

                            @if (Auth::user()->level == 'A')
                                <td>{{ $data->user->name }}</td>
                            @else
                                <td>{{ $data->name }}</td>
                            @endif

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
                        <th>PIC</th>
                        <th>Keterangan</th>
                        <th>Nama Dosen</th>
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
