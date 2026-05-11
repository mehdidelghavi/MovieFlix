<?php

namespace App\Services\Contracts;

use App\Models\MovieList;

interface ListServiceInterface{
    public function getDatatable();

    public function store(array $data);

    public function update(array $data, $listID);

    public function delete($listID);

    public function multiDelete(array $listIDS);
}