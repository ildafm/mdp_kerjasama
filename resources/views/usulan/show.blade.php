@extends('layouts.master')
@section('title', 'Usulan')

@section('content')
    <div class="card">
        <div class="card-header">

            {{-- Button Tambah --}}
            <a href="{{ url('/usulans/create') }}" class='btn btn-primary'>Tambah Usulan</a>

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
                <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $usulan->id }}</td>
                    </tr>

                    <tr>
                        <td>Nama Usulan</td>
                        <td>{{ $usulan->nama_usulan }}</td>
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
                        <td>Tanggal Rencana Kegiatan</td>
                        <td>{{ $usulan->tanggal_rencana_kegiatan }}</td>
                    </tr>

                    <tr>
                        <td>Nama Mitra</td>
                        <td>{{ $usulan->mitra->nama_mitra }}</td>
                    </tr>

                    <tr>
                        <td>Nama Dosen</td>
                        <td>{{ $usulan->dosen->nama_dosen }}</td>
                    </tr>

                    <tr>
                        <td>Nama Unit</td>
                        <td>{{ $usulan->unit->nama_unit }}</td>
                    </tr>

                    <tr>
                        <td>Aksi</td>
                        <td>
                            {{-- Button Ubah --}}
                            <a href="{{ route('usulans.edit', ['usulan' => $usulan->id]) }}"
                                class="btn btn-md btn-warning">Ubah</a>

                            {{-- Button Hapus --}}
                            <button class="btn btn-md btn-danger btn-hapus" data-id="{{ $usulan->id }}"
                                data-namaUsulan="{{ $usulan->nama_usulan }}" data-toggle="modal"
                                data-target="#modal-sm">Hapus</button>
                        </td>
                    </tr>
                </tbody>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Iya</button>
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
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus usulan " + namaUsulan + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection