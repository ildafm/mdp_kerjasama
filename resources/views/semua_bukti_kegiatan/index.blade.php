@extends('layouts.master')
@php
    $getTitle = 'Laporan Kegiatan';
    if (isset($_GET['filter_berdasarkan_unit'])) {
        $getFilter = $_GET['filter_berdasarkan_unit'];
        $unit = DB::select("SELECT * FROM units WHERE id = $getFilter LIMIT 1");
        $getUnitName = $unit[0]->nama_unit;
        if (!empty($unit)) {
            $getTitle = "Laporan Kegiatan $getUnitName";
        }
    }
@endphp
@section('title', $getTitle)

@section('content')
    <div class="card">
        <div class="card-header">

            <div class="card-title">
                <h4 class="">Tabel Daftar Laporan Kegiatan</h4>
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
            <form action="{{ route('semua_laporan_kegiatans.index') }}" method="GET">
                @csrf
                <label for="filter">Filter berdasarkan unit</label>
                <div class="row">
                    {{-- Select units --}}
                    <div class="form-group col-lg-2">
                        <select name="filter_berdasarkan_unit" class="form-control select2">
                            @foreach ($units as $data)
                                <option value="{{ $data->id }}" {{ $filterUnit == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Button Submit --}}
                    <div class="form-group col-lg-2">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        @php
                            if (isset($_GET['filter_berdasarkan_unit'])) {
                                echo "<a href='/semua_laporan_kegiatans' class='btn btn-secondary' title='hapus filter'>Hapus Filter</a>";
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
                        <th>Nama Laporan</th>
                        <th>PIC</th>
                        <th>Kegiatan</th>
                        <th>Bidang</th>
                        <th>Unit</th>
                        <th>File Laporan</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @foreach ($buktiKegiatans as $data)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>
                                <a href="{{ url('kegiatans/' . $data->kegiatans_id) }}" class="btn btn-sm btn-primary"
                                    title="Menuju kegiatan"><i class="fas fa-eye"></i></a>
                            </td>
                            <td>{{ $data->nama_bukti_kegiatan }}</td>
                            <td>{{ $data->pic_name }}</td>
                            <td> {{ $data->bentuk_kegiatan }} </td>
                            <td>
                                @if ($data->bidang == 'P')
                                    Pendidikan
                                @elseif ($data->bidang == 'N')
                                    Penelitian
                                @elseif ($data->bidang == 'B')
                                    Pengabdian
                                @elseif ($data->bidang == 'A')
                                    Pendidikan, Penelitian, Pengabdian
                                @else
                                    Lain-lain
                                @endif
                            </td>
                            <td>{{ $data->nama_unit }}</td>
                            <td>
                                <a href="{{ url('storage/kegiatan/' . $data->file) }}" title='Lihat file laporan'>
                                    {{ url('storage/kegiatan/' . $data->file) }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama Laporan</th>
                        <th>PIC</th>
                        <th>Kegiatan</th>
                        <th>Bidang</th>
                        <th>Unit</th>
                        <th>File Laporan</th>
                    </tr>
                </tfoot>

            </table>

        </div>

    </div>
@endsection
