@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')
    <div class="card">
        <div class="card-header">

            {{-- Button Kembali --}}
            <a href="{{ url('/kegiatans') }}" class='btn btn-primary'>Kembali</a>

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
                        <td>Nama Kerjasama</td>
                        <td>{{ $kegiatan->kerjasama->nama_kerja_sama }}</td>
                    </tr>

                    <tr>
                        <td>Bentuk Kegiatan</td>
                        <td>{{ $kegiatan->bentuk_kegiatan }}</td>
                    </tr>

                    <tr>
                        <td>Tanggal Mulai</td>
                        <td>{{ $kegiatan->tanggal_mulai }}</td>
                    </tr>

                    <tr>
                        <td>Tanggal Sampai</td>
                        <td>{{ $kegiatan->tanggal_sampai }}</td>
                    </tr>

                    <tr>
                        <td>PIC</td>
                        <td>{{ Status::kegiatan($kegiatan->PIC) }}</td>
                    </tr>

                    <tr>
                        <td>Nama Dosen</td>
                        <td>{{ $kegiatan->user->name }}</td>
                    </tr>

                    <tr>
                        <td>Keterangan</td>
                        <td>{{ $kegiatan->keterangan }}</td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <h2>Tambah Bukti Kegiatan</h2>
                        </td>
                    </tr>

                    {{-- Barisan Menambahkan data Bukti --}}
                    <form action="{{ route('buktiKegiatans.store') }}" method="POST" enctype="multipart/form-data"
                        id="formBuktiKegiatan">
                        @csrf

                        {{-- Nama Bukti Kegiatan --}}
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    <label for="nama_bukti_kegiatan">Nama Bukti Kegiatan</label>
                                    <input type="text" class="form-control" name="nama_bukti_kegiatan"
                                        placeholder="Enter Nama Bukti Kegiatan">

                                    @error('nama_bukti_kegiatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        {{-- add file --}}
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    <label for="bukti_kegiatan">Bukti Kegiatan</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="bukti_kegiatan"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>

                                    @error('bukti_kegiatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">

                                <div class="row">
                                    <div class="form-check col">
                                        <input class="form-check-input" type="checkbox" name="apt">
                                        <label class="form-check-label">APT</label>
                                    </div>
                                    <div class="form-check col">
                                        <input class="form-check-input" type="checkbox" name="aps">
                                        <label class="form-check-label">APS</label>
                                    </div>
                                    <div class="form-check col">
                                        <input class="form-check-input" type="checkbox" name="lamemba">
                                        <label class="form-check-label">LAMEMBA</label>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    {{-- Nama Unit --}}
                                    <label for="nama_unit">Nama Unit</label>
                                    <select class="form-control select2" name="nama_unit">
                                        @foreach ($units as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_unit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    {{-- getKegiatanID --}}
                                    <input type="hidden" value="{{ $kegiatan->id }}" class="form-control"
                                        name="kegiatan_id" readonly>
                                    @error('kegiatan_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        {{-- Button Submit --}}
                        <tr>
                            <td colspan="2">
                                <button type="submit" id="" class="btn btn-primary">Tambahkan Bukti</button>
                            </td>
                        </tr>
                    </form>

                </tbody>

            </table>

        </div>

    </div>

    {{-- Tabel Bukti Kegiatan --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bukti Kegiatan</h3>
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
                        <th>Nama Bukti Kegiatan</th>
                        <th>Nama Unit</th>
                        <th>APT</th>
                        <th>APS</th>
                        <th>LAMEMBA</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @if (count($buktiKegiatans) > 0)
                        @foreach ($buktiKegiatans as $data)
                            <tr>
                                <td> {{ $nomor++ }} </td>
                                <td> {{ $data->nama_bukti_kegiatan }} </td>
                                <td> {{ $data->nama_unit }} </td>
                                <td>
                                    @if ($data->ceklist_apt == 'Y')
                                        Ya
                                    @else
                                        Tidak
                                    @endif
                                </td>
                                <td>
                                    @if ($data->ceklist_aps == 'Y')
                                        Ya
                                    @else
                                        Tidak
                                    @endif
                                </td>
                                <td>
                                    @if ($data->ceklist_lamemba == 'Y')
                                        Ya
                                    @else
                                        Tidak
                                    @endif
                                </td>
                                <td> {{ $data->tanggal_upload_bukti }} </td>
                                <td>
                                    {{-- Button Tampil --}}
                                    <a href="{{ url('storage/kegiatan/' . $data->file) }}"
                                        class="btn btn-block btn-primary">Tampil</a>

                                    {{-- Button Ubah --}}
                                    <a href="{{ route('buktiKegiatans.edit', ['buktiKegiatan' => $data->id_bukti_kegiatan]) }}"
                                        class="btn btn-block btn-warning">Ubah</a>

                                    {{-- Button Hapus --}}
                                    <button class="btn btn-block btn-danger btn-hapus"
                                        data-id="{{ $data->id_bukti_kegiatan }}" data-toggle="modal"
                                        data-target="#modal-sm"
                                        data-namaBuktiKegiatan="{{ $data->nama_bukti_kegiatan }}">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        {{-- <td colspan="9">Belum ada Data</td> --}}
                    @endif
                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Bukti Kegiatan</th>
                        <th>Nama Unit</th>
                        <th>APT</th>
                        <th>APS</th>
                        <th>LAMEMBA</th>
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
        // id disini adalah id bukti kegiatan
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/buktiKegiatans/' + id);

            let dataNamaBuktiKegiatan = $(this).attr('data-namaBuktiKegiatan')
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus bukti kegiatan : " + dataNamaBuktiKegiatan +
                " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

    <script>
        $(document).ready(function() {
            $('.submitBtn').click(function() {
                $('#formBuktiKegiatan').submit();
                $('#formBuktiKegiatanUnit').submit();

            });
        });
    </script>

@endsection
