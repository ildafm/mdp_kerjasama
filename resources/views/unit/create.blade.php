@extends('layouts.master')

@section('title', 'Unit')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Units</h3>
    
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
        <form action="{{ route('units.store') }}" method="POST">
            @csrf
        <div class="form-group">
            <label for="nama_unit">Nama Unit</label>
            <input type="text" name='nama_unit' class="form-control @error('nama_unit') is-invalid @enderror" placeholder="Masukan Nama Unit">
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