@extends('template.main')

@section('content')
    <div class="col-12">
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
        <div class="card shadow">
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile"
                            aria-selected="false">{{ isset($data['page_name']) ? $data['page_name'] : '' }} Jenis Produk</a>
                    </li>
                </ul>

                <div class="row">
                    <div class="col-md-6">
                        <form
                            action="{{ isset($data['page_name']) && $data['page_name'] == 'Tambah' ? url('jenis_produk/store') : url('jenis_produk/update/' . $data['id']) }}"
                            method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="hidden" name="id" id="id" value="{{ isset($data['id']) ? $data['id'] : '' }}">
                                <label for="nama_jenis">Nama Produk</label>
                                <input type="text" id="nama_jenis" name="nama_jenis" class="form-control"
                                    value="{{ isset($data['jenis_produk']) ? $data['jenis_produk'] : '' }}" required>
                            </div>

                            <a href="{{ url('jenis_produk') }}" class="btn mb-2 btn-outline-danger mx-2">Batal</a>
                            <button type="submit" class="btn mb-2 btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
        @section('script')
        @endsection
