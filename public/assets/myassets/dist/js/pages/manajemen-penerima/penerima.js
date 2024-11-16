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
    const requestCRUD = '/manajemen-penerima/penerima/';
    const requestBagian = '/manajemen-penerima/bagian-by-departemen/';

    $(document).on('click', 'a[href="#collapseTwo"]', function () {
        dataTable.columns.adjust().draw();
    });

    $(document).on('click', '[data-target="#modal-detail"]', function () {
        const id = $(this).data('id');
        const modalId = '#modal-detail';
        modalAmbilData(id, modalId, kirimDataDetail);
    });

    $(document).on('click', '[data-target="#modal-ubah"]', function () {
        const id = $(this).data('id');
        const modalId = '#modal-ubah';
        modalAmbilData(id, modalId, kirimDataUbah);
    });

    $(document).on('click', '[data-target="#modal-hapus"]', function () {
        const id = $(this).data('id');
        const modalId = '#modal-hapus';
        modalAmbilData(id, modalId, kirimDataHapus);
    });

    $(document).on('change', '[name="departemen_id"]', function () {
        const departemenId = $(this).val();
        const bagianSelect = $(this).closest('form').find('[name="bagian_id"]');
        if (!departemenId) {
            return bagianSelect.prop('disabled', true).html('<option value="">-- Pilih --</option>');
        }

        ambilData(requestBagian, departemenId, (response) => kirimDataBagian(response, bagianSelect));
    });

    $(document).on('submit', 'form', function () {
        const bagianSelect = $(this).find('[name="bagian_id"]');
        if (bagianSelect.is(':disabled')) {
            bagianSelect.prop('disabled', false);
        }
    });

    $(document).on('hide.bs.modal', '.modal', function () {
        setTimeout(() => $(this).find('.is-invalid').removeClass('is-invalid'), 500);
    });

    $(document).on('reset', 'form', function () {
        $(this).find('[name="bagian_id"]').prop('disabled', true).html('<option value="">-- Pilih --</option>');
    });

    const modalAmbilData = (id, modalId, callback) => {
        tampilkanLoading(modalId);
        ambilData(requestCRUD, id, (response) => callback(response, modalId), () => tampilkanError(modalId), () => hilangkanLoading(modalId));
    };

    const ambilData = (request, key, callbackSuccess, callbackError = null, callbackComplete = null) => {
        $.ajax({
            url: url(`${request}${key}`),
            type: 'GET',
            success: (response) => callbackSuccess(response),
            error: () => callbackError && callbackError(),
            complete: () => callbackComplete && callbackComplete()
        });
    };

    const kirimDataDetail = (response, modalId) => {
        const modal = $(modalId);
        modal.find('#nip').text(response.nip);
        modal.find('#nik').text(response.nik);
        modal.find('#nama').text(response.nama);
        modal.find('#departemen').text(response.departemen?.nama);
        modal.find('#bagian').text(response.bagian?.nama || '-');
        modal.find('#status').text(response.status?.nama);
        modal.find('#nomor_telepon').text(response.nomor_telepon || '-');
        modal.find('#alamat').text(response.alamat);
    };

    const kirimDataUbah = (response, modalId) => {
        const modal = $(modalId);
        modal.find('form').attr('action', url(`${requestCRUD}${response.id}`));
        modal.find('[name="id"]').val(response.id);
        modal.find('[name="nip"]').val(response.nip);
        modal.find('[name="nik"]').val(response.nik);
        modal.find('[name="nama"]').val(response.nama);
        modal.find('[name="departemen_id"]').val(response.departemen_id);
        ambilData(requestBagian, response.departemen_id, (bagianResponse) => {
            kirimDataBagian(bagianResponse, modal.find('[name="bagian_id"]'));
            modal.find('[name="bagian_id"]').val(response.bagian_id);
        });
        modal.find('[name="status_id"]').val(response.status_id);
        modal.find('[name="nomor_telepon"]').val(response.nomor_telepon);
        modal.find('[name="alamat"]').val(response.alamat);
    };

    const kirimDataHapus = (response, modalId) => {
        const modal = $(modalId);
        modal.find('form').attr('action', url(`${requestCRUD}${response.id}`));
        modal.find('#nip').text(response.nip);
    };

    const kirimDataBagian = (response, bagianSelect) => {
        if (response && Object.keys(response).length > 0) {
            bagianSelect.prop('disabled', false).html('<option value="">-- Pilih --</option>');
            $.each(response, (id, nama) => {
                bagianSelect.append(new Option(nama, id));
            });
        } else {
            bagianSelect.prop('disabled', true).html('<option value="">Tidak ada bagian</option>');
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
        modalUbah.find('form').attr('action', url(`${requestCRUD}${id}`));
        setTimeout(() => modalUbah.modal('show'), 500);
    }
});
