//Alert message For Handle Store/Update
@if(session('swal'))
    <script>
        Swal.fire({
            title: "{{ session('swal.title') }}",
            text: "{{ session('swal.text') }}",
            icon: "{{ session('swal.icon') }}",
            toast: true,
            position: 'top-end',
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 7000
        });
    </script>
@endif

//Alert message For Handle Failed Validation
@if(session('errors'))
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
            showCloseButton: true,
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 7000
        });
    </script>
@endif

{{--  const errors = {!! json_encode(session('errors')->all()) !!};
@if(session('errors'))
<script>
function displayToast(errors) {
  let errorMessage = '';
  errors.forEach(error => {
    errorMessage += `${error}\n`;
  });

  swal.fire({
    icon: 'error',
    title: 'خطا',
    text: errorMessage,
    toast: true,
    position: 'top-end',
    showCloseButton: true,
    timerProgressBar: true,
    showConfirmButton: false,
  });
}

displayToast(errors);
