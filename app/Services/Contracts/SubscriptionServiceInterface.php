<?php

namespace App\Services\Contracts;

use App\Models\Subescriptions;


interface SubscriptionServiceInterface
{
    public function getDatatable();

    public function disable(Subescriptions $subscription);

    public function enable(Subescriptions $subscription);

}