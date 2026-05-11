<?php

namespace App\Services\Contracts;

use App\Models\Tickets;



interface TicketServiceInterface
{
    public function getDatatable();

    public function show($tickets);

    public function close(Tickets $tickets);

    public function answer(array $data, Tickets $tickets);

}