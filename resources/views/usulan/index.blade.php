@extends('layouts.master')
@section('title', 'Usulan')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title">Tabel Daftar Usulan</h3> -->
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
                        <th>Id</th>
                        <th>Nama Usulan</th>
                        <th>Bentuk Kerja Sama</th>
                        <th>Rencana Kegiatan</th>
                        <th>Tanggal Rencana Kegiatan</th>
                        <th>Nama Mitra</th>
                        <th>Nama Dosen</th>
                        <th>Nama Unit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($usulans as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->nama_usulan }}</td>
                            <td>{{ $data->bentuk_kerjasama }}</td>
                            <td>{{ $data->rencana_kegiatan }}</td>
                            <td>{{ $data->tanggal_rencana_kegiatan }}</td>
                            <td>{{ $data->mitra->nama_mitra }}</td>
                            <td>{{ $data->dosen->nama_dosen }}</td>
                            <td>{{ $data->unit->nama_unit }}</td>
                            <td>
                                {{-- Button Ubah --}}
                                <a href="{{ route('usulans.edit', ['usulan' => $data->id]) }}"
                                    class="btn btn-block btn-primary">Ubah</a>

                                {{-- Button Hapus --}}
                                <button class="btn btn-block btn-danger btn-hapus" data-id="{{ $data->id }}"
                                    data-toggle="modal" data-target="#modal-sm">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nama Usulan</th>
                        <th>Bentuk Kerja Sama</th>
                        <th>Rencana Kegiatan</th>
                        <th>Tanggal Rencana Kegiatan</th>
                        <th>Nama Mitra</th>
                        <th>Nama Dosen</th>
                        <th>Nama Unit</th>
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
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus data ini?</p>
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
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
