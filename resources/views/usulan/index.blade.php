@extends('layouts.master')
@section('title', 'Usulan')

@section('content')
    <div class="card">
        <div class="card-header">

            @if (Auth::user()->level != 'D')
                {{-- Button Tambah --}}
                <a href="{{ url('/usulans/create') }}" class='btn btn-primary'>Tambah Usulan</a>
            @else
                <div class="card-title">
                    <h4 class="">Tabel Daftar Usulan</h4>
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

            {{-- Tabel Data --}}
            <table id="example1" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Usulan</th>
                        <th>Bentuk Kerjasama</th>
                        <th>Rencana Kegiatan</th>
                        <th>Nama Mitra</th>
                        <th>Kontak Kerjasama</th>
                        <th>Nama Pengusul</th>
                        <th>Nama Unit</th>
                        <th>Hasil Penjajakan</th>
                        <th>Keterangan</th>
                        <th>Type</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @foreach ($usulans as $data)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>
                                {{-- BUtton Tampil --}}
                                <a href="{{ url('usulans/' . $data->id) }}" class="btn btn-sm btn-primary"><i
                                        class="nav-icon fas fa-eye" title="Tampil"></i></a>

                                @if (Auth::user()->level != 'D')
                                    {{-- Button Ubah --}}
                                    <a href="{{ route('usulans.edit', ['usulan' => $data->id]) }}"
                                        class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit"
                                            title="Edit"></i></a>

                                    {{-- Button Hapus --}}
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $data->id }}"
                                        data-namaUsulan="{{ $data->usulan }}" data-toggle="modal" data-target="#modal-sm"><i
                                            class="nav-icon fas fa-trash" title="Hapus"></i></button>
                                @endif
                            </td>
                            <td>{{ $data->usulan }}</td>
                            <td>{{ $data->bentuk_kerjasama }}</td>
                            <td>{{ $data->rencana_kegiatan }}</td>
                            <td>{{ $data->mitra->nama_mitra }}</td>
                            <td>{{ $data->kontak_kerjasama }}</td>
                            <td>{{ $data->user->name }}</td>
                            <td>{{ $data->unit->nama_unit }}</td>
                            <td>
                                @if ($data->hasil_penjajakan == 'B')
                                    Belum ditentukan
                                @else
                                    @if ($data->hasil_penjajakan == 'L')
                                        Lanjut
                                    @else
                                        Tidak Lanjut
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ($data->keterangan == null || $data->keterangan == '')
                                    Belum Ada Keterangan
                                @else
                                    {{ $data->keterangan }}
                                @endif
                            </td>
                            <td>
                                @if ($data->type == 'I')
                                    IN
                                @else
                                    OUT
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Usulan</th>
                        <th>Bentuk Kerjasama</th>
                        <th>Rencana Kegiatan</th>
                        <th>Nama Mitra</th>
                        <th>Kontak Kerjasama</th>
                        <th>Nama Pengusul</th>
                        <th>Nama Unit</th>
                        <th>Hasil Penjajakan</th>
                        <th>Keterangan</th>
                        <th>Type</th>
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
