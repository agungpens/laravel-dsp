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
        @elseif (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $errors->first() }}</strong>
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
                            aria-selected="false">{{ isset($data['page_name']) ? $data['page_name'] : '' }} Produk</a>
                    </li>
                </ul>

                <form class="col-md-12"
                    action=" @if (isset($data['page_name']) && $data['page_name'] == 'Edit') {{ url('produk/update') . '/' . $data['id'] }} @else {{ url('produk/store') }} @endif "
                    method="post" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="example-fileinput">Input Gambar Produk</label>
                                <input type="file" id="gambar_produk" name="gambar_produk" class="form-control-file">
                                {{-- isset page_name == edit, tampilkan gambarnya --}}
                                @if (isset($data['page_name']) && $data['page_name'] == 'Edit')
                                    <img src="{{ isset($data['gambar_produk']) ? asset('gambar_produk/' . $data['gambar_produk']) : '' }}"
                                        class="img-thumbnail mt-2" style="width: 100px; height: 100px;">
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="hidden" name="id" id="id"
                                    value="{{ isset($data['id']) ? $data['id'] : '' }}">
                                <input type="text" id="nama_produk" name="nama_produk" class="form-control"
                                    value="{{ isset($data['nama_produk']) ? $data['nama_produk'] : '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="jenis_produk">Jenis Produk</label>
                                <select class="form-control" id="jenis_produk" name="jenis_produk">
                                    <option value="">Pilih Jenis Produk</option>
                                    @foreach ($data['jenis_produk'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ isset($data['jenis_produk_id']) && $data['jenis_produk_id'] == $item->id ? 'selected' : '' }}>
                                            {{ $item->jenis_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="harga">Harga (Rp.)</label>
                                <input type="number" id="harga" name="harga" class="form-control"
                                    value="{{ isset($data['harga']) ? $data['harga'] : '' }}">
                            </div>
                        </div>

                        <div class="col-6">
                            @if (isset($data['page_name']) && $data['page_name'] == 'Edit')
                                <center>
                                    <label>Barcode Produk</label>
                                    {!! DNS2D::getBarcodeHTML($data['barcode'], 'QRCODE') !!}
                                    <br>
                                    {{ $data['barcode'] }}
                                </center>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="text-right">
                                <a href="{{ url('produk') }}" class="btn mb-2 btn-outline-danger mx-2">Batal</a>
                                <button type="submit" class="btn mb-2 btn bg-success-darker text-white">
                                    @if (isset($data['page_name']) && $data['page_name'] == 'Edit')
                                        Update
                                    @else
                                        Simpan
                                    @endif
                                    <i class="fe fe-chevron-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    @endsection
    @section('script')
        <script>
            $(document).ready(function() {
                $('#harga').on('input', function() {
                    if (this.value.length > 6) {
                        this.value = this.value.slice(0, 6);
                    }
                });
            });
        </script>
    @endsection
