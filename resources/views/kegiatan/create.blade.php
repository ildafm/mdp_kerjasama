@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Kegiatan</h3>

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
            <form action="{{ route('kegiatans.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="" class="form-control">
                        @error('tanggal_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="tanggal_sampai">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" id="" class="form-control">
                        @error('tanggal_sampai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="bentuk_kegiatan">Bentuk Kegiatan </label>
                    <input type="text" name='bentuk_kegiatan'
                        class="form-control @error('bentuk_kegiatan') is-invalid @enderror"
                        placeholder="Masukan Bentuk Kegiatan">
                    @error('bentuk_kegiatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">

                    <div class="form-group col-lg-4">
                        <label for="PIC">PIC</label>
                        <select class="form-control" name="PIC" id="">
                            <option value="F">Fakultas</option>
                            <option value="P">Program Studi</option>
                        </select>
                        @error('PIC')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="kerjasamas">Kerjasama</label>
                        <select class="form-control select2" name="kerjasamas" id="">
                            @foreach ($kerjasamas as $data)
                                <option value="{{ $data->id }}"> {{ $data->id }} - {{ $data->nama_kerja_sama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kerjasamas')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="dosens">Dosen</label>
                        <select class="form-control select2" name="dosens" id="">
                            @foreach ($dosens as $data)
                                <option value="{{ $data->id }}"> {{ $data->id }} - {{ $data->kode_dosen }} -
                                    {{ $data->nama_dosen }}
                                </option>
                            @endforeach
                        </select>
                        @error('dosens')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" id=""
                        class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukan Keterangan">
                    @error('keterangan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>


    </form>

@endsection
