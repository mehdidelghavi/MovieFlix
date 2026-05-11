<?php

namespace App\Services\Contracts;

use App\Models\Collections;
interface CollectionServiceInterface{
    public function getDatatable();

    public function store(array $data);

    public function update(array $data, Collections $collection);

    public function delete(Collections $collection);

    public function multiDelete(array $ids);
}