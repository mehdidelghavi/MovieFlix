<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Lists\StoreListRequest;
use App\Http\Requests\Dashboard\Lists\UpdateListRequest;
use App\Models\MovieList;
use App\Services\Contracts\ListServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Str;
use Yajra\DataTables\DataTables;

class ListsController extends Controller
{

    public function __construct(private ListServiceInterface $listService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->listService->getDatatable();
        }
        return view("Dashboard.Lists.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard.Lists.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListRequest $request)
    {
        $createList = $this->listService->store($request->validated());
        if ($createList){
            return redirect()->route('dashboard.lists')->with('success', 'لیست با موفقیت ایجاد شد');
        } else {
            return redirect()->back()->with('failed', 'مشکلی در ایجاد لیست به وجود آمد');
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
    public function edit($listID)
    {
        $list = MovieList::where('id', $listID)->firstOrFail();
        return view("Dashboard.Lists.edit", compact('list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListRequest $request, $listID)
    {
        $updateList = $this->listService->update($request->validated(), $listID);
        if ($updateList){
            return redirect()->route('dashboard.lists')->with('success', 'لیست با موفقیت بروزرسانی شد');
        } else {
            return redirect()->back()->with('failed', 'مشکلی در بروزرسانی لیست به وجود آمد');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($listID)
    {
        $deleteList = $this->listService->delete($listID);
        if ($deleteList){
            return redirect()->back()->with('success', 'لیست با موفقیت حذف شد');
        } else {
            return redirect()->back()->with('failed', 'مشکلی در حذف لیست به وجود آمد');
        }
    }

    public function multiDelete(Request $request){
        $request->validate([
            'lists' => ['required', 'array']
        ]);
        $deleteLists = $this->listService->multiDelete($request->lists);
        if ($deleteLists){
            return redirect()->back()->with('success', 'لیست ها با موفقیت حذف شدند');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه لیست ها حذف نشدند');
        }
    }
}
