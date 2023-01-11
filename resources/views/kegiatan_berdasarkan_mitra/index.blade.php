@extends('layouts.master')
@section('title', 'Kegiatan Berdasarkan Mitra')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title">Tabel Daftar Kegiatan</h3> -->
            @if (Auth::user()->level != 'D')
                {{-- Button Tambah --}}
                <a href="{{ url('/kegiatans/create') }}" class='btn btn-primary'>Tambah Kegiatan</a>
            @else
                <div class="card-title">
                    <h4 class="">Tabel Daftar Kegiatan</h4>
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

            {{-- form untuk memfilter kegiatan berdasarkan tanggal mulai dan tanggal sampai --}}
            {{-- <form action="{{ route('kerjasamas.index') }}" method="GET">
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
                    <div class="form-group col-lg-2">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form> --}}

            {{-- Tabel Data --}}
            <table id="example1" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Mitra</th>
                        <th>Total Kegiatan</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $nomor = 1;
                    @endphp

                    @foreach ($listMitras as $data)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>
                                {{-- Button Tampil --}}
                                <a href="{{ url('kegiatan_berdasarkan_mitras/' . $data->id) }}"
                                    class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye" title="Tampil"></i></a>
                            </td>
                            <td>{{ $data->nama_mitra }}</td>
                            <td>{{ $data->total_kegiatan }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Mitra</th>
                        <th>Total Kegiatan</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
@endsection
