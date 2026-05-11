<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Collections\StoreCollectionRequest;
use App\Http\Requests\Dashboard\Collections\UpdateCollectionRequest;
use App\Models\Collections;
use App\Services\Contracts\CollectionServiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CollectionsController extends Controller
{
    public function __construct(private CollectionServiceInterface $collectionService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->collectionService->getDatatable();
        }
        return view("Dashboard.Collections.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard.Collections.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollectionRequest $request)
    {
        $createCollection = $this->collectionService->store($request->validated());
        if ($createCollection){
            return redirect()->route('dashboard.collections')->with("success", "کالکشن با موفقیت ثبت شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در ثبت کالکشن رخ داد");
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
    public function edit(Collections $collection)
    {
        return view("Dashboard.Collections.edit", compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollectionRequest $request, Collections $collection)
    {
        $updateCollection = $this->collectionService->update($request->validated(), $collection);
        if ($updateCollection){
            return redirect()->route('dashboard.collections')->with("success", "کالکشن با موفقیت ویرایش شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در ویرایش کالکشن رخ داد");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collections $collection)
    {
        $deleteCollection = $this->collectionService->delete($collection);
        if ($deleteCollection){
            return redirect()->back()->with("success", "کالکشن با موفقیت حذف شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در حذف کالکشن رخ داد");
        }
    }

    public function multiDelete(Request $request){
        $request->validate([
            'collections' => ['required', 'array']
        ]);
        $deleteCollections = $this->collectionService->multiDelete($request->collections);
        if ($deleteCollections){
            return redirect()->back()->with('success', 'کالکشن ها با موفقیت حذف شدند');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه کالکشن ها حذف نشدند');
        }
    }
}
