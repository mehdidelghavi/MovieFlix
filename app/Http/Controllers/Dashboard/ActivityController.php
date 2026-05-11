<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ActivityServiceInterface;
use Illuminate\Http\Request;

/** مدیریت فعالیت های سایت */

class ActivityController extends Controller
{

    public function __construct(private ActivityServiceInterface $activityService){}


    public function index(Request $request){
        if ($request->ajax()){
            return $this->activityService->getDatatable();
        }
        return view('Dashboard.Activity.index');
    }
}
