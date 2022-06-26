@extends('layouts.master')
@section('title', 'User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data User {{ $user->name }}</h3>

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
            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="row">
                    {{-- ubah email --}}
                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="email">Email</label>
                        <input readonly type="text" name='email' autocomplete="email"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email"
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ubah Kode Dosen --}}
                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="kode_dosen">Kode Dosen</label>
                        <input readonly type="text" name='kode_dosen' autocomplete="kode_dosen"
                            class="form-control @error('kode_dosen') is-invalid @enderror" placeholder="Masukan Kode Dosen"
                            value="{{ $user->kode_dosen }}">
                        @error('kode_dosen')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- ubah nama --}}
                <div class="form-group">
                    <label for="name">Nama User</label>
                    <input type="text" name='name' autocomplete="name" autofocus
                        value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukan Nama User" value="{{ $user->name }}">
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

                {{-- ubah level --}}
                <div class="form-group">
                    <label for="level">Level</label>

                    @php
                        if (old('level') !== null) {
                            $option = old('level');
                        } else {
                            $option = $user->level;
                        }
                    @endphp

                    <select class="form-control" name='level'>
                        <option value='A' <?= $option == 'A' ? 'selected' : '' ?>>Admin</option>
                        <option value='D' <?= $option == 'D' ? 'selected' : '' ?>>Dosen</option>
                    </select>
                    @error('level')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        </div>

        <div class="card-footer">
            {{-- Button Submit --}}
            <button type="submit" class="btn btn-primary">Submit</button>
            {{-- Spasi --}}
            &ensp;
            {{-- Button Kembali --}}
            <a href="/users" class="btn btn-outline-secondary">Kembali</a>
        </div>

    </div>
    </form>

@endsection
