
@if(session('success'))
    <script>
        Swal.fire({
            type: "success",
            icon: "success",
            title: "موفقیت‌آمیز",
            text: '{{ session('success') }}',
            toast: true,
            position: 'top-end',
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 7000
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'خطا',
            text: '{{ session('error') }}',
            toast: true,
            position: 'top-end',
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 7000
        });
    </script>
@endif


