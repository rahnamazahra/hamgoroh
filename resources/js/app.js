import './bootstrap';

$(".input-just-number").keypress(function (evt) {
    const charCode = evt.which ? evt.which : event.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        evt.preventDefault();
    }
});

$(".btn_delete_item").on("click", function () {
    var url   = $(this).data("url");
    var id    = $(this).data('id');
    var token = $("meta[name='csrf-token']").attr("content");
    Swal.fire({
        html: `آیتم موردنظر حذف می‌شود، آیا ادامه می‌دهید؟`,
        icon: "error",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: 'بله',
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
                        toast: true,
                        position: "top-end",
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 7000,
                    });
                    window.location.reload();
                },
                error: function (xhr) {
                    Swal.fire({
                        title: "خطا",
                        text: "متاسفیم،اشکالی ناشناخته به وجود آمده است",
                        type: "error",
                        icon: "error",
                        toast: true,
                        position: "top-end",
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 7000,
                    });
                    window.location.reload();
                },
            });
        }
    });
});

