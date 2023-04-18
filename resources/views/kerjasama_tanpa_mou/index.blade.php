@extends('layouts.master')
@section('title', 'Kerjasama Tanpa MoU')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title">Tabel Daftar Kerjasama</h3> -->
            @if (Auth::user()->level != 'D')
                {{-- Button Tambah --}}
                <a href="{{ route('kerjasamas.create', ['type' => 2]) }}" class="btn btn-primary">Tambah Kerjasama</a>
            @else
                <div class="card-title">
                    <h4 class="">Tabel Daftar Kerjasama</h4>
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

            {{-- form untuk memfilter kerjasama berdasarkan tanggal mulai dan tanggal sampai --}}
            <form action="{{ route('kerjasama_tanpa_mous.index') }}" method="GET">
                @csrf
                <label for="filter">Filter berdasarkan tanggal</label>
                <div class="row">
                    <div class="form-group col-lg-2">
                        <input type="date" name="filter_tanggal_mulai" class="form-control" value="{{ $tanggal_mulai }}">
                    </div>
                    <span class="btn">Sampai</span>
                    <div class="form-group col-lg-2">
                        <input type="date" name="filter_tanggal_sampai" class="form-control"
                            value="{{ $tanggal_sampai }}">
                    </div>
                    <div class="form-group col-lg-3">

                        <button type="submit" class="btn btn-primary">Cari</button>
                        @php
                            if (isset($_GET['filter_tanggal_mulai']) && isset($_GET['filter_tanggal_sampai'])) {
                                echo "<a href='/kerjasama_tanpa_mous' title='Hapus Filter' class='btn btn-secondary'>Hapus Filter</a>";
                            }
                        @endphp
                    </div>
                </div>
            </form>

            {{-- Tabel Data --}}
            <table id="example1" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Mitra</th>
                        <th>Nama Kerjasama</th>
                        <th>Usulan</th>
                        <th>Bidang</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Nomor SPK</th>
                        <th>File SPK</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @foreach ($kerjasamas as $data)
                        @php
                            $getSPK = DB::select("SELECT kerjasamas.id, spk.nomor_file AS 'nomor_spk', spk.jenis_file, spk.nama_file, spk.file AS 'file_spk'
                                    FROM kerjasamas
                                    JOIN (SELECT * FROM bukti_kerjasamas WHERE jenis_file = 'S') AS spk ON spk.kerjasama_id = kerjasamas.id
                                    WHERE kerjasamas.id = $data->id
                                    ORDER BY kerjasamas.id");
                        @endphp
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>
                                {{-- Button Tampil --}}
                                <a href="{{ url('kerjasamas/' . $data->id) }}" class="btn btn-sm btn-primary"><i
                                        class="nav-icon fas fa-eye" title="Tampil"></i></a>

                                @if (Auth::user()->level != 'D')
                                    {{-- Button Ubah --}}
                                    <a href="{{ route('kerjasamas.edit', ['kerjasama' => $data->id, 'type' => 2]) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="nav-icon fas fa-edit" title="Edit"></i>
                                    </a>
                                @endif

                                @if (Auth::user()->level == 'A')
                                    {{-- Button Hapus --}}
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $data->id }}"
                                        data-namaKerjasama="{{ $data->nama_kerja_sama }}" data-toggle="modal"
                                        data-target="#modal-sm"><i class="nav-icon fas fa-trash"
                                            title="Hapus"></i></button>
                                @endif
                            </td>
                            <td>{{ $data->nama_mitra }}</td>
                            <td>{{ $data->nama_kerja_sama }}</td>
                            <td>{{ $data->usulan }}</td>
                            <td>
                                @php
                                    if ($data->bidang == 'P') {
                                        echo 'Pendidikan';
                                    } elseif ($data->bidang == 'N') {
                                        echo 'Penelitian';
                                    } elseif ($data->bidang == 'B') {
                                        echo 'Pengabdian';
                                    } elseif ($data->bidang == 'A') {
                                        echo 'Pendidikan, Penelitian, Pengabdian';
                                    } else {
                                        echo 'Lain-lain';
                                    }
                                @endphp
                            </td>
                            <td>{{ $data->tanggal_mulai }}</td>
                            <td>{{ $data->tanggal_sampai }}</td>
                            <td>{{ $data->nama_kategori }}</td>
                            <td>{{ $data->nama_status }}</td>
                            <td>
                                @if (count($getSPK) > 0)
                                    @foreach ($getSPK as $item)
                                        {{ $item->nomor_spk }};
                                    @endforeach
                                @else
                                    Belum ada spk
                                @endif
                            </td>
                            <td>
                                @if (count($getSPK) > 0)
                                    @foreach ($getSPK as $item)
                                        <a
                                            href="{{ url('storage/kerjasama/' . $item->file_spk) }}">{{ url('storage/kerjasama/' . $item->file_spk) }}</a>;
                                    @endforeach
                                @else
                                    Belum ada spk
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Mitra</th>
                        <th>Nama Kerjasama</th>
                        <th>Usulan</th>
                        <th>Bidang</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Nomor SPK</th>
                        <th>File SPK</th>
                    </tr>
                </tfoot>

            </table>

        </div>

    </div>

    {{-- Modal Layout --}}
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" method="POST" id="formDelete" onsubmit="disableBtnSubmitDelForm()">
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
                        <button id="btn-submit-delete" type="submit" class="btn btn-danger">Iya, Hapus</button>
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
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus kerjasama : " + namaKerjasama + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
