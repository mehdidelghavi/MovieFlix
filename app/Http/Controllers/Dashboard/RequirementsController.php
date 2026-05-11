<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Requirements\StoreRequirementRequest;
use App\Http\Requests\Dashboard\Requirements\UpdateRequirementRequest;
use App\Models\Requirements;
use App\Services\Contracts\RequirementServiceInterface;
use Illuminate\Http\Request;

class RequirementsController extends Controller
{

    public function __construct(private RequirementServiceInterface $requirementService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        if ($request->ajax()){
            return $this->requirementService->getDataTable();
        }
        return view('Dashboard.Requirements.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.Requirements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequirementRequest $request)
    {
        $createRequirement = $this->requirementService->store($request->validated());
        if ($createRequirement){
            return redirect()->route('dashboard.requirements')->with("success", "نیازمندی با موفقیت ثبت شد");
        } else {
            return redirect()->back()->with("failed", "متاسفانه خطایی در ثبت نیازمندی به وجود آمد");
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
    public function edit(Requirements $requirement)
    {
        return view("Dashboard.Requirements.edit", compact("requirement"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequirementRequest $request, Requirements $requirement)
    {
        $updateRequirement = $this->requirementService->update($request->validated(), $requirement);
        if ($updateRequirement){
            return redirect()->route('dashboard.requirements')->with("success", "نیازمندی با موفقیت ویرایش شد");
        } else {
            return redirect()->back()->with("failed", "متاسفانه خطایی در ویرایش نیازمندی به وجود آمد");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requirements $requirement)
    {
        $deleteRequirement = $this->requirementService->delete($requirement);
        if ($deleteRequirement){
            return redirect()->route('dashboard.requirements')->with("success", "نیازمندی با موفقیت حذف شد");
        } else {
            return redirect()->back()->with("failed", "متاسفانه خطایی در حذف نیازمندی به وجود آمد");
        }
    }

    public function multiDelete(Request $request){
        $request->validate([
            'requirements' => ['required']
        ]);
        $multiDelete = $this->requirementService->multiDelete($request->requirements);
        if ($multiDelete ){
            return redirect()->route('dashboard.requirements')->with("success", "نیازمندی ها با موفقیت حذف شد");
        } else {
            return redirect()->back()->with("failed", "متاسفانه خطایی در حذف نیازمندی ها به وجود آمد");
        }
    }
}
