@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title">Tabel Daftar Kerjasama</h3> -->
            {{-- Button Tambah --}}
            <a href="{{ url('/kerjasamas/create') }}" class='btn btn-primary'>Tambah Kerjasama</a>

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
                        <th>Nomor MoU</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Sampai</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Usulan</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @foreach ($kerjasamas as $data)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>
                                {{-- Button Tampil --}}
                                <a href="{{ url('kerjasamas/' . $data->id) }}" class="btn btn-sm btn-primary"><i
                                        class="nav-icon fas fa-eye" title="Tampil"></i></a>


                                @if (Auth::user()->level != 'D')
                                    {{-- Button Ubah --}}
                                    <a href="{{ route('kerjasamas.edit', ['kerjasama' => $data->id]) }}"
                                        class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit"
                                            title="Edit"></i></a>

                                    {{-- Button Hapus --}}
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $data->id }}"
                                        data-namaKerjasama="{{ $data->nama_kerja_sama }}" data-toggle="modal"
                                        data-target="#modal-sm"><i class="nav-icon fas fa-trash"
                                            title="Hapus"></i></button>
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
                            <td>{{ $data->kategori->nama_kategori }}</td>
                            <td>{{ $data->status->nama_status }}</td>
                            <td>{{ $data->usulan->usulan }}</td>
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
                        <th>Usulan</th>
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
        // id disini adalah id kerjasama
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/kerjasamas/' + id);

            let namaKerjasama = $(this).attr('data-namaKerjasama');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus kerjasama : " + namaKerjasama + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
