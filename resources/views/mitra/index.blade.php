@extends('layouts.master')
@section('title', 'Mitra')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title">Tabel Daftar Mitra</h3> -->
            <a href="{{ url('/mitras/create') }}" class='btn btn-primary'>Tambah Mitra</a>
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
                        <th>Nama Mitra</th>
                        <th>Tingkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mitras as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->nama_mitra }}</td>
                            <td>{{-- $data->tingkat --}}
                                {{ Status::mitra($data->tingkat) }}
                            </td>
                            <td>
                                <a href="{{ route('mitras.edit', ['mitra' => $data->id]) }}"
                                    class="btn btn-block btn-primary">Ubah</a>

                                <form method="POST" action="{{ route('mitras.destroy', ['mitra' => $data->id]) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                            data-target="#modal-sm">
                                            Hapus
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nama Mitra</th>
                        <th>Tingkat</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Modal Layout --}}
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Peringatan !!!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary delete-user">Iya</button>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $('.delete-user').click(function(e) {
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Are you sure?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
    </script>


@endsection
