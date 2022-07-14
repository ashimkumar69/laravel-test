<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


if (!function_exists('storeFile')) {
    /**
     * SEO Friendly File Storing.
     *
     * @param UploadedFile $file
     * @param string $path
     * @param int $contentId
     * @param string|null $contentName // Required to be SEO Friendly, pass null if you're ignoring SEO.
     *
     * @return string
     */
    function storeFile(UploadedFile $file, string $path, int $contentId, ?string $contentName): string
    {
        if ($contentName === null) {
            return $file->store(
                "${path}/${contentId}",
                'public'
            );
        }

        $extension = $file->guessExtension();
        $hash = Str::random(10);
        $slug = Str::slug($contentName);
        return $file->storeAs(
            "${path}/${contentId}/${hash}",
            "${slug}.${extension}",
            'public'
        );
    }
}

if (!function_exists('deleteFile')) {
    /**
     * @param string $path
     * @param string|null $disk
     *
     * @return bool
     */
    function deleteFile(string $path, ?string $disk = 'public'): bool
    {
        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
            return true;
        }
        return false;
    }
}

//if (!function_exists('deleteFiles')) {
//    function deleteFiles($paths): bool
//    {
//        foreach ($paths as $path) {
//            if (Storage::exists($path)) {
//                Storage::delete($path);
//            }
//        }
//        return true;
//    }
//}
