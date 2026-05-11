<?php

namespace App\Services\Contracts;

use App\Models\Movies;

interface MovieServiceInterface
{
    public function getDatatable();

    public function create();

    public function store(array $data, $thumbnail, $trailer);

    public function update(array $data, Movies $movie,$thumbnail, $trailer);

    public function delete(Movies $movie);

    public function multiDelete(array $ids);
}