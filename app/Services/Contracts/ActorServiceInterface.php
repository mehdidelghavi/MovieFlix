<?php

namespace App\Services\Contracts;

use App\Models\Actors;

interface ActorServiceInterface
{
    public function getDatatable();

    public function store(array $data);

    public function update(array $data, Actors $actor);

    public function delete(Actors $actor);

    public function multiDelete(array $ids);
}