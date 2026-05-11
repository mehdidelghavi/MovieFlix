<?php

namespace App\Services\Contracts;



interface SettingServiceInterface{

    public function edit();

    public function update(array $data);
}