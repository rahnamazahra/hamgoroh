

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

{{--  @if(session('errors'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'خطا',
             html: '<ul class="list-disc pl-5">' +
            '@foreach ($errors->all() as $error)' +
                '<li>{!! $error !!}</li>' +
            '@endforeach' +
          '</ul>',
            toast: true,
            position: 'top-end',
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 7000
        });
    </script>
@endif  --}}


