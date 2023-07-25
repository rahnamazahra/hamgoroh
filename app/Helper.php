<?php

if (! function_exists('handleFailedValidation'))
{
    function handleFailedValidation($validator)
    {

        $errorMessages = '';

        foreach ($validator->all() as $error) {
            $errorMessages .= $error . '\n';
        }

      echo generateScriptTag();
      echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "' . $errorMessages . '",
                toast: true,
                position: "top-end"
            });
        </script>';

        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}

function generateScriptTag()
{
    $scriptTag = '<script>
        alert("Hello, I\'m a script running from a helper file!");
    </script>';

    return $scriptTag;
}
?>
