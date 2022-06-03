@extends('layouts.master')
@section('title', 'Kerjasama')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bukti Kerjasama</h3>

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
            <form action="{{ route('buktiKerjasamas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- add file --}}
                <div class="form-group">
                    <label for="foto">Bukti Kerjasama</label>
                    <input type="file" class="form-control" name="foto">

                    @error('foto')
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
