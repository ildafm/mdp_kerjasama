@extends('layouts.master')
@section('title', 'Mitra')

@section('content')
    <div class="card">
        <div class="card-header">

            {{-- Button Kembali --}}
            <a href="{{ url('/users') }}" class='btn btn-primary'>Kembali</a>

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

            {{-- Tabel Data --}}
            <table id="example1" class="table table-bordered table-striped">

                <tbody>
                    {{-- Kode Dosen --}}
                    <tr>
                        <td>Kode Dosen</td>
                        <td>{{ $user->kode_dosen }}</td>
                    </tr>

                    <tr>
                        <td>Nama User</td>
                        <td>{{ $user->name }}</td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <td>Level</td>
                        <td>
                            @if ($user->level === 'A')
                                Admin
                            @else
                                Dosen
                            @endif
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>
    </div>
    </div>

@endsection
