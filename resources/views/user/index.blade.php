@extends('layouts.master')
@section('title', 'User')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title">Tabel Daftar Status</h3> -->
            {{-- Button tambah --}}
            <a href="{{ url('/users/create') }}" class='btn btn-primary'>Tambah User</a>

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
            @if (session()->has('pesan'))
                <div class='alert alert-success'>
                    {{ session()->get('pesan') }}
                </div>
            @endif
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->level }}</td>
                            {{-- <td>
                                <a href="{{ route('users.edit', ['user' => $data->id]) }}"
                                    class="btn btn-block btn-primary">Ubah</a>

                                <form method="POST" action="{{ route('users.destroy', ['user' => $data->id]) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-danger btn-block delete-user" value="Hapus">
                                    </div>
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection
