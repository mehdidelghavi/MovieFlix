<?php

namespace App\Services;

use App\Models\Articles;
use App\Models\Movies;
use App\Models\Payments;
use App\Models\Plans;
use App\Models\Subescriptions;
use App\Models\Users;
use App\Services\Contracts\DashboardServiceInterface;


class DashboardService implements DashboardServiceInterface{

    public function index(){
        $userCount = Users::select('id')->count();
        $activeSubCount = Subescriptions::where('expireDate', ">", now())->count();
        $movieCount = Movies::count();
        $articleCount = Articles::count();
        $data = [
            'userCount' => $userCount,
            'activeSubCount' => $activeSubCount,
            'movieCount' => $movieCount,
            'articleCount' => $articleCount,
        ];
        return $data;
    }
}