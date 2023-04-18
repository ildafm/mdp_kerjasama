@extends('layouts.master')
@php
    $getTitle = 'Arsip Kerjasama';
    if (isset($_GET['filter_berdasarkan_kategori_mou'])) {
        $getFilter = $_GET['filter_berdasarkan_kategori_mou'];
        $kategori_mou = DB::select("SELECT * FROM kategori_mous WHERE id = $getFilter LIMIT 1");
        $getKategoriMouName = $kategori_mou[0]->nama_kategori;
        if (!empty($kategori_mou)) {
            $getTitle = "Arsip Kerjasama $getKategoriMouName";
        }
    }
@endphp

@section('title', $getTitle)

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4 class="">{{ $getTitle }}</h4>
            </div>

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

            {{-- form untuk memfilter kerjasama berdasarkan tanggal mulai dan tanggal sampai --}}
            <form action="{{ route('arsip_kerjasamas') }}" method="GET">
                @csrf
                <label for="filter">Filter berdasarkan kategori mou</label>
                <div class="row">
                    {{-- Select kategoriMous --}}
                    <div class="form-group col-lg-2">
                        <select name="filter_berdasarkan_kategori_mou" class="form-control select2">
                            @foreach ($kategoriMous as $item)
                                <option value="{{ $item->id }}" {{ $filterKategoriMou == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Button Submit --}}
                    <div class="form-group col-lg-3">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        @php
                            if (isset($_GET['filter_berdasarkan_kategori_mou'])) {
                                echo "<a href='/arsip_kerjasamas' class='btn btn-secondary' title='Hapus filter'>Hapus Filter</a>";
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
                        <th>Nomor MoU</th>
                        <th>Kategori MoU</th>
                        <th>Bidang</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Kategori Kerjasama</th>
                        <th>Status</th>
                        <th>File MoU</th>
                        <th>Nomor SPK</th>
                        <th>File SPK</th>
                        <th>Tanggal Mulai SPK</th>
                        <th>Tanggal Berakhir SPK</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @if (count($kerjasamas) > 0)
                        @foreach ($kerjasamas as $data)
                            <tr>
                                {{-- Nomor --}}
                                <td> {{ $nomor++ }} </td>

                                {{-- Button aksi --}}
                                <td>
                                    {{-- Button Tampil --}}
                                    <a href="{{ url('kerjasamas/' . $data->id) }}" class="btn btn-sm btn-primary"><i
                                            class="nav-icon fas fa-eye" title="Tampil"></i></a>
                                </td>
                                {{-- Nama Mitra --}}
                                <td>{{ $data->nama_mitra }}</td>
                                {{-- Nama Kerjasama --}}
                                <td>{{ $data->nama_kerja_sama }}</td>
                                {{-- usulan --}}
                                <td>{{ $data->usulan }}</td>
                                {{-- Nomor MoU --}}
                                <td>
                                    @if ($data->nomor_mou == '' && $data->kategori_id == 1)
                                        Belum ada file MoU yang diupload
                                    @elseif($data->kategori_id == 2)
                                        Tanpa MoU
                                    @else
                                        {{ $data->nomor_mou }}
                                    @endif
                                </td>
                                {{-- Kategori MoU --}}
                                <td>
                                    {{ $data->kategori_mou }}
                                </td>
                                {{-- Bidang kerjasama --}}
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
                                {{-- tanggal mulai --}}
                                <td>{{ $data->tanggal_mulai }}</td>
                                {{-- tanggal sampai --}}
                                <td>{{ $data->tanggal_sampai }}</td>
                                {{-- kategori kerjasama --}}
                                <td>{{ $data->nama_kategori }}</td>
                                {{-- status --}}
                                <td>{{ $data->nama_status }}</td>
                                {{-- File MoU --}}
                                <td>
                                    @if ($data->file_mou == '' && $data->kategori_id == 1)
                                        Belum ada file MoU yang diupload
                                    @elseif($data->kategori_id == 2)
                                        Tanpa MoU
                                    @else
                                        <a href="{{ url('storage/kerjasama/' . $data->file_mou) }}"
                                            target="_blank">{{ url('storage/kerjasama/' . $data->file_mou) }}</a>
                                    @endif
                                </td>
                                {{-- Nomor SPK --}}
                                <td>
                                    @if ($data->nomor_spk != null)
                                        {{ $data->nomor_spk }}
                                    @else
                                        Belum ada spk yang diupload
                                    @endif
                                </td>
                                {{-- File SPK --}}
                                <td>
                                    @if ($data->nomor_spk != null)
                                        <a href="{{ url('storage/kerjasama/' . $data->file_spk) }}"
                                            target="_blank">{{ url('storage/kerjasama/' . $data->file_spk) }}</a>
                                    @else
                                        Belum ada spk yang diupload
                                    @endif

                                </td>
                                {{-- Tanggal Mulai SPK --}}
                                <td>
                                    @if ($data->nomor_spk == null)
                                        Tidak Ada SPK
                                    @elseif($data->tanggal_mulai_spk == null)
                                        Kegiatan Belum Ditambahkan
                                    @else
                                        {{ $data->tanggal_mulai_spk }}
                                    @endif
                                </td>
                                {{-- Tanggal Berakhir SPK --}}
                                <td>
                                    @if ($data->nomor_spk == null)
                                        Tidak Ada SPK
                                    @elseif($data->tanggal_sampai_spk == null)
                                        Kegiatan Belum Ditambahkan
                                    @else
                                        {{ $data->tanggal_sampai_spk }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Mitra</th>
                        <th>Nama Kerjasama</th>
                        <th>Usulan</th>
                        <th>Nomor MoU</th>
                        <th>Kategori MoU</th>
                        <th>Bidang</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Kategori Kerjasama</th>
                        <th>Status</th>
                        <th>File MoU</th>
                        <th>Nomor SPK</th>
                        <th>File SPK</th>
                        <th>Tanggal Mulai SPK</th>
                        <th>Tanggal Berakhir SPK</th>
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
