<?php
namespace App\Services;

use App\Jobs\ProcessImageVariants;
use App\Services\Contracts\FileServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class FileService implements FileServiceInterface
{
    public function upload($file, string $path,string $title = null,bool $isMovie = false): string
    {
        $fileName = null;
        if (!$isMovie){
            $fileName = uniqid().'.'.$file->getClientOriginalExtension();
            $uploadFile = $file->storeAs($path, $fileName, 'public');
        } else {
            $fileName = time() . "-" . str_replace(" ", "",$title) . '.' . $file->getClientOriginalExtension();
            $uploadFile = $file->storeAs($path, $fileName, 'public');
        }
        return $fileName;
    }

    public function delete(string $path, ?string $fileName, $isMovie = false): void
    {
        if (!$fileName) return;
        $fullPath = "{$path}{$fileName}";
        if (Storage::disk("public")->exists($fullPath)) {
            Storage::disk("public")->delete($fullPath);
        }
    }
}