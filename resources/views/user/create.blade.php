@extends('layouts.master')
@section('title', 'User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah User</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        {{-- Form input --}}
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="row">
                    {{-- input nama --}}
                    <div class="form-group col-lg-8">
                        <label for="name">Nama User</label>
                        <input type="text" name='name' autocomplete="name" autofocus value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama User">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Kode Dosen --}}
                    <div class="form-group col-lg-4">
                        <label for="kode_dosen">Kode Dosen</label>
                        <input type="text" name='kode_dosen' value="{{ old('kode_dosen') }}"
                            class="form-control @error('kode_dosen') is-invalid @enderror" placeholder="Masukan Kode Dosen">
                        @error('kode_dosen')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- input email --}}
                    <div class="form-group col-lg-8">
                        <label for="email">Email</label>
                        <input type="text" name='email' autocomplete="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- input level --}}
                    <div class="form-group col-lg-4 col-sm-12 col-md-12">
                        <label for="level">Level</label>

                        @php
                            if (old('level') !== null) {
                                $option_level = old('level');
                            } else {
                                $option_level = 'A';
                            }
                        @endphp

                        <select id="select_level" class="form-control" name='level' onchange="getUnitFromLevel()">
                            <option value='A' <?= $option_level == 'A' ? 'selected' : '' ?>>Admin</option>
                            <option value='E' <?= $option_level == 'E' ? 'selected' : '' ?>>Dekan</option>
                            <option value='K' <?= $option_level == 'K' ? 'selected' : '' ?>>Kaprodi</option>
                            <option value='U' <?= $option_level == 'U' ? 'selected' : '' ?>>Kepala Unit</option>
                            <option value='D' <?= $option_level == 'D' ? 'selected' : '' ?>>Dosen</option>
                        </select>
                        @error('level')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- password dan password confirm dan level row --}}
                <div class="row">
                    {{-- input password --}}
                    <div class="form-group col-lg-4 col-sm-12 col-md-12">
                        <label for="password">Password</label>
                        <input type="text" name='password' autocomplete="new-password" value="{{ old('password') }}"
                            class="form-control @error('password') is-invalid @enderror" required
                            placeholder="Masukan Password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- konfirmasi password --}}
                    <div class="form-group col-lg-4 col-sm-12 col-md-12">
                        <label for="password-confirm">Konfirmasi Password</label>
                        <input id="password-confirm" type="text" class="form-control" name="password_confirmation"
                            required placeholder="Konfirmasi Password" autocomplete="new-password">
                    </div>

                    {{-- select unit --}}
                    <div class="form-group col-lg-4">
                        <label for="nama_unit">Nama Unit</label>

                        @php
                            if (old('nama_unit') !== null) {
                                $option = old('nama_unit');
                            } else {
                                $option = 1;
                            }
                        @endphp

                        <select class="form-control select2" name="nama_unit">
                            @foreach ($units as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_unit }}
                                </option>
                            @endforeach
                            {{-- @php
                                $getAllUnits = DB::select('SELECT id, nama_unit, parent_unit FROM units');
                                for ($i = 0; $i < count($getAllUnits); $i++) {
                                    if ($option_level == 'A') {
                                        if ($getAllUnits[$i]->parent_unit == null || $getAllUnits[$i]->parent_unit == '') {
                                            echo '<option value=',$getAllUnits[$i]->id,' ', $option == $getAllUnits[$i]->id ? 'selected' : '', '>', $getAllUnits[$i]->nama_unit, '</option>';
                                        }
                                    } elseif ($option_level == 'E') {
                                        if ($getAllUnits[$i]->parent_unit == '1') {
                                            echo '<option value=',$getAllUnits[$i]->id,' ', $option == $getAllUnits[$i]->id ? 'selected' : '', '>', $getAllUnits[$i]->nama_unit, '</option>';
                                        }
                                    } else {
                                        echo '<option value=',$getAllUnits[$i]->id,' ', $option == $getAllUnits[$i]->id ? 'selected' : '', '>', $getAllUnits[$i]->nama_unit, '</option>';
                                    }
                                }
                            @endphp --}}
                        </select>
                        @error('nama_unit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <br>
                {{-- Button Submit --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                {{-- Spasi --}}
                &ensp;
                {{-- Button Kembali --}}
                <a href="/users" class="btn btn-outline-dark">Kembali</a>
            </form>
        </div>
    </div>

@endsection
