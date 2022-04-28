@extends('layouts.master')
@section('title', 'Status')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ubah Status {{ $status->nama_status }}</h3>
    
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
        <form action="{{ route('statuses.update', ['status'=>$status->id]) }}" method="POST">
            {{-- @csrf --}}
            {{ csrf_field() }}
            {{ method_field('PUT') }}
        <div class="form-group">
            <label for="nama_status">Nama Status</label>
            <input type="text" value="{{ $status->nama_status }}" name='nama_status' class="form-control @error('nama_status') is-invalid @enderror" placeholder="Masukan Nama Status">
            @error('nama_status')
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