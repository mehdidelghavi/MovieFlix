<?php

namespace App\Services\Contracts;

use App\Models\Requirements;

interface RequirementServiceInterface{
    public function getDataTable();

    public function store(array $data);

    public function update(array $data,Requirements $requirement);

    public function delete(Requirements $requirement);

    public function multiDelete(array $ids);
}

