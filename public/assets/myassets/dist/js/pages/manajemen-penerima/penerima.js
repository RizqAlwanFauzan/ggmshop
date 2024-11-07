$(function () {
    const konfigurasiDataTable = {
        scrollX: true,
        scrollCollapse: true,
        scrollY: '56.9vh',
        columnDefs: [{
            targets: [4],
            orderable: false,
            searchable: false
        }]
    };

    const dataTable = $("#table-penerima").DataTable(konfigurasiDataTable);

    $(document).on('click', 'a[href="#collapseTwo"]', function () {
        dataTable.columns.adjust().draw();
    });

    const request = '/manajemen-penerima/penerima/';
    const cache = {};

    $(document).on('click', '[data-target^="#modal-"]', function () {
        const id = $(this).data('id');
        const modalId = $(this).data('target');
        ambilData(id, modalId);
    });

    const ambilData = (id, modalId) => {
        if (cache[id]) {
            kirimData(modalId, cache[id]);
        } else {
            tampilkanLoading(modalId);
            $.ajax({
                url: url(`${request}${id}`),
                type: 'GET',
                success: (response) => {
                    cache[id] = response;
                    kirimData(modalId, response);
                },
                error: () => tampilkanError(modalId),
                complete: () => hilangkanLoading(modalId)
            });
        }
    };

    const kirimData = (modalId, data) => {
        const modal = $(modalId);
        const { id, nip, nik, nama, departemen_id, departemen, bagian_id, bagian, status_id, status, nomor_telepon, alamat } = data;
        switch (modalId) {
            case '#modal-detail':
                modal.find('#nip').text(nip);
                modal.find('#nik').text(nik);
                modal.find('#nama').text(nama);
                modal.find('#departemen').text(departemen?.nama);
                modal.find('#bagian').text(bagian?.nama || '-');
                modal.find('#status').text(status?.nama);
                modal.find('#nomor_telepon').text(nomor_telepon || '-');
                modal.find('#alamat').text(alamat);
                break;
            case '#modal-ubah':
                modal.find('form').attr('action', url(`${request}${id}`));
                modal.find('[name="id"]').val(id);
                modal.find('[name="nip"]').val(nip);
                modal.find('[name="nik"]').val(nik);
                modal.find('[name="nama"]').val(nama);
                modal.find('[name="departemen_id"]').val(departemen_id);
                modal.find('[name="bagian_id"]').val(bagian_id);
                modal.find('[name="status_id"]').val(status_id);
                modal.find('[name="nomor_telepon"]').val(nomor_telepon);
                modal.find('[name="alamat"]').val(alamat);
                break;
            case '#modal-hapus':
                modal.find('form').attr('action', url(`${request}${id}`));
                modal.find('#nip').text(nip);
                break;
        }
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

    $(document).on('hide.bs.modal', '.modal', function () {
        setTimeout(() => $(this).find('.is-invalid').removeClass('is-invalid'), 500);
    });
});
