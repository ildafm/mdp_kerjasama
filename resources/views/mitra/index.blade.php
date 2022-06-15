@extends('layouts.master')
@section('title', 'Mitra')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title">Tabel Daftar Mitra</h3> -->
            {{-- Button Tambah --}}
            <a href="{{ url('/mitras/create') }}" class='btn btn-primary'>Tambah Mitra</a>

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
                        <th>Nama Mitra</th>
                        <th>Tingkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @foreach ($mitras as $data)
                        <tr>
                            <td>
                                {{-- $data->id --}}
                                {{ $nomor++ }}
                            </td>
                            <td>{{ $data->nama_mitra }}</td>
                            <td>{{-- $data->tingkat --}}
                                {{ Status::mitra($data->tingkat) }}
                            </td>
                            <td>
                                {{-- Button Tampil --}}
                                <a href="{{ url('mitras/' . $data->id) }}" class="btn btn-block btn-primary">Tampil</a>

                                {{-- Button Ubah --}}
                                <a href="{{ route('mitras.edit', ['mitra' => $data->id]) }}"
                                    class="btn btn-block btn-warning">Ubah</a>

                                {{-- Button Hapus --}}
                                <button class="btn btn-block btn-danger btn-hapus" data-id="{{ $data->id }}"
                                    data-toggle="modal" data-target="#modal-sm"
                                    data-namaMitra="{{ $data->nama_mitra }}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Mitra</th>
                        <th>Tingkat</th>
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
                        <button type="submit" class="btn btn-primary">Iya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
        // id disini adalah id mitra
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/mitras/' + id);

            let namaMitra = $(this).attr('data-namaMitra');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus mitra : " + namaMitra + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
