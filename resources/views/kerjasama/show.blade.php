@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')

    {{-- css table --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

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

            {{-- Tampilkan Pesan --}}
            @if (session()->has('pesan'))
                <div class='alert alert-success'>
                    {{ session()->get('pesan') }}
                </div>
            @endif

            {{-- Tabel Data --}}
            <table id="example1" class="table table-bordered table-striped">

                <tbody>
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

                        {{-- Nama Bukti Kerjasama --}}
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    <label for="Nama_Bukti_Kerjasama">Nama Bukti Kerjasama</label>
                                    <input type="text" class="form-control" name="Nama_Bukti_Kerjasama"
                                        placeholder="Enter Nama Bukti Kerjasama"
                                        value="{{ old('Nama_Bukti_Kerjasama') }}">

                                    @error('Nama_Bukti_Kerjasama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        {{-- add file --}}
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    <label for="Bukti_Kerjasama">Bukti Kerjasama(Max:5mb)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="Bukti_Kerjasama"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>

                                    @error('Bukti_Kerjasama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                {{-- getKerjasamaID --}}
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
            <table id="example2" class="table table-bordered table-striped">

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
                                <button class="btn btn-block btn-danger btn-hapus" data-id="{{ $data->id }}"
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

    {{-- Data Tables --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#exampleQ1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#exampleQ1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

@endsection
