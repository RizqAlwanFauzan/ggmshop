<x-layouts.app :title="$title">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Kuota</h3>
                </div>
                <form action="{{ route('manajemen-penerima.kuota.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fg-01">Nama Penerima <span class="text-red">*</span></label>
                            <select class="form-control select2bs4 @error('penerima_id', 'store') is-invalid @enderror" id="fg-01" name="penerima_id" style="width: 100%;">
                                <option value="">-- Pilih --</option>
                                @foreach ($penerima as $item)
                                    <option value="{{ $item->id }}" {{ $errors->hasBag('store') && old('penerima_id') == $item->id ? 'selected' : '' }}>{{ $item->nip }} - {{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('penerima_id', 'store')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-02">Nama Produk <span class="text-red">*</span></label>
                            <select class="form-control @error('produk_id', 'store') is-invalid @enderror" id="fg-02" name="produk_id">
                                <option value="">-- Pilih --</option>
                                @foreach ($produk as $id => $nama)
                                    <option value="{{ $id }}" {{ $errors->hasBag('store') && old('produk_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                            @error('produk_id', 'store')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-03">Jumlah <span class="text-red">*</span></label>
                            <input type="number" class="form-control @error('jumlah', 'store') is-invalid @enderror"" id="fg-03" name="jumlah" value="{{ $errors->hasBag('store') ? old('jumlah') : '' }}" placeholder="Isikan jumlah">
                            @error('jumlah', 'store')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
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
        <div class="col-12 col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Daftar Kuota</h3>
                </div>
                <div class="card-body">
                    <table id="table-kuota" class="table-striped table-bordered table-hover nowrap table-dark table" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Penerima</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kuota as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->penerima->nama }}</td>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>{{ $item->jumlah }}</td>
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

    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Kuota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-3">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-user mr-1"></i> Penerima</strong>
                            <p id="penerima" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-box-open mr-1"></i> Produk</strong>
                            <p id="produk" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-balance-scale mr-1"></i> Jumlah</strong>
                            <p id="jumlah" class="m-0"></p>
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
                    <h4 class="modal-title">Ubah Data Kuota</h4>
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
                            <label for="fg-11">Nama Penerima <span class="text-red">*</span></label>
                            <select class="form-control select2bs4 @error('penerima_id', 'update') is-invalid @enderror" id="fg-11" name="penerima_id" style="width: 100%;">
                                <option value="">-- Pilih --</option>
                                @foreach ($penerima as $item)
                                    <option value="{{ $item->id }}" {{ $errors->hasBag('store') && old('penerima_id') == $item->id ? 'selected' : '' }}>{{ $item->nip }} - {{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('penerima_id', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-12">Nama Produk <span class="text-red">*</span></label>
                            <select class="form-control @error('produk_id', 'update') is-invalid @enderror" id="fg-12" name="produk_id">
                                <option value="">-- Pilih --</option>
                                @foreach ($produk as $id => $nama)
                                    <option value="{{ $id }}" {{ $errors->hasBag('update') && old('produk_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                            @error('produk_id', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-13">Jumlah <span class="text-red">*</span></label>
                            <input type="number" class="form-control @error('jumlah', 'update') is-invalid @enderror"" id="fg-13" name="jumlah" value="{{ $errors->hasBag('update') ? old('jumlah') : '' }}" placeholder="Isikan jumlah">
                            @error('jumlah', 'update')
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
                    <h4 class="modal-title">Hapus Data Kuota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p class="m-0 text-center">Apakah anda yakin untuk menghapus data kuota dengan penerima <span id="penerima" class="text-bold"></span>?</p>
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
        <script src="{{ asset('assets/myassets/dist/js/pages/manajemen-penerima/kuota.js') }}"></script>
    @endsection
</x-layouts.app>
