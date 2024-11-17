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

    $(document).on('click', '[data-target^="#modal-"]', function () {
        const id = $(this).data('id');
        const modalId = $(this).data('target');
        tampilkanLoading(modalId);
        ambilData(requestCRUD, id, (response) => isiModal(modalId, response), () => tampilkanError(modalId), () => hilangkanLoading(modalId));
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

    $(document).on('reset', 'form', function () {
        $(this).find('[name="bagian_id"]').prop('disabled', true).html('<option value="">-- Pilih --</option>');
    });

    const ambilData = (request, key, callbackSuccess, callbackError = null, callbackComplete = null) => {
        $.ajax({
            url: url(`${request}${key}`),
            type: 'GET',
            success: (response) => callbackSuccess(response),
            error: () => callbackError?.(),
            complete: () => callbackComplete?.()
        });
    };

    const isiModal = (modalId, response) => {
        const modal = $(modalId);
        const { id, nip, nik, nama, departemen_id, departemen, bagian_id, bagian, status_id, status, nomor_telepon, alamat } = response;
        const actions = {
            '#modal-detail': () => {
                modal.find('#nip').text(nip);
                modal.find('#nik').text(nik);
                modal.find('#nama').text(nama);
                modal.find('#departemen').text(departemen?.nama);
                modal.find('#bagian').text(bagian?.nama || '-');
                modal.find('#status').text(status?.nama);
                modal.find('#nomor_telepon').text(nomor_telepon || '-');
                modal.find('#alamat').text(alamat);
            },
            '#modal-ubah': () => {
                modal.find('form').attr('action', url(`${requestCRUD}${id}`));
                modal.find('[name="id"]').val(id);
                modal.find('[name="nip"]').val(nip);
                modal.find('[name="nik"]').val(nik);
                modal.find('[name="nama"]').val(nama);
                modal.find('[name="departemen_id"]').val(departemen_id);
                ambilData(requestBagian, departemen_id, (bagianResponse) => {
                    kirimDataBagian(bagianResponse, modal.find('[name="bagian_id"]'));
                    modal.find('[name="bagian_id"]').val(bagian_id);
                });
                modal.find('[name="status_id"]').val(status_id);
                modal.find('[name="nomor_telepon"]').val(nomor_telepon);
                modal.find('[name="alamat"]').val(alamat);
            },
            '#modal-hapus': () => {
                modal.find('form').attr('action', url(`${requestCRUD}${id}`));
                modal.find('#nip').text(nip);
            }
        };

        actions[modalId]?.();
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
