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
                        <td colspan="2">
                            <h2>Tambah Bukti Kerjasama</h2>
                        </td>
                    </tr>

                    {{-- Barisan Menambahkan data Bukti --}}
                    <form action="{{ route('buktiKerjasamas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <tr>
                            <td>
                                {{-- Nama Bukti Kerjasama --}}
                                <div class="form-group">
                                    <label for="Nama_Bukti_Kerjasama">Nama Bukti Kerjasama</label>
                                    <input type="text" class="form-control" name="Nama_Bukti_Kerjasama"
                                        placeholder="Enter Nama Bukti Kerjasama">

                                    @error('Nama_Bukti_Kerjasama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                {{-- add file --}}
                                <div class="form-group">
                                    <label for="Bukti_Kerjasama">Bukti Kerjasama</label>
                                    <input type="file" class="form-control" name="Bukti_Kerjasama">

                                    @error('Bukti_Kerjasama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                {{-- Kerjasama ID --}}
                                <input type="hidden" value="{{ $kerjasama->id }}" name="kerjasama_id">
                                @error('kerjasama_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                {{-- Button Submit --}}
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Tambahkan Bukti</button>
                                </div>
                            </td>
                        </tr>
                    </form>
                </tbody>

            </table>




            {{-- <div class="row">
                @foreach ($buktiKerjasama as $data)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <img src="{{ asset('storage/kerjasama/' . $data->foto) }}"
                            alt="{{ $data->nama_bukti_kerjasama }}">
                        <center><button class="btn btn-danger btn-sm">Hapus</button></center>
                    </div>
                @endforeach
            </div> --}}

        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabel Bukti Kerjasama</h3>
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
            {{-- Tabel Data Bukti Kerjasama --}}
            <table id="example1" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bukti Kerjasama</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @foreach ($buktiKerjasama as $data)
                        <tr>
                            <td> {{ $nomor++ }} </td>
                            <td>{{ $data->nama_bukti_kerjasama }}</td>
                            <td>{{ $data->tanggalUpload }}</td>
                            <td>
                                {{-- Button Tampil --}}
                                <a href="{{ url('storage/kerjasama/' . $data->file) }}"
                                    class="btn btn-block btn-primary">Tampil</a>

                                {{-- Button Hapus --}}
                                <button class="btn btn-block btn-danger btn-hapus" data-file="{{ $data->file }}"
                                    data-namaBuktiKerjasama="{{ $data->nama_bukti_kerjasama }}" data-toggle="modal"
                                    data-target="#modal-sm">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Bukti Kerjasama</th>
                        <th>Tanggal Upload</th>
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
        // file disini adalah file kerjasama
        $('.btn-hapus').click(function() {
            let file = $(this).attr('data-file');
            $('#formDelete').attr('action');

            let namaBuktiKerjasama = $(this).attr('data-namaBuktiKerjasama');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus bukti " + namaBuktiKerjasama + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
