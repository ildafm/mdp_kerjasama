@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    <div class="card">
        <div class="card-header">

            {{-- Button Kembali --}}
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
            {{-- Tampilkan Pesan --}}
            @if (session()->has('pesan'))
                <div class='alert alert-success'>
                    {{ session()->get('pesan') }}
                </div>
            @endif

            {{-- Tabel Data --}}
            <table id="" class="table table-bordered table-striped">

                <tbody>
                    <tr>
                        <td>Nama Kerja Sama</td>
                        <td>{{ $kerjasama->nama_kerja_sama }}</td>
                    </tr>

                    <tr>
                        <td>Nomor Mou</td>
                        <td>
                            @if ($kerjasama->no_mou == '')
                                Tanpa MoU
                            @else
                                {{ $kerjasama->no_mou }}
                            @endif
                        </td>
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
                        <td>Kategori</td>
                        <td>{{ $kerjasama->kategori->nama_kategori }}</td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>{{ $kerjasama->status->nama_status }}</td>
                    </tr>

                    <tr>
                        <td>Usulan</td>
                        <td>{{ $kerjasama->usulan->usulan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- card tambah bukti --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Bukti Kerjasama</h3>
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
            {{-- Form Menambahkan data Bukti --}}
            <form action="{{ route('buktiKerjasamas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Bukti Kerjasama --}}
                <div class="form-group">
                    <label for="nama_bukti_kerjasama">Nama Bukti Kerjasama</label>
                    <input type="text" class="form-control" name="nama_bukti_kerjasama"
                        placeholder="Enter Nama Bukti Kerjasama" value="{{ old('nama_bukti_kerjasama') }}">

                    @error('nama_bukti_kerjasama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- add file --}}
                <div class="form-group">
                    <label for="file">Bukti Kerjasama(Max:5mb)</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>

                    @error('file')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- getKerjasamaID --}}
                <input type="hidden" value="{{ $kerjasama->id }}" name="kerjasama_id">
                @error('kerjasama_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Tambahkan Bukti</button>
            </form>
        </div>
    </div>

    {{-- Tabel Bukti Kerjasama --}}
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
            {{-- Data Tabel Bukti Kerjasama --}}
            <table id="example1" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama Bukti Kerjasama</th>
                        <th>Tanggal Upload</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @foreach ($buktiKerjasama as $data)
                        <tr>
                            <td> {{ $nomor++ }} </td>
                            <td>
                                {{-- Button Tampil --}}
                                <a href="{{ url('storage/kerjasama/' . $data->file) }}" class="btn btn-sm btn-primary">
                                    <i class="nav-icon fas fa-eye" title="Tampil"></i></a>

                                {{-- Button Ubah --}}
                                <a href="{{ route('buktiKerjasamas.edit', ['buktiKerjasama' => $data->id]) }}"
                                    class="btn btn-sm btn-warning"><i class="nav-icon fas fa-edit" title="Edit"></i></a>

                                {{-- Button Hapus --}}
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $data->id }}"
                                    data-namaBuktiKerjasama="{{ $data->nama_bukti_kerjasama }}" data-toggle="modal"
                                    data-target="#modal-sm"><i class="nav-icon fas fa-trash" title="Hapus"></i></button>
                            </td>
                            <td>{{ $data->nama_bukti_kerjasama }}</td>
                            <td>{{ $data->tanggalUpload }}</td>
                        </tr>
                    @endforeach

                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama Bukti Kerjasama</th>
                        <th>Tanggal Upload</th>
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
                        {{-- <p id="text_modal"></p> --}}
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
        // id disini adalah id buktiKerjasama
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/buktiKerjasamas/' + id);

            let namaBuktiKerjasama = $(this).attr('data-namaBuktiKerjasama');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus bukti " + namaBuktiKerjasama + " ?")

            // document.getElementById("text_modal").innerHTML = "Apakah anda yakin ingin menghapus bukti " +
            //     namaBuktiKerjasama + " ?";
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
