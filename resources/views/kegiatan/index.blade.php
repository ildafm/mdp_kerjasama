@extends('layouts.master')
@section('title', 'Kegiatan')

@section('content')

<div class="card">
<div class="card-header">
<!-- <h3 class="card-title">Tabel Daftar Kegiatan</h3> -->
<a href="{{ url('/kegiatans/create') }}" class='btn btn-primary'>Tambah Kegiatan</a>
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
<th>Tanggal Mulai</th>
<th>Tanggal Sampai</th>
<th>Bentuk Kegiatan</th>
<th>PIC</th>
<th>Keterangan</th>
<th>Nama Kerja Sama</th>
<th>Nama Dosen</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
    @foreach($kegiatans as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->tanggal_mulai }}</td>
            <td>{{ $data->tanggal_sampai }}</td>
            <td>{{ $data->bentuk_kegiatan }}</td>
            <td>{{-- $data->PIC --}}
            {{ Status::kegiatan($data->PIC) }}
            </td>
            <td>{{ $data->keterangan }}</td>
            <td>{{ $data->kerjasama->nama_kerja_sama }}</td>
            <td>{{ $data->dosen->nama_dosen }}</td>
            <td>
                <a href="{{ route('kegiatans.edit', ['kegiatan'=>$data->id]) }}" class="btn btn-block btn-primary">Ubah</a>
                
                <form method="POST" action="{{ route('kegiatans.destroy', ['kegiatan'=>$data->id]) }}">
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
<th>Tanggal Mulai</th>
<th>Tanggal Sampai</th>
<th>Bentuk Kegiatan</th>
<th>PIC</th>
<th>Keterangan</th>
<th>Nama Kerja Sama</th>
<th>Nama Dosen</th>
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