<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Plans\StorePlanRequest;
use App\Http\Requests\Dashboard\Plans\UpdatePlanRequest;
use App\Models\Plans;
use App\Services\Contracts\PlanServiceInterface;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Str;
use Yajra\DataTables\DataTables;

class PlansController extends Controller
{

    public function __construct(private PlanServiceInterface $planService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->planService->getDatatable();
        }
        return view("Dashboard.Plans.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard.Plans.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanRequest $request)
    {
        $createPlan = $this->planService->store($request->validated());
        if ($createPlan){
            return redirect()->route('dashboard.plans')->with('success','تعرفه با موفقیت افزوده شد');
        } else {
            return redirect()->back()->with('failed','مشکلی در افزودن تعرفه پیش آمد');
        }
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
    public function edit(Plans $plan)
    {
        return view("Dashboard.Plans.edit", compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanRequest $request, Plans $plan)
    {
        $updatePlan = $this->planService->update($request->validated(), $plan);
        if ($updatePlan){
            return redirect()->route('dashboard.plans')->with('success','تعرفه با موفقیت ویرایش شد');
        } else {
            return redirect()->back()->with('failed','مشکلی در ویرایش تعرفه پیش آمد');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plans $plan)
    {
        $deletePlan = $this->planService->delete($plan);
        if ($deletePlan){
            return redirect()->back()->with("success", "تعرفه با موفقیت حذف شد");
        } else {
            return redirect()->back()->with("failed","متاسفانه مشکلی در حذف تعرفه به وجود آمد");
        }
    }

    public function multiDelete(Request $request){
        $request->validate([
            'plans' => ['required', 'array']
        ]);
        $deletePlans = $this->planService->multiDelete($request->input('plans'));
        if ($deletePlans){
            return redirect()->back()->with('success', 'تعرفه ها با موفقیت حذف شدند');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه تعرفه ها حذف نشدند');
        }
    }
}
