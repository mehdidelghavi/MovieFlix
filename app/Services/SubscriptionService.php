<?php

namespace App\Services;

use App\Models\Subescriptions;
use App\Services\Contracts\SubscriptionServiceInterface;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class SubscriptionService implements SubscriptionServiceInterface{
    public function getDatatable(){
        $subscriptions = Subescriptions::orderByDesc("created_at")->with('plan', 'user', 'payment');
            return DataTables::of($subscriptions)
                ->editColumn("plan_id", function ($subscriptions){
                    return $subscriptions->plan->title;
                })
                ->editColumn("user_id", function ($subscriptions){
                    return "<a href=". route('dashboard.users.edit', ['user' => $subscriptions->user->id]) .">". $subscriptions->user->name . " " . $subscriptions->user->family  ."</a>";
                })
                ->editColumn("expireDate", function ($subscriptions){
                    return Jalalian::forge($subscriptions->expireDate)->format('%A, %d %B %Y | H:i:s');
                })
                ->editColumn("created_at", function ($subscriptions){
                    return Jalalian::forge($subscriptions->created_at)->format('%A, %d %B %Y | H:i:s');
                })
                ->addColumn('status', function ($subscriptions){
                    return $subscriptions->statusFormat();
                })
                ->addColumn('actions', function ($subscription){
                    return '<a href="'. route('dashboard.subscriptions.enable', ['subscription' => $subscription->id]) .'">
                                    <button type="button" class="btn btn-icon btn-success">
                                    <span class="tf-icons bx bx-check"></span>
                                    </button>
                                </a>
                                <a href="'. route('dashboard.subscriptions.disable', ['subscription' => $subscription->id]) .'">
                                    <button type="button" class="btn btn-icon btn-danger">
                                    <span class="tf-icons bx bx-block"></span>
                                    </button>
                                </a>';
                })
                ->rawColumns(['user_id', 'status', 'actions'])
                ->make(true);
    }

    public function disable(Subescriptions $subscription){
        return $subscription->update(['expireDate' => Carbon::now()]);
    }

    public function enable(Subescriptions $subscription){
        $plan = $subscription->plan;
        return $subscription->update([
            'expireDate' => Carbon::parse($subscription->created_at)->addDays((int) $plan->duration)
        ]);
    }
}