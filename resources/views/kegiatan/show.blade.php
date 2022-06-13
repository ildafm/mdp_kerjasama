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
                        <td>ID</td>
                        <td>{{ $kegiatan->id }}</td>
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
                        <td>Bentuk Kegiatan</td>
                        <td>{{ $kegiatan->bentuk_kegiatan }}</td>
                    </tr>

                    <tr>
                        <td>PIC</td>
                        <td>{{ Status::kegiatan($kegiatan->PIC) }}</td>
                    </tr>

                    <tr>
                        <td>Keterangan</td>
                        <td>{{ $kegiatan->keterangan }}</td>
                    </tr>

                    <tr>
                        <td>Nama Kerja Sama</td>
                        <td>{{ $kegiatan->kerjasama->nama_kerja_sama }}</td>
                    </tr>

                    <tr>
                        <td>Nama Dosen</td>
                        <td>{{ $kegiatan->dosen->nama_dosen }}</td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <h2>Tambah Bukti Kegiatan</h2>
                        </td>
                    </tr>

                    {{-- Barisan Menambahkan data Bukti --}}
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <tr>
                            <td>
                                {{-- Nama Bukti Kegiatan --}}
                                <div class="form-group">
                                    <label for="Nama_Bukti_Kegiatan">Nama Bukti Kegiatan</label>
                                    <input type="text" class="form-control" name="Nama_Bukti_Kegiatan"
                                        placeholder="Enter Nama Bukti Kegiatan">

                                    @error('Nama_Bukti_Kegiatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                {{-- add file --}}
                                <div class="form-group">
                                    <label for="Bukti_Kegiatan">Bukti Kegiatan</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="Bukti_Kegiatan"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>

                                    @error('Bukti_Kegiatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>

                            </td>
                            <td>
                                <div class="row">
                                    <div class="form-check col">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">APT</label>
                                    </div>
                                    <div class="form-check col">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">APS</label>
                                    </div>
                                    <div class="form-check col">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">LAMEMBA</label>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                {{-- getKegiatanID --}}
                                <input type="text" value="{{ $kegiatan->id }}" name="kegiatan_id">
                                @error('kegiatan_id')
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
        // id disini adalah id kegiatan
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/kegiatans/' + id);

            let dataID = $(this).attr('data-id')
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus kegiatan dengan id : " + dataID + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
