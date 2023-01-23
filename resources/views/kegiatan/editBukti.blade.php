@extends('layouts.master')
@section('title', 'Kegiatan')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Laporan Kegiatan {{ $buktiKegiatan->nama_bukti_kegiatan }}</h3>
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
            {{-- Barisan edit data Laporan --}}
            <form action="{{ route('buktiKegiatans.update', ['buktiKegiatan' => $buktiKegiatan->id]) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                {{-- Nama Laporan Kegiatan --}}
                <div class="form-group">
                    <label for="nama_bukti_kegiatan">Nama Laporan Kegiatan</label>
                    <input type="text" class="form-control" name="nama_bukti_kegiatan"
                        placeholder="Enter Nama Laporan Kegiatan"
                        value="{{ old('nama_bukti_kegiatan', $buktiKegiatan->nama_bukti_kegiatan) }}">

                    @error('nama_bukti_kegiatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- APT, APS, LAMEMBA --}}
                {{-- <div class="row"> --}}
                {{-- APT --}}
                {{-- @php
                        $option_apt = $buktiKegiatan->ceklist_apt;
                        $checked_apt = '';
                        if (old('apt') == 'Y') {
                            $checked_apt = 'checked';
                        }
                        if ($option_apt == 'Y') {
                            $checked_apt = 'checked';
                        }
                    @endphp

                    <div class="form-check col">
                        <input class="form-check-input" type="checkbox" name="apt" value="Y" {{ $checked_apt }} />
                        <label class="form-check-label">APT</label>
                    </div> --}}

                {{-- APS --}}
                {{-- @php
                        $option_aps = $buktiKegiatan->ceklist_aps;
                        $checked_aps = '';
                        if (old('aps') == 'Y') {
                            $checked_aps = 'checked';
                        }
                        if ($option_aps == 'Y') {
                            $checked_aps = 'checked';
                        }
                        
                        // if ($option_aps == 'Y') {
                        //     $checked_aps = 'checked';
                        // }
                        // if (old('aps') == 'Y') {
                        //     $checked_aps = 'checked';
                        // } else {
                        //     if (old('aps') == null) {
                        //         $checked_aps = '';
                        //     } else {
                        //         $checked_aps = 'checked';
                        //     }
                        // }
                        
                    @endphp --}}

                {{-- <div class="form-check col">
                        <input class="form-check-input" type="checkbox" name="aps" value="Y" {{ $checked_aps }} />
                        <label class="form-check-label">APS</label>
                    </div> --}}

                {{-- LAMEMBA --}}
                {{-- @php
                        $option_lamemba = $buktiKegiatan->ceklist_lamemba;
                        $checked_lamemba = '';
                        if (old('lamemba') == 'Y') {
                            $checked_lamemba = 'checked';
                        }
                        if ($option_lamemba == 'Y') {
                            $checked_lamemba = 'checked';
                        }
                    @endphp

                    <div class="form-check col">
                        <input class="form-check-input" type="checkbox" name="lamemba" value="Y"
                            {{ $checked_lamemba }} />
                        <label class="form-check-label">LAMEMBA</label>
                    </div>
                </div> --}}

                <div class="row">
                    {{-- Nama Unit --}}
                    <div class="form-group col-lg-6">
                        @php
                            if (old('nama_unit') != null) {
                                $option = old('nama_unit');
                            } else {
                                $option = $buktiKegiatanUnits->units_id;
                            }
                        @endphp

                        <label for="nama_unit">Nama Unit</label>
                        <select class="form-control select2" name="nama_unit">
                            @foreach ($units as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_unit }}</option>
                            @endforeach
                        </select>
                        @error('nama_unit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bidang --}}
                    @php
                        if (old('bidang') != null) {
                            $option = old('bidang');
                        } else {
                            $option = $buktiKegiatan->bidang;
                        }
                    @endphp

                    <div class="form-group col-lg-6">
                        <label for="bidang">Bidang</label>
                        <select class="form-control" name="bidang">
                            <option value='P' <?= $option == 'P' ? 'selected' : '' ?>>
                                Pendidikan</option>
                            <option value='N' <?= $option == 'N' ? 'selected' : '' ?>>
                                Penelitian</option>
                            <option value='B' <?= $option == 'B' ? 'selected' : '' ?>>
                                Pengabdian</option>
                            <option value='A' {{ $option == 'A' ? 'selected' : '' }}>
                                Pendidikan, Penelitian, Pengabdian</option>
                            <option value='L' {{ $option == 'L' ? 'selected' : '' }}>
                                Lain-lain
                            </option>
                        </select>
                        @error('bidang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="file">File Laporan (pdf,jpg,png,docx,doc | Max:10mb | Kosongkan jika tidak ingin
                        mengubah)</label>
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

                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="{{ url("kegiatans/$buktiKegiatan->kegiatans_id") }}" class="btn btn-outline-dark">Kembali</a>
            </form>
        </div>
    </div>
@endsection
