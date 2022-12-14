@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Kerjasama {{ $kerjasama->nama_kerja_sama }}</h3>

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
            {{-- Form edit data --}}
            <form action="{{ route('kerjasamas.update', ['kerjasama' => $kerjasama->id]) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="row">
                    {{-- Nomor MoU --}}
                    <div class="form-group col-lg-6">
                        <label for="no_mou">Nomor MoU</label>
                        <input type="text" id="no_mou" name='no_mou' value="{{ old('no_mou', $kerjasama->no_mou) }}"
                            class="form-control @error('no_mou') is-invalid @enderror" placeholder="Masukan Nomor MoU"
                            onload="getStatus({{ $kerjasama->kategori_id }})">
                        @error('no_mou')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="nama_kategori">Kategori</label>

                        @php
                            if (old('nama_kategori') !== null) {
                                $option = old('nama_kategori');
                            } else {
                                $option = $kerjasama->kategori_id;
                            }
                        @endphp

                        <select class="form-control" id="nama_kategori" name='nama_kategori' onchange="getStatus(this)">
                            @foreach ($kategoris as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama_kategori')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Edit nama Kerjasama --}}
                <div class="form-group">
                    <label for="nama_kerja_sama">Nama Kerjasama</label>
                    <input type="text" value="{{ old('nama_kerja_sama', $kerjasama->nama_kerja_sama) }}"
                        name='nama_kerja_sama' class="form-control @error('nama_kerja_sama') is-invalid @enderror"
                        placeholder="Masukan Nama Kerjasama">
                    @error('nama_kerja_sama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Tanggal Mulai --}}
                    <div class="form-group col-lg-6">
                        <label for="tanggal_mulai">Tanggal Mulai : </label>
                        <input type="date" name="tanggal_mulai"
                            value="{{ old('tanggal_mulai', $kerjasama->tanggal_mulai) }}" id=""
                            class="form-control">
                        @error('tanggal_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div class="form-group col-lg-6">
                        <label for="tanggal_sampai"> Tanggal Sampai : </label>
                        <input type="date" name="tanggal_sampai"
                            value="{{ old('tanggal_sampai', $kerjasama->tanggal_sampai) }}" id=""
                            class="form-control">
                        @error('tanggal_sampai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- Edit Usulan --}}
                    <div class="form-group col-lg-4">
                        <label for="usulan">Usulan</label>
                        <select class="form-control select2" name='usulan'>
                            @foreach ($usulans as $data)
                                <option value="{{ $data->id }}"
                                    {{ old('usulan', $kerjasama->usulan_id) == $data->id ? 'selected' : '' }}>
                                    {{ $data->usulan }}</option>
                            @endforeach
                        </select>
                        @error('usulan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bidang --}}
                    @php
                        if (old('bidang') != null) {
                            $option = old('bidang');
                        } else {
                            $option = $kerjasama->bidang;
                        }
                    @endphp

                    <div class="form-group col-lg-4">
                        <label for="bidang">Bidang</label>
                        <select class="form-control" name="bidang">
                            <option value='P' <?= $option == 'P' ? 'selected' : '' ?>>
                                Pendidikan
                            </option>
                            <option value='N' <?= $option == 'N' ? 'selected' : '' ?>>
                                Penelitian
                            </option>
                            <option value='B' <?= $option == 'B' ? 'selected' : '' ?>>
                                Pengabdian
                            </option>
                            <option value='A' <?= $option == 'A' ? 'selected' : '' ?>>
                                Pendidikan, Penelitian, Pengabdian
                            </option>
                            <option value='L' <?= $option == 'L' ? 'selected' : '' ?>>
                                Lain-lain
                            </option>
                        </select>
                        @error('bidang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Edit Nama Status --}}
                    <div class="form-group col-lg-4">
                        <label for="nama_status">Status</label>
                        <select class="form-control" name='nama_status'>
                            @foreach ($statuses as $data)
                                <option value="{{ $data->id }}"
                                    {{ $data->id == $kerjasama->status_id ? 'selected' : '' }}>
                                    {{ $data->nama_status }}</option>
                            @endforeach
                        </select>
                        @error('nama_status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- digunakan untuk return redirect()->route() di function update KerjasamaController --}}
                <div class="form-group" hidden>
                    <label for="type">Hidden Type</label>
                    <input type="text" value="{{ $type }}" name='type'
                        class="form-control @error('type') is-invalid @enderror" readonly>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                {{-- &nbsp;
                <a href="/kerjasamas" class="btn btn-outline-dark">Kembali</a> --}}
            </form>
        </div>
    </div>

    <script>
        document.getElementById("no_mou").addEventListener("load", getStatus(@php echo $kerjasama->kategori_id @endphp));

        function getStatus(status) {
            let nk = document.getElementById("nama_kategori")

            let no_mou = document.getElementById("no_mou")

            no_mou.readOnly = false
            if (nk.value == "1") {
                no_mou.readOnly = false
            } else {
                no_mou.value = ""
                no_mou.readOnly = true
            }
        }
    </script>

@endsection
