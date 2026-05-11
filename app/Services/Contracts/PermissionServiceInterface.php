<?php

namespace App\Services\Contracts;

use Spatie\Permission\Models\Permission;


interface PermissionServiceInterface{
    public function getDatatable();

    public function store(array $data);

    public function update(array $data, Permission $permission);

    public function delete(Permission $permission);

    public function multiDelete(array $ids);
}