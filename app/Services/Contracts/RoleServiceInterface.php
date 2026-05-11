<?php

namespace App\Services\Contracts;

use Spatie\Permission\Models\Role;


interface RoleServiceInterface{
    public function getDatatable();

    public function store(array $data);

    public function update(array $data, Role $role);

    public function delete(Role $role);

    public function multiDelete(array $ids);
}