<?php

if(!defined('STATIC_DIR')){
    define('STATIC_DIR', sprintf('%s','/../public/upload',__DIR__));
}

if (! function_exists('handleFailedValidation'))
{
    function handleFailedValidation($validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}

if (! function_exists('Alert'))
{
    function Alert($type, $message)
    {
        if ($type == 'success')
        {
            session()->flash('swal', [
                'title' => 'موفقیت آمیز!',
                'text' => $message,
                'icon' => $type,
            ]);
        }
        else
        {
            session()->flash('swal', [
                'title' => 'خطا',
                'text' => $message,
                'icon' => $type,
            ]);
        }
    }
}

if(! function_exists('uploadFile'))
{
    function uploadFile($storage_disk, array $files, array $data = [])
    {
        foreach ($files as $related_field => $file)
        {
            $fileName = time().'_'.$files[$related_field]->getClientOriginalName();

            $path = $file->store($storage_disk);

            App\Models\File::create([
                'name'           => $fileName,
                'path'           => $path,
                'size'           => $files[$related_field]->getSize(),
                'mime'           => $files[$related_field]->getClientMimeType(),
                'fileable_id'    => $data['fileable_id'],
                'fileable_type'  => $data['fileable_type'],
                'related_field'  => $related_field,
            ]);
        }
        return true;

        /*
           // in MyRequest File
            'avatar'        => 'nullable|file|max:2048|mimes:jpg, jpeg, png',
            'attachment'    => 'nullable|file|max:2048|mimes:jpg, jpeg, png, pdf, csv, txt, xlx, xls, doc, docx',
        */

        /*
        // in controller

        if($request->hasFile('attachment')) {

            $attachment  = $request->file('attachment');
        }
        if($request->hasFile('attachment')) {
        $avatar  = $request->file('avatar');
        }

        $storage_dir = '/user';
        $uploded = uploadFile($storage_dir, ['attachment' => $attachment, 'avatar' => $avatar], ['fileable_id' => $user->id, 'fileable_type' => User::class]);


        }
        */
        /*
        //in view blade
           <form method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
             //TEST
                  <input type="file" name="attachment"/>
                  <input type="file" name="avatar"/>
                  <button type="submit">ok</button>
            </form>

        */
    }

}
?>

