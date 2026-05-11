<?php

namespace App\Services\Contracts;

use App\Models\Genres;

interface GenreServiceInterface
{
    public function getDatatable();

    public function store(array $data);

    public function update(array $data, Genres $genre);

    public function delete(Genres $genre);

    public function multiDelete(array $ids);
}