@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title">Tabel Daftar Kerja Sama</h3> -->
            {{-- Button Tambah --}}
            <a href="{{ url('/kerjasamas') }}" class='btn btn-primary'>Kembali</a>

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
                        <td>{{ $kerjasama->id }}</td>
                    </tr>

                    <tr>
                        <td>Nama Kerja Sama</td>
                        <td>{{ $kerjasama->nama_kerja_sama }}</td>
                    </tr>

                    <tr>
                        <td>Tanggal Mulai</td>
                        <td>{{ $kerjasama->tanggal_mulai }}</td>
                    </tr>

                    <tr>
                        <td>Tanggal Sampai</td>
                        <td>{{ $kerjasama->tanggal_sampai }}</td>
                    </tr>

                    <tr>
                        <td>Nama Mitra</td>
                        <td>{{ $kerjasama->mitra->nama_mitra }}</td>
                    </tr>

                    <tr>
                        <td>Nama Kategori</td>
                        <td>{{ $kerjasama->kategori->nama_kategori }}</td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>{{ $kerjasama->status->nama_status }}</td>
                    </tr>

                    <tr>
                        <td>Bukti Kerjasama</td>
                        <td>
                            {{-- Button tambah bukti --}}
                            {{-- <button class="btn btn-primary btn-md">Tambah Bukti</button> --}}

                            {{-- <a href="{{ route('buktiKerjasama.create', ['kerjasama' => $kerjasama->id]) }}"
                                class="btn btn-md btn-primary">Tambah Bukti</a> --}}
                            <a class="btn btn-primary btn-md" href="{{ url('/buktiKerjasamas') }}">Tambah
                                Bukti Kerjasama</a>
                        </td>
                    </tr>

                </tbody>

            </table>

            <div class="row">
                @foreach ($buktiKerjasama as $data)
                    <div class="col-lg-6 col-md-6 col-sm-6"><img src="{{ asset('storage/kerjasama/' . $data->foto) }}"
                            alt="{{ $data->nama_bukti_kerjasama }}"></div>
                @endforeach
            </div>

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
        // id disini adalah id kerjasama
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/kerjasamas/' + id);

            let namaKerjasama = $(this).attr('data-namaKerjasama');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus kerja sama " + namaKerjasama + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
