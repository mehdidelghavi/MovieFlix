<?php

namespace App\Services\Contracts;

interface FileServiceInterface
{
    public function upload($file, string $path, string $title = null,bool $isMovie = false): string;

    public function delete(string $path, ?string $fileName): void;
}