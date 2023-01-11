@extends('layouts.master')
@section('title', 'Klasifikasi Mitra')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title">Tabel Daftar Klasifikasi Mitra</h3> -->
            @if (Auth::user()->level != 'D')
                {{-- Button Tambah --}}
                <a href="{{ url('/klasifikasi_mitras/create') }}" class='btn btn-primary'>Tambah Klasifikasi Mitra</a>
            @else
                <div class="card-title">
                    <h4 class="">Tabel Daftar Klasifikasi Mitra</h4>
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
            @elseif (session()->has('pesan_error'))
                <div class='alert alert-danger'>
                    {{ session()->get('pesan_error') }}
                </div>
            @endif

            {{-- Tabel Data --}}
            <table id="example1" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Klasifikasi Mitra</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @foreach ($klasifikasiMitras as $data)
                        <tr>
                            <td>
                                {{ $nomor++ }}
                            </td>
                            <td>
                                {{-- Button Ubah --}}
                                <a href="{{ route('klasifikasi_mitras.edit', ['klasifikasi_mitra' => $data->id]) }}"
                                    class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit" title="Edit"></i></a>

                                {{-- Button Hapus --}}
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $data->id }}"
                                    data-toggle="modal" data-target="#modal-sm"
                                    data-klasifikasiMitra="{{ $data->klasifikasi_mitra }}"><i
                                        class="nav-icon fas fa-trash"></i></button>
                            </td>

                            <td>{{ $data->klasifikasi_mitra }}</td>
                            <td>{{ $data->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Klasifikasi Mitra</th>
                        <th>Keterangan</th>
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
        // id disini adalah id klasifikasi mitra
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/klasifikasi_mitras/' + id);

            let klasifikasiMitra = $(this).attr('data-klasifikasiMitra');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus data : " + klasifikasiMitra + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
