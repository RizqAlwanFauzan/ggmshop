<x-layouts.app :title="$title">
    <div class="row">
        <div class="col-12" id="accordion">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                            Tambah Produk
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="collapse {{ $errors->hasBag('store') ? 'show' : '' }}" data-parent="#accordion">
                    <form action="{{ route('manajemen-produk-supplier.produk-kategori.produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="fg-01">Nama Produk <span class="text-red">*</span></label>
                                        <input type="text" class="form-control @error('nama', 'store') is-invalid @enderror"" id="fg-01" name="nama" value="{{ $errors->hasBag('store') ? old('nama') : '' }}" placeholder="Isikan nama produk">
                                        @error('nama', 'store')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="fg-02">Kategori <span class="text-red">*</span></label>
                                        <select class="form-control @error('kategori_id', 'store') is-invalid @enderror" id="fg-02" name="kategori_id">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($kategori as $id => $nama)
                                                <option value="{{ $id }}" {{ $errors->hasBag('store') && old('kategori_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id', 'store')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="fg-03">Supplier <span class="text-red">*</span></label>
                                        <select class="form-control @error('supplier_id', 'store') is-invalid @enderror" id="fg-03" name="supplier_id">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($supplier as $id => $nama)
                                                <option value="{{ $id }}" {{ $errors->hasBag('store') && old('supplier_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id', 'store')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fg-04">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi', 'store') is-invalid @enderror" id="fg-04" name="deskripsi" rows="3" placeholder="Isikan deskripsi">{{ $errors->hasBag('store') ? old('deskripsi') : '' }}</textarea>
                                @error('deskripsi', 'store')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Reset</button>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                            Daftar Produk
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="collapse {{ $errors->hasBag('store') ? '' : 'show' }}" data-parent="#accordion">
                    <div class="card-body">
                        <table id="table-produk" class="table-striped table-bordered table-hover nowrap table-dark table" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Produk</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center"><span class="badge badge-light">{{ $item->kode }}</span></td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-xs btn-menu" data-toggle="modal" data-target="#modal-detail" data-id="{{ $item->id }}"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-warning btn-xs btn-menu text-white" data-toggle="modal" data-target="#modal-ubah" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs btn-menu" data-toggle="modal" data-target="#modal-hapus" data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Produk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-3">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-key mr-1"></i> Kode</strong>
                            <p id="kode" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-box-open mr-1"></i> Nama</strong>
                            <p id="nama" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-boxes mr-1"></i> kategori</strong>
                            <p id="kategori" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-truck mr-1"></i> supplier</strong>
                            <p id="supplier" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-file-alt mr-1"></i> Deskripsi</strong>
                            <p id="deskripsi" class="m-0"></p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger btn-sm btn-block" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-ubah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Produk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $errors->hasBag('update') ? old('id') : '' }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fg-11">Nama Produk <span class="text-red">*</span></label>
                            <input type="text" class="form-control @error('nama', 'update') is-invalid @enderror"" id="fg-11" name="nama" value="{{ $errors->hasBag('update') ? old('nama') : '' }}" placeholder="Isikan nama produk">
                            @error('nama', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-12">Kategori <span class="text-red">*</span></label>
                            <select class="form-control @error('kategori_id', 'update') is-invalid @enderror" id="fg-12" name="kategori_id">
                                <option value="">-- Pilih --</option>
                                @foreach ($kategori as $id => $nama)
                                    <option value="{{ $id }}" {{ $errors->hasBag('update') && old('kategori_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-13">Supplier <span class="text-red">*</span></label>
                            <select class="form-control @error('supplier_id', 'update') is-invalid @enderror" id="fg-13" name="supplier_id">
                                <option value="">-- Pilih --</option>
                                @foreach ($supplier as $id => $nama)
                                    <option value="{{ $id }}" {{ $errors->hasBag('update') && old('supplier_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-14">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi', 'update') is-invalid @enderror" id="fg-14" name="deskripsi" rows="3" placeholder="Isikan deskripsi">{{ $errors->hasBag('update') ? old('deskripsi') : '' }}</textarea>
                            @error('deskripsi', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Produk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p class="m-0 text-center">Apakah anda yakin untuk menghapus data produk dengan nip <span id="nip" class="text-bold"></span>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tidak</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
        <script src="{{ asset('assets/myassets/dist/js/pages/manajemen-produk-supplier/produk-kategori/produk.js') }}"></script>
    @endsection
</x-layouts.app>
