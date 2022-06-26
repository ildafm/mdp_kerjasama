@extends('layouts.master')
@section('title', 'User')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title">Tabel Daftar Status</h3> -->
            {{-- Button tambah --}}
            <a href="{{ url('/users/create') }}" class='btn btn-primary'>Tambah User</a>

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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Dosen</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @foreach ($users as $data)
                        <tr>
                            <td>{{-- $data->id --}}{{ $nomor++ }}</td>
                            <td>{{ $data->kode_dosen }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            @php
                                if ($data->level == 'A') {
                                    echo '<td>Admin</td>';
                                } else {
                                    echo '<td>Dosen</td>';
                                }
                            @endphp
                            <td>
                                {{-- Button Tampil --}}
                                <a href="{{ url('users/' . $data->id) }}" class="btn btn-block btn-primary">Tampil</a>

                                {{-- Button Edit --}}
                                <a href="{{ route('users.edit', ['user' => $data->id]) }}"
                                    class="btn btn-block btn-warning">Ubah</a>

                                {{-- Button Hapus --}}
                                <button class="btn btn-block btn-danger btn-hapus" data-id="{{ $data->id }}"
                                    data-toggle="modal" data-target="#modal-sm"
                                    data-namaUser="{{ $data->name }}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kode Dosen</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
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

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Iya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
        // id disini adalah id user
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/users/' + id);

            let namaUser = $(this).attr('data-namaUser');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus data : " + namaUser + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
