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
                {{ method_field('PUT') }}
                @csrf

                {{-- ubah nama --}}
                <div class="form-group">
                    <label for="name">Nama User</label>
                    <input type="text" name='name' autocomplete="name" autofocus
                        class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama User"
                        value="{{ $user->name }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ubah email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name='email' autocomplete="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email"
                        value="{{ $user->email }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ubah password --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name='password' autocomplete="new-password"
                        class="form-control @error('password') is-invalid @enderror" required placeholder="Masukan Password"
                        value="{{ $user->password }}">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- konfirmasi password --}}
                <div class="form-group">
                    <label for="password-confirm">Konfirmasi Password</label>
                    <input id=" password-confirm" type="text" class="form-control" name="password_confirmation" required
                        placeholder="Konfirmasi Password" autocomplete="new-password" value="{{ $user->password }}">
                </div>

                {{-- ubah level --}}
                <div class="form-group">
                    <label for="level">Level</label>
                    <select class="form-control" name='level'>
                        <option value='A' <?= $user->level == 'A' ? 'selected' : '' ?>>Admin</option>
                        <option value='D' <?= $user->level == 'D' ? 'selected' : '' ?>>Dosen</option>
                    </select>
                    @error('level')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        </div>

        {{-- Button Submit --}}
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    </form>

@endsection
