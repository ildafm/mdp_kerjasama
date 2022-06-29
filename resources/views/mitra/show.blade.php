@extends('layouts.master')
@section('title', 'Mitra')

@section('content')
    <div class="card">
        <div class="card-header">

            {{-- Button Kembali --}}
            <a href="{{ url('/mitras') }}" class='btn btn-primary'>Kembali</a>

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
                    <tr>
                        <td>Nama Mitra</td>
                        <td>{{ $mitra->nama_mitra }}</td>
                    </tr>

                    <tr>
                        <td>Tingkat</td>
                        <td>{{ Status::mitra($mitra->tingkat) }}</td>
                    </tr>

                </tbody>

            </table>

        </div>
    </div>
    </div>

@endsection
