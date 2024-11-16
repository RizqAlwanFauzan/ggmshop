<x-layouts.app :title="$title">
    <div class="row">
        <div class="col-12" id="accordion">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                            Tambah Penerima
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="collapse {{ $errors->hasBag('store') ? 'show' : '' }}" data-parent="#accordion">
                    <form action="{{ route('manajemen-penerima.penerima.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="fg-01">NIP <span class="text-red">*</span></label>
                                        <input type="number" class="form-control @error('nip', 'store') is-invalid @enderror"" id="fg-01" name="nip" value="{{ $errors->hasBag('store') ? old('nip') : '' }}" placeholder="Isikan NIP penerima">
                                        @error('nip', 'store')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fg-02">NIK <span class="text-red">*</span></label>
                                        <input type="number" class="form-control @error('nik', 'store') is-invalid @enderror"" id="fg-02" name="nik" value="{{ $errors->hasBag('store') ? old('nik') : '' }}" placeholder="Isikan NIK penerima">
                                        @error('nik', 'store')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fg-03">Nama <span class="text-red">*</span></label>
                                        <input type="text" class="form-control @error('nama', 'store') is-invalid @enderror"" id="fg-03" name="nama" value="{{ $errors->hasBag('store') ? old('nama') : '' }}" placeholder="Isikan nama penerima">
                                        @error('nama', 'store')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="fg-04">Departemen <span class="text-red">*</span></label>
                                        <select class="form-control @error('departemen_id', 'store') is-invalid @enderror" id="fg-04" name="departemen_id">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($departemen as $id => $nama)
                                                <option value="{{ $id }}" {{ $errors->hasBag('store') && old('departemen_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('departemen_id', 'store')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fg-05">Bagian</label>
                                        <select class="form-control @error('bagian_id', 'store') is-invalid @enderror" id="fg-05" name="bagian_id" {{ $errors->hasBag('store') && isset($bagian) && $bagian->isNotEmpty() ? '' : 'disabled' }}>
                                            <option value="">{{ $errors->hasBag('store') && isset($bagian) && $bagian->isEmpty() ? 'Tidak ada bagian' : '-- Pilih --' }}</option>
                                            @if ($errors->hasBag('store') && isset($bagian))
                                                @foreach ($bagian as $id => $nama)
                                                    <option value="{{ $id }}" {{ $errors->hasBag('store') && old('bagian_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('bagian_id', 'store')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fg-06">Status <span class="text-red">*</span></label>
                                        <select class="form-control @error('status_id', 'store') is-invalid @enderror" id="fg-06" name="status_id">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($status as $id => $nama)
                                                <option value="{{ $id }}" {{ $errors->hasBag('store') && old('status_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('status_id', 'store')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fg-07">Nomor Telepon</label>
                                <input type="number" class="form-control @error('nomor_telepon', 'store') is-invalid @enderror"" id="fg-07" name="nomor_telepon" value="{{ $errors->hasBag('store') ? old('nomor_telepon') : '' }}" placeholder="Isikan nomor telepon penerima">
                                @error('nomor_telepon', 'store')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fg-08">Alamat <span class="text-red">*</span></label>
                                <textarea class="form-control @error('alamat', 'store') is-invalid @enderror" id="fg-08" name="alamat" rows="3" placeholder="Isikan alamat penerima">{{ $errors->hasBag('store') ? old('alamat') : '' }}</textarea>
                                @error('alamat', 'store')
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
                            Daftar Penerima
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="collapse {{ $errors->hasBag('store') ? '' : 'show' }}" data-parent="#accordion">
                    <div class="card-body">
                        <table id="table-penerima" class="table-striped table-bordered table-hover nowrap table-dark table" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penerima as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center"><span class="badge badge-light">{{ $item->nip }}</span></td>
                                        <td class="text-center"><span class="badge badge-light">{{ $item->nik }}</span></td>
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
                    <h4 class="modal-title">Detail Penerima</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-3">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-key mr-1"></i> NIP</strong>
                            <p id="nip" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-address-card mr-1"></i> NIK</strong>
                            <p id="nik" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-user mr-1"></i> Nama</strong>
                            <p id="nama" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-sitemap mr-1"></i> Departemen</strong>
                            <p id="departemen" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="far fa-stop-circle mr-1"></i> Bagian</strong>
                            <p id="bagian" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-user-clock mr-1"></i> Status</strong>
                            <p id="status" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-phone-alt mr-1"></i> Nomor Telepon</strong>
                            <p id="nomor_telepon" class="m-0"></p>
                        </li>
                        <li class="list-group-item">
                            <strong class="text-muted"><i class="fas fa-map-marked-alt mr-1"></i> Alamat</strong>
                            <p id="alamat" class="m-0"></p>
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
                    <h4 class="modal-title">Ubah Data Status</h4>
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
                            <label for="fg-11">NIP <span class="text-red">*</span></label>
                            <input type="number" class="form-control @error('nip', 'update') is-invalid @enderror"" id="fg-11" name="nip" value="{{ $errors->hasBag('update') ? old('nip') : '' }}" placeholder="Isikan NIP penerima">
                            @error('nip', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-12">NIK <span class="text-red">*</span></label>
                            <input type="number" class="form-control @error('nik', 'update') is-invalid @enderror"" id="fg-12" name="nik" value="{{ $errors->hasBag('update') ? old('nik') : '' }}" placeholder="Isikan NIK penerima">
                            @error('nik', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-13">Nama <span class="text-red">*</span></label>
                            <input type="text" class="form-control @error('nama', 'update') is-invalid @enderror"" id="fg-13" name="nama" value="{{ $errors->hasBag('update') ? old('nama') : '' }}" placeholder="Isikan nama penerima">
                            @error('nama', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-14">Departemen <span class="text-red">*</span></label>
                            <select class="form-control @error('departemen_id', 'update') is-invalid @enderror" id="fg-14" name="departemen_id">
                                <option value="">-- Pilih --</option>
                                @foreach ($departemen as $id => $nama)
                                    <option value="{{ $id }}" {{ $errors->hasBag('update') && old('departemen_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                            @error('departemen_id', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-15">Bagian</label>
                            <select class="form-control @error('bagian_id', 'update') is-invalid @enderror" id="fg-15" name="bagian_id" {{ $errors->hasBag('update') && isset($bagian) && $bagian->isNotEmpty() ? '' : 'disabled' }}>
                                <option value="">{{ $errors->hasBag('update') && isset($bagian) && $bagian->isEmpty() ? 'Tidak ada bagian' : '-- Pilih --' }}</option>
                                @if ($errors->hasBag('update') && isset($bagian))
                                    @foreach ($bagian as $id => $nama)
                                        <option value="{{ $id }}" {{ $errors->hasBag('update') && old('bagian_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('bagian_id', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-16">Status <span class="text-red">*</span></label>
                            <select class="form-control @error('status_id', 'update') is-invalid @enderror" id="fg-16" name="status_id">
                                <option value="">-- Pilih --</option>
                                @foreach ($status as $id => $nama)
                                    <option value="{{ $id }}" {{ $errors->hasBag('update') && old('status_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                            @error('status_id', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-17">Nomor Telepon</label>
                            <input type="number" class="form-control @error('nomor_telepon', 'update') is-invalid @enderror"" id="fg-17" name="nomor_telepon" value="{{ $errors->hasBag('update') ? old('nomor_telepon') : '' }}" placeholder="Isikan nomor telepon penerima">
                            @error('nomor_telepon', 'update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fg-18">Alamat <span class="text-red">*</span></label>
                            <textarea class="form-control @error('alamat', 'update') is-invalid @enderror" id="fg-18" name="alamat" rows="3" placeholder="Isikan alamat penerima">{{ $errors->hasBag('update') ? old('alamat') : '' }}</textarea>
                            @error('alamat', 'update')
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
                    <h4 class="modal-title">Hapus Data Penerima</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p class="m-0 text-center">Apakah anda yakin untuk menghapus data penerima dengan nip <span id="nip" class="text-bold"></span>?</p>
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
        <script src="{{ asset('assets/myassets/dist/js/pages/manajemen-penerima/penerima.js') }}"></script>
    @endsection
</x-layouts.app>
