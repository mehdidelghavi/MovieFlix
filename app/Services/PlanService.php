<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Models\Plans;
use App\Services\Contracts\PlanServiceInterface;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class PlanService implements PlanServiceInterface{
    public function getDatatable(){
            $plans = Plans::orderBy("updated_at","desc"); 
            return DataTables::of($plans)
            ->editColumn("price", function ($plans){
                return number_format($plans->price);
            })
            ->editColumn("updated_at", function ($plans){
                return Jalalian::forge($plans->updated_at)->format("Y-m-d H:i:s");
            })
            ->editColumn("discount", function ($plans){
                return $plans->discount . "%";
            })
            ->editColumn("about", function ($plans){
                return Str::limit($plans->about, "50" , "...");
            })
            ->addColumn("actions", function ($plans){
                return '<a href="' . route('dashboard.plans.destroy' , ['plan' => $plans->id]) .'">
                            <button type="button" class="btn btn-icon btn-danger">
                              <span class="tf-icons bx bx-trash-alt"></span>
                            </button>
                        </a>
                        <a href="' . route('dashboard.plans.edit' , ['plan' => $plans->id]) .'">
                            <button type="button" class="btn btn-icon btn-primary">
                              <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>';
            })
            ->rawColumns(["avatar", "actions"])
            ->make(true);
    }

    public function store(array $data){
        $data['price'] = str_replace(",","",$data['price']);
        $createPlan = Plans::create($data);
        event(new AdminActions(['causer' => auth()->user(), 'model' => $createPlan], 'create', 'plan'));
        return $createPlan;
    }

    public function update(array $data, Plans $plan){
        $data['price'] = str_replace(",","",$data['price']);
        $updatePlan = $plan->update($data);
        event(new AdminActions(['causer' => auth()->user(), 'model' => $plan], 'update', 'plan'));
        return $updatePlan;
    }

    public function delete(Plans $plan){
        $deletePlan = $plan->delete();
        event(new AdminActions(['causer' => auth()->user(), 'model' => $plan], 'delete', 'plan'));
        return $deletePlan;
    }

    public function multiDelete(array $ids) {
        $plans = Plans::whereIn("id", $ids)->get();
        $deletePlans = Plans::whereIn("id", $ids)->delete();
        foreach ($plans as $plan){
            event(new AdminActions(['causer' => auth()->user(), 'model' => $plan], 'delete', 'plan'));
        }
        return $deletePlans;
    }
}