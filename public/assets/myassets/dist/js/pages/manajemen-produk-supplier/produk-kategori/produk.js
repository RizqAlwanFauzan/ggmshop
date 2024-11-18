$(function () {
    const konfigurasiDataTable = {
        scrollX: true,
        scrollCollapse: true,
        scrollY: '56.9vh',
        columnDefs: [{
            targets: [3],
            orderable: false,
            searchable: false
        }]
    };

    const dataTable = $("#table-produk").DataTable(konfigurasiDataTable);
    const request = '/manajemen-produk-supplier/produk-kategori/produk/';

    $(document).on('click', 'a[href="#collapseTwo"]', function () {
        dataTable.columns.adjust().draw();
    });

    $(document).on('click', '[data-target^="#modal-"]', function () {
        const id = $(this).data('id');
        const modalId = $(this).data('target');
        tampilkanLoading(modalId);
        ambilData(id, modalId);
    });

    const ambilData = (id, modalId) => {
        $.ajax({
            url: url(`${request}${id}`),
            type: 'GET',
            success: (response) => isiModal(modalId, response),
            error: () => tampilkanError(modalId),
            complete: () => hilangkanLoading(modalId)
        });
    };

    const isiModal = (modalId, response) => {
        const modal = $(modalId);
        const { id, kode, nama, kategori_id, kategori, supplier_id, supplier, deskripsi } = response;
        const actions = {
            '#modal-detail': () => {
                modal.find('#kode').text(kode);
                modal.find('#nama').text(nama);
                modal.find('#kategori').text(kategori?.nama);
                modal.find('#supplier').text(supplier?.nama);
                modal.find('#deskripsi').text(deskripsi || '-');
            },
            '#modal-ubah': () => {
                modal.find('form').attr('action', url(`${request}${id}`));
                modal.find('[name="id"]').val(id);
                modal.find('[name="nama"]').val(nama);
                modal.find('[name="kategori_id"]').val(kategori_id);
                modal.find('[name="supplier_id"]').val(supplier_id);
                modal.find('[name="deskripsi"]').val(deskripsi);
            },
            '#modal-hapus': () => {
                modal.find('form').attr('action', url(`${request}${id}`));
                modal.find('#kode').text(kode);
            }
        };

        actions[modalId]?.();
    };

    const tampilkanLoading = (modalId) => {
        $(modalId).find('.modal-content').prepend('<div class="overlay"><i class="fas fa-2x fa-sync fa-spin"></i></div>');
    };

    const hilangkanLoading = (modalId) => {
        $(modalId).find('.overlay').remove();
    };

    const tampilkanError = (modalId) => {
        $(modalId).find('.modal-body').html('<p class="m-0">Terjadi kesalahan. Silakan coba lagi.</p>');
        $(modalId).find('.modal-footer').remove();
    };

    const modalUbah = $('#modal-ubah');
    if (modalUbah.find('.is-invalid').length) {
        const id = modalUbah.find('[name="id"]').val();
        modalUbah.find('form').attr('action', url(`${request}${id}`));
        setTimeout(() => modalUbah.modal('show'), 500);
    }
});
