<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFileToDO')) {
  function uploadFileToDO($file, $modelFolder)
  {
    $filesystem = Storage::disk('do');
    $modelFolder = $modelFolder;
    $fileName = "original_" . time() . rand(100, 350) . '.webp';
    $folder = config('filesystems.disks.do.folder');
    $filesystem->put("{$folder}/{$modelFolder}/{$fileName}", file_get_contents($file), 'public');

    return "{$folder}/{$modelFolder}/{$fileName}";
  }

  function uploadLargeThumbToDO($file, $modelFolder, $fileName)
  {
    $filesystem = Storage::disk('do');
    $modelFolder = $modelFolder;
    $fileName = str_replace("original_", "large_thumb_", $fileName);
    $fileName = replace_extension($fileName, 'webp');
    $folder = config('filesystems.disks.do.folder');

    $thumbImage = Image::make($file);
    $thumbImage->fit(1200, 730)->encode('webp');
    $filesystem->put("{$folder}/{$modelFolder}/{$fileName}", $thumbImage->getEncoded(), 'public');

    return "{$folder}/{$modelFolder}/{$fileName}";
  }

  function uploadSmallThumbToDO($file, $modelFolder, $fileName)
  {
    $filesystem = Storage::disk('do');
    $modelFolder = $modelFolder;
    $fileName = str_replace("original_", "small_thumb_", $fileName);
    $fileName = replace_extension($fileName, 'webp');
    $folder = config('filesystems.disks.do.folder');

    $thumbImage = Image::make($file);
    $thumbImage->fit(525, 320)->encode('webp');
    $filesystem->put("{$folder}/{$modelFolder}/{$fileName}", $thumbImage->getEncoded(), 'public');

    return "{$folder}/{$modelFolder}/{$fileName}";
  }
}

if (!function_exists('replace_extension')) {
  function replace_extension($filename, $new_extension)
  {
    $info = pathinfo($filename);
    return $info['filename'] . '.' . $new_extension;
  }
}
