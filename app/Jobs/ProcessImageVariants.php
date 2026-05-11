<?php

namespace App\Jobs;

use GdImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ProcessImageVariants implements ShouldQueue
{
    use Dispatchable,Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $path,public $modelId, public $modelType)
    {
        $this->outputBaseDirectory = "{$modelType}/{$modelId}/";    
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!Storage::disk("public")->exists($this->path)) {
            Log::warning("File Not Found");
        }   
        $sizes = [
            'small'  => [200, 200],
            'medium' => [600, 600],
            'large'  => [1200, 1200],
        ];
        foreach ($sizes as $folder => [$w, $h]) {

            $newPath = "uploads/{$folder}/" . basename($this->path);

            // ساخت نسخه resize شده
            $img = Image::read(Storage::get($this->path))->resize($w, $h);

            Storage::put($newPath, (string) $img);

            // بهینه‌سازی
            ImageOptimizer::optimize(storage_path("app/{$newPath}"));
        }
    }
}
