$(function () {
    $('.toastr').each(function () {
        const type = $(this).attr('type');
        const message = $(this).text().trim();

        if (message) {
            setTimeout(() => toastr[type](message), 500);
        }
    });
});
