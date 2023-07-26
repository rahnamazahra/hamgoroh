<?php

//Alert message For Handle Failed Validation
if (! function_exists('handleFailedValidation'))
{
    function handleFailedValidation($validator)
    {
       // $validatorErrors = session()->flash('validatorErrors', $validator->errors->all());
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}

//Alert message For Handle Store/Update
if (! function_exists('Alert')) {
    function Alert($type)
    {
        if ($type == 'success')
        {
            session()->flash('swal', [
                'title' => 'موفقیت آمیز!',
                'text' => 'اطلاعات باموفقیت ثبت شد.',
                'icon' => $type,
            ]);
        }
        else
        {
            session()->flash('swal', [
                'title' => 'خطا',
                'text' => 'اشکالی ناشناخته به وجود آمده است.',
                'icon' => $type,
            ]);
        }
    }
}
?>
