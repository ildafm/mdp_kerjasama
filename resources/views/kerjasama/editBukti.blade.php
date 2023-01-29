@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    <script>
        function getStatus(status) {
            let jenis_file = document.getElementById("jenis_file")
            let nomor_file = document.getElementById("nomor_file")

            let opt_kategori_mou = document.getElementsByName("opt_kategori_mou")
            let select_kategori_mou = document.getElementById("select_kategori_mou")
            let bukan_mou = document.getElementById("bukan_mou")

            if (jenis_file.value != "L") {
                nomor_file.readOnly = false
                nomor_file.required = true

            } else {
                nomor_file.value = ""
                nomor_file.readOnly = true
                nomor_file.required = false
            }

            if (jenis_file.value == "M") {
                select_kategori_mou.value = document.getElementById("hidden").value
                for (let i = 0; i < opt_kategori_mou.length; i++) {
                    opt_kategori_mou[i].hidden = false;
                }
                bukan_mou.hidden = true
            } else {
                select_kategori_mou.value = ""
                for (let i = 0; i < opt_kategori_mou.length; i++) {
                    opt_kategori_mou[i].hidden = true;
                }
                bukan_mou.hidden = false
            }
        }
    </script>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Bukti Kerjasama {{ $buktiKerjasama->nama_bukti_kerjasama }}</h3>
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
        <form action="{{ route('buktiKerjasamas.update', ['buktiKerjasama' => $buktiKerjasama->id]) }}" method="POST"
            enctype="multipart/form-data" onsubmit="disableBtnSubmitEditForm()">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="row">
                    {{-- Nama File --}}
                    <div class="form-group col-lg-8">
                        <label for="nama_file">Nama File</label>
                        <input required type="text" class="form-control" name="nama_file" placeholder="Enter Nama File"
                            value="{{ old('nama_file', $buktiKerjasama->nama_file) }}">

                        @error('nama_file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis File --}}
                    <div class="form-group col-lg-2">
                        <label for="jenis_file">Jenis File</label>
                        @php
                            if (old('jenis_file') != null) {
                                $option = old('jenis_file');
                            } else {
                                $option = $buktiKerjasama->jenis_file;
                            }
                        @endphp

                        <select class="form-control" name="jenis_file" id="jenis_file" onchange="getStatus(this)">
                            <option value="L" {{ $option == 'L' ? 'selected' : '' }}>
                                Lain-lain
                            </option>
                            <option value="S" {{ $option == 'S' ? 'selected' : '' }}>
                                SPK
                            </option>
                            @if ($kerjasama->kategori_id == '1')
                                <option value="M" {{ $option == 'M' ? 'selected' : '' }}>
                                    MoU
                                </option>
                            @endif
                        </select>
                    </div>

                    {{-- kategori mou --}}
                    <div class="form-group col-lg-2">
                        <label for="kategori_mou">Kategori MoU</label>

                        @php
                            if (old('kategori_mou') !== null) {
                                $option = old('kategori_mou');
                            } else {
                                $option = $buktiKerjasama->kategori_mou_id;
                            }
                        @endphp

                        <select class="form-control" name="kategori_mou" id="select_kategori_mou">
                            <option value="" id="bukan_mou">
                                -- Bukan MoU --
                            </option>
                            @foreach ($kategoriMous as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}
                                    name="opt_kategori_mou" hidden>
                                    {{ $data->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_mou')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- nomor file --}}
                <div class="form-group">
                    <label for="nomor_file">Nomor File</label>
                    <input type="text" class="form-control" name="nomor_file" id="nomor_file"
                        placeholder="Enter Nomor File" value="{{ old('nomor_file', $buktiKerjasama->nomor_file) }}"
                        readonly>
                    @error('nomor_file')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Upload File --}}
                <div class="form-group">
                    <label for="file">Upload File(pdf,jpg,png,docx,doc|Max:10mb|Kosongkan jika tidak ingin
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
            </div>

            {{-- hanya digunakan untuk mendapatkan value dari kategori id --}}
            <div class="form-group" hidden>
                <label for="hidden">hidden</label>
                <input type="text" class="form-control" name="" id="hidden" placeholder=""
                    value="{{ old('hidden', $buktiKerjasama->kategori_mou_id) }}" readonly>
                @error('hidden')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="card-footer">
                {{-- Button Submit --}}
                <button id="btn-submit-edit" type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="{{ url("kerjasamas/$buktiKerjasama->kerjasama_id") }}" class="btn btn-outline-dark">Kembali</a>

            </div>
        </form>
    </div>
    <script>
        getStatus(status)
    </script>
@endsection
