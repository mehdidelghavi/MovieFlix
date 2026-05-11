<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subescriptions;
use App\Services\Contracts\SubscriptionServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class SubscriptionsController extends Controller
{

    public function __construct(private SubscriptionServiceInterface $subscriptionService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->subscriptionService->getDatatable();
        }
        return view("Dashboard.Subscriptions.index");
    }

    public function disable(Subescriptions $subscription){
        $disableSub = $this->subscriptionService->disable($subscription);
        if ($disableSub){
            return redirect()->back()->with('success', 'اشتراک با موفقیت غیر فعال شد');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه خطایی در غیر فعال کردن اشتراک رخ داد');
        }
    }

    public function enable(Subescriptions $subscription){
        $enableSub = $this->subscriptionService->enable($subscription);
        if ($enableSub){
            return redirect()->back()->with('success', 'اشتراک با موفقیت فعال شد');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه خطایی در فعال کردن اشتراک رخ داد');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
