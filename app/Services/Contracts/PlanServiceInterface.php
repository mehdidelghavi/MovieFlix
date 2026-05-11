<?php

namespace App\Services\Contracts;

use App\Models\Plans;

interface PlanServiceInterface  
{
    public function getDatatable();

    public function store(array $data);

    public function update(array $data, Plans $plan);

    public function delete(Plans $plan);

    public function multiDelete(array $ids);
}