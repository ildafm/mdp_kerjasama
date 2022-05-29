@extends('layouts.master')
@section('title', 'Status')

@section('content')
    <div class="card">
        <div class="card-header">

            {{-- Button tambah --}}
            <a href="{{ url('/statuses/create') }}" class='btn btn-primary'>Tambah Status</a>

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
                        <td>{{ $status->id }}</td>
                    </tr>

                    <tr>
                        <td>Nama Status</td>
                        <td>{{ $status->nama_status }}</td>
                    </tr>

                    <tr>
                        <td>Aksi</td>
                        <td>
                            {{-- Button Ubah --}}
                            <a href="{{ route('statuses.edit', ['status' => $status->id]) }}"
                                class="btn btn-md btn-warning">Ubah</a>

                            {{-- Button Hapus --}}
                            <button class="btn btn-md btn-danger btn-hapus" data-id="{{ $status->id }}"
                                data-namaStatus="{{ $status->nama_status }}" data-toggle="modal"
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
        // id disini adalah id status
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/statuses/' + id);

            let namaStatus = $(this).attr('data-namaStatus');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus status " + namaStatus + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
