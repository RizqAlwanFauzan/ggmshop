@if (session('success'))
    <div class="d-none toastr" type="success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->hasBag('store'))
    <div class="d-none toastr" type="error">
        Data gagal disimpan, peiksa inputan anda!
    </div>
@endif

@if ($errors->hasBag('update'))
    <div class="d-none toastr" type="error">
        Data gagal diperbarui, peiksa inputan anda!
    </div>
@endif

@if ($errors->any())
    <div class="d-none toastr" type="error">
        Server error, silahkan coba lagi!
    </div>
@endif
