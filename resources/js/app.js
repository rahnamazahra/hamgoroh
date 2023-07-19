import './bootstrap';

$(".btn_delete_item").on("click", function () {

    var url   = $(this).data("url");
    var id    = $(this).data('id');
    var token = $("meta[name='csrf-token']").attr("content");

    Swal.fire({
        html: `آیتم موردنظر حذف می‌شود، آیا ادامه می‌دهید؟`,
        icon: "error",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: '<a href="' + url + '" class="text-white">بله</a>',
        cancelButtonText: "لغو",
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-success",
        },
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                headers: { 'X-CSRF-TOKEN' : token },
                data: {
                    _method: "DELETE",
                    id: id,
                },
                success: function () {
                    Swal.fire({
                        title: "موفقیت‌آمیز",
                        text: "آیتم باموفقیت حذف شد",
                        type: "success",
                        icon: "success",
                        timer: 7000,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                    window.location.reload();
                },
                error: function (xhr) {
                    Swal.fire({
                        title: "خطا",
                        text: "متاسفیم،اشکالی ناشناخته به وجود آمده است",
                        type: "error",
                        icon: "error",
                        timer: 7000,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                    window.location.reload();
                },
            });
        }
    });
});

$(".btn_create_form").on("click", function () {
    var url  = $(this).data("url");
    const form = document.getElementById($(this).data("form-id"));
    const formData = {};

    for (let i = 0; i < form.elements.length; i++) {
        const element = form.elements[i];
        if (element.name) {
            formData[element.name] = element.value;
        }
    }

    //var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        success: function () {
            Swal.fire({
                text: "ثبت آیتم جدید با موفقیت انجام شد.",
                icon: "success",
                timer: 7000,
                showCancelButton: false,
                showConfirmButton: false,
            });
            window.location.reload();
        },
        error: function (xhr) {
            Swal.fire({
                title: "خطا",
                text: "متاسفیم،اشکالی ناشناخته به وجود آمده است",
                type: "error",
                icon: "error",
                timer: 7000,
                showCancelButton: false,
                showConfirmButton: false,
            });
        },
    });
});
