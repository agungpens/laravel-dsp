@extends('template.main')

@section('content')
    {{-- alert success & error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="col">
        <h2 class="h4 mb-1">Jenis Produk</h2>
        <div class="card shadow">
            <div class="card-body">
                <div>
                    <a href="{{ url('jenis_produk/add') }}" class="btn btn-primary float-right ml-3">Tambah+</a>
                </div>
                <!-- table -->
                <table class="table table-bordered" id="jenis-produk">
                    <thead class="thead-dark">
                        <tr role="row">
                            <th>ID</th>
                            <th>Nama Jenis</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->jenis_produk }}</td>
                                <td>
                                    <button class="btn btn-sm more-horizontal" type="button">
                                        <span class="text-muted sr-only">Action</span>
                                        <i data-feather="edit"style="font-size: 20px;"></i>
                                        <a class="btn btn-sm" href="{{ url('jenis_produk/edit/' . $item->id) }}"><i
                                                class="fe fe-edit" style="font-size: 20px;"></i></a>
                                        <a class="btn btn-sm" href="{{ url('jenis_produk/delete/' . $item->id) }}"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                            <i class="fe fe-trash-2" style="font-size: 20px;"></i>
                                        </a>

                                    </button>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('#jenis-produk').DataTable();
        });
    </script>
@endsection
