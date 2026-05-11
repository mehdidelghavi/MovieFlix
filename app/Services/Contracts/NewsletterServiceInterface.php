<?php

namespace App\Services\Contracts;

use App\Models\Newsletters;

interface NewsletterServiceInterface{
    public function getDataTable();

    public function send($data);
    
    public function delete(Newsletters $newsletter);

    public function multiDelete(array $ids);
}