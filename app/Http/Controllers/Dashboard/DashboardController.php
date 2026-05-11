<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Announcements;
use App\Models\Comments;
use App\Services\Contracts\DashboardServiceInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct(private DashboardServiceInterface $dashboardService){}
    public function index(){
        $data = $this->dashboardService->index();
        return view('Dashboard.index', ['userCount' => $data['userCount'], 'activeSubCount' => $data['activeSubCount'], 'movieCount' => $data['movieCount'], 'articleCount' => $data['articleCount']]);
    }

    public function handleAnnouncements($announcment){
        $announcment = Announcements::with('subject')->findOrFail($announcment);
        $url = $announcment->subject->route();
        $announcment->delete();
        return redirect($url);
    }
}
