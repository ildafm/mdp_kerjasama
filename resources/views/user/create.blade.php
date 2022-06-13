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

                {{-- input nama --}}
                <div class="form-group">
                    <label for="name">Nama User</label>
                    <input type="text" name='name' autocomplete="name" autofocus
                        class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama User">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- input email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name='email' autocomplete="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- password and password confirm and level row --}}
                <div class="row">
                    {{-- input password --}}
                    <div class="form-group col-lg-4 col-sm-12 col-md-12">
                        <label for="password">Password</label>
                        <input type="text" name='password' autocomplete="new-password"
                            class="form-control @error('password') is-invalid @enderror" required
                            placeholder="Masukan Password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- konfirmasi password --}}
                    <div class="form-group col-lg-4 col-sm-12 col-md-12">
                        <label for="password-confirm">Konfirmasi Password</label>
                        <input id=" password-confirm" type="text" class="form-control" name="password_confirmation"
                            required placeholder="Konfirmasi Password" autocomplete="new-password">
                    </div>

                    {{-- input level --}}
                    <div class="form-group col-lg-4 col-sm-12 col-md-12">
                        <label for="level">Level</label>
                        <select class="form-control" name='level'>
                            <option value='A'>Admin</option>
                            <option value='D'>Dosen</option>
                        </select>
                        @error('level')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



        </div>

        {{-- Button Submit --}}
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    </form>

@endsection
