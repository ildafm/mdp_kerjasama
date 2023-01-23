@extends('layouts.master')

@section('title', 'Unit')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah data Unit {{ $unit->nama_unit }}</h3>

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
            {{-- Form ubah data --}}
            <form action="{{ route('units.update', ['unit' => $unit->id]) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="row">
                    {{-- Nama Unit --}}
                    <div class="form-group col-lg-6">
                        <label for="nama_unit">Nama Unit</label>
                        <input required type="text" value='{{ $unit->nama_unit }}' name='nama_unit'
                            class="form-control @error('nama_unit') is-invalid @enderror" placeholder="Masukan Nama Unit">
                        @error('nama_unit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Parent Unit --}}
                    <div class="form-group col-lg-6">
                        <label for="parent_unit">Parent Unit</label>

                        @php
                            if (old('parent_unit') !== null) {
                                $option = old('parent_unit');
                            } else {
                                $option = $unit->parent_unit;
                            }
                        @endphp

                        <select class="form-control select2" name="parent_unit" id="">
                            <option value="">-- Pilih Parent Unit --</option>
                            @foreach ($units as $data)
                                <option value="{{ $data->id }}" {{ $option == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_unit }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_unit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <br>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                &nbsp;
                <a href="/units" class="btn btn-outline-dark">Kembali</a>

            </form>
        </div>
    </div>
@endsection
