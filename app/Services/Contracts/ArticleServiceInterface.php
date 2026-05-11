<?php

namespace App\Services\Contracts;

use App\Models\Articles;
interface ArticleServiceInterface{
    public function getDatatable();

    public function store(array $data);

    public function update(array $data, Articles $article);

    public function delete(Articles $article);

    public function multiDelete(array $ids);
}