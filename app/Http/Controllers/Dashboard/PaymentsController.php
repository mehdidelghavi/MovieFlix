<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $payments = Payments::orderByDesc("created_at")->with('plan', 'user');
            return DataTables::of($payments)
                ->editColumn("plan_id", function ($payments){
                    return $payments->plan->title;
                })
                ->editColumn("user_id", function ($payments){
                    return "<a href=". route('dashboard.users.edit', ['user' => $payments->user->id]) .">". $payments->user->name . " " . $payments->user->family  ."</a>";
                })
                ->editColumn("status", function ($payments){
                    return $payments->getFormattedStatusAttribute();
                })
                ->editColumn("created_at", function ($payments){
                    return Jalalian::forge($payments->created_at)->format('%A, %d %B %Y | H:i:s');
                })
                ->editColumn("updated_at", function ($payments){
                    return Jalalian::forge($payments->updated_at)->format('%A, %d %B %Y | H:i:s');
                })
                ->addColumn('price', function ($payments){
                    return number_format($payments->plan->price) . " تومان ";
                })
                ->rawColumns(['status', 'user_id'])
                ->make(true);
        }
        return view("Dashboard.Payments.index");
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
