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
        <form action="{{ route('units.update', ['unit'=>$unit->id]) }}" method="POST">
            {{-- @csrf --}}
            {{ csrf_field() }}
            {{ method_field('PUT') }}
        <div class="form-group">
            <label for="nama_unit">Nama Unit</label>
            <input type="text" value='{{ $unit->nama_unit }}' name='nama_unit' class="form-control @error('nama_unit') is-invalid @enderror" placeholder="Masukan Nama Unit">
            @error('nama_unit')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</div>


</form>

@endsection