@extends('layouts.master')
@section('title', 'Kategori')

@section('content')

<div class="card">
<div class="card-header">
<a href="{{ url('/kategoris/create') }}" class='btn btn-primary'>Tambah Kategori</a>
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
    @if(session()->has('pesan'))
     <div class='alert alert-success'>
         {{ session()->get('pesan') }}
     </div>
     @endif
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>Id</th>
<th>Nama Kategori</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
    @foreach($kategoris as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->nama_kategori }}</td>
            <td>
                <a href="{{ route('kategoris.edit', ['kategori'=>$data->id]) }}" class="btn btn-block btn-primary">Ubah</a>
                
                <form method="POST" action="{{ route('kategoris.destroy', ['kategori'=>$data->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="form-group">
                        <input type="submit" class="btn btn-danger btn-block delete-user" value="Hapus">
                    </div>
                </form>
            </td>
        </tr>
        
    @endforeach
</tbody>
<tfoot>
<tr>
<th>Id</th>
<th>Nama Kategori</th>
<th>Aksi</th>
</tr>
</tfoot>
</table>
</div>
</div>

<script>
    $('.delete-user').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>

@endsection