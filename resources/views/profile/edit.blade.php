@extends('layouts.master')
@section('title', 'Profile')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data User {{ Auth::user()->name }}</h3>

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
            {{-- Form Ubah Data --}}
            <form action="{{ route('profiles.update', ['profile' => Auth::user()->id]) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                {{-- Tampilkan Pesan --}}
                @if (session()->has('pesan'))
                    <div class='alert alert-success'>
                        {{ session()->get('pesan') }}
                    </div>
                @endif

                {{-- Edit Gambar --}}
                <div class="form-group">
                    <center>
                        <p>
                        <div class="image">
                            @if (Auth::user()->file == null || Auth::user()->file == '')
                                <img style="width: 250px; height: 250px" src="{{ asset('dist/img/user_profile.png') }}"
                                    class="img-circle elevation-2 img-fluid " alt="User_Image">
                            @else
                                <img style="width: 250px; height: 250px"
                                    src="{{ asset('storage/profile/' . Auth::user()->file) }}" alt="Foto Profile"
                                    class="img-circle elevation-2 img-fluid">
                                <br>
                            @endif
                        </div>
                        </p>
                    </center>

                    {{-- add file --}}
                    <div class="form-group">
                        <label for="file">Foto Profile(jpg,png|Max:500kb)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile" align="left">Choose file
                                </label>
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

                <div class="row">
                    {{-- ubah email --}}
                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="email">Email</label>
                        <input readonly type="text" name='email' autocomplete="email"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email"
                            value="{{ Auth::user()->email }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ubah Kode Dosen --}}
                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="kode_dosen">Kode Dosen</label>
                        <input readonly type="text" name='kode_dosen' autocomplete="kode_dosen"
                            class="form-control @error('kode_dosen') is-invalid @enderror" placeholder="Masukan Kode Dosen"
                            value="{{ Auth::user()->kode_dosen }}">
                        @error('kode_dosen')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ubah Unit --}}
                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="unit">Unit</label>
                        <input readonly type="text" name='unit' autocomplete="unit"
                            class="form-control @error('unit') is-invalid @enderror" placeholder="Masukan Unit"
                            value="{{ Auth::user()->unit->nama_unit }}">
                        @error('unit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- ubah nama --}}
                <div class="form-group">
                    <label for="name">Nama User</label>
                    <input required type="text" name='name' autocomplete="name" autofocus
                        value="{{ old('name', Auth::user()->name) }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama User">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="row">
                    <div class="form-group col-lg-6">
                        {{-- ubah password --}}
                        <label for="password">Password (Jika tidak mau mengubah, kosongkan input password)</label>
                        <input type="text" name='password' autocomplete="new-password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password"
                            value="">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- konfirmasi password --}}
                    <div class="form-group col-lg-6">
                        <label for="password-confirm">Konfirmasi Password</label>
                        <input id="password-confirm" type="text" class="form-control" name="password_confirmation"
                            placeholder="Konfirmasi Password" autocomplete="new-password" value="">
                    </div>
                </div>
                <br>
                {{-- Button Submit --}}
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>

        </div>

        <div class="card-footer">


        </div>
    </div>

@endsection
