<?php
use Illuminate\Support\Facades\Storage;

if(!defined('STATIC_DIR')){
    define('STATIC_DIR', sprintf('%s/../public/upload/',__DIR__));
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
            $fileName = time().'_'.$file->getClientOriginalName();
            $path     = $file->storeAs($storage_disk, $fileName);

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
    }

}

if(! function_exists('purge'))
{
    function purge($filePath)
    {
        if($filePath)
        {
            $file_path = sprintf('%s%s', STATIC_DIR, $filePath);

            if(file_exists($file_path))
            {
                unlink($file_path);

                return true;
            }
        }
    }
}
?>

