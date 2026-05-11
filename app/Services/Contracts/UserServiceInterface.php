<?php

namespace App\Services\Contracts;

use App\Models\Users;

interface UserServiceInterface
{
    public function getDatatable();

    public function store(array $data);

    public function create();
    
    public function edit(Users $user);

    public function update(array $data, Users $user);

    public function delete(Users $user);

    public function multiDelete(array $ids);

    public function getData();
}