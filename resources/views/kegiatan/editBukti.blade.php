@extends('layouts.master')
@section('title', 'Kegiatan')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Bukti Kegiatan {{ $buktiKegiatan->nama_bukti_kegiatan }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>

        </div>

        {{-- Barisan edit data Bukti --}}
        <form action="{{ route('buktiKegiatans.update', ['buktiKegiatan' => $buktiKegiatan->id]) }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="card-body">

                {{-- Nama Bukti Kegiatan --}}
                <div class="form-group">
                    <label for="nama_bukti_kegiatan">Nama Bukti Kegiatan</label>
                    <input type="text" class="form-control" name="nama_bukti_kegiatan"
                        placeholder="Enter Nama Bukti Kegiatan"
                        value="{{ old('nama_bukti_kegiatan', $buktiKegiatan->nama_bukti_kegiatan) }}">

                    @error('nama_bukti_kegiatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- edit file --}}
                {{-- <tr>
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
                </tr> --}}

                {{-- APT, APS, LAMEMBA --}}
                <div class="row">
                    {{-- APT --}}
                    @php
                        if (old('apt') != null) {
                            $option_apt = old('apt');
                        } else {
                            $option_apt = $buktiKegiatan->ceklist_apt;
                        }
                    @endphp

                    <div class="form-check col">
                        <input class="form-check-input" type="checkbox" name="apt"
                            @if ($option_apt == 'Y') checked @endif>
                        <label class="form-check-label">APT</label>
                    </div>

                    {{-- APS --}}
                    @php
                        if (old('aps') != null) {
                            $option_aps = old('aps');
                        } else {
                            $option_aps = $buktiKegiatan->ceklist_aps;
                        }
                    @endphp

                    <div class="form-check col">
                        <input class="form-check-input" type="checkbox" name="aps"
                            @if ($option_aps == 'Y') checked @endif>
                        <label class="form-check-label">APS</label>
                    </div>

                    {{-- LAMEMBA --}}
                    @php
                        if (old('lamemba') != null) {
                            $option_lamemba = old('lamemba');
                        } else {
                            $option_lamemba = $buktiKegiatan->ceklist_lamemba;
                        }
                    @endphp

                    <div class="form-check col">
                        <input class="form-check-input" type="checkbox" name="lamemba"
                            @if ($option_lamemba == 'Y') checked @endif>
                        <label class="form-check-label">LAMEMBA</label>
                    </div>
                </div>

                <div class="row">
                    {{-- Nama Unit --}}
                    <div class="form-group col-lg-6">
                        @php
                            if (old('nama_unit') != null) {
                                $option = old('nama_unit');
                            } else {
                                $option = $buktiKegiatanUnits->units_id;
                            }
                            // echo $buktiKegiatanUnits->units_id;
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
                    <div class="form-group col-lg-6">
                        <label for="bidang">Bidang</label>
                        <select class="form-control" name="bidang">
                            <option value='P' <?= $buktiKegiatan->bidang == 'P' ? 'selected' : '' ?>>
                                Pendidikan</option>
                            <option value='N' <?= $buktiKegiatan->bidang == 'N' ? 'selected' : '' ?>>
                                Penelitian</option>
                            <option value='B' <?= $buktiKegiatan->bidang == 'B' ? 'selected' : '' ?>>
                                Pengabdian</option>
                            <option value='L' <?= $buktiKegiatan->bidang == 'L' ? 'selected' : '' ?>>
                                Lain-lain</option>
                        </select>
                        @error('bidang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="card-footer">
                {{-- Button Submit --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="{{ url("kegiatans/$buktiKegiatan->kegiatans_id") }}" class="btn btn-outline-dark">Kembali</a>
            </div>

        </form>

    </div>
@endsection
