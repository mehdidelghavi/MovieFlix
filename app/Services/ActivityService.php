<?php

namespace App\Services;

use App\Services\Contracts\ActivityServiceInterface;
use Morilog\Jalali\Jalalian;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;


class ActivityService implements ActivityServiceInterface
{

    public function getDatatable()
    {
        return DataTables::of(Activity::orderBy('id', 'desc')->with('causer'))
            ->editColumn('causer_id', function ($activity){
                return $activity->causer->name . ' ' . $activity->causer->family;
            })
            ->editColumn('properties', function ($activity){
                return $activity->properties['messages'];
            })
            ->editColumn('created_at', function ($activity){
                return Jalalian::forge($activity->created_at)->format('%A, %d %B %Y | H:i:s');
            })
            ->make(true);
    }
}