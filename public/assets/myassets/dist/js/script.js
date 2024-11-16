$(function () {
    $(document).on('reset', 'form', function () {
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.invalid-feedback').remove();
        $(this).find('input:not([type="hidden"])').val('');
        $(this).find('textarea').text('');
    });
});
