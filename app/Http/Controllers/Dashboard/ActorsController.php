<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Actors\StoreActorRequest;
use App\Http\Requests\Dashboard\Actors\UpdateActorRequest;
use App\Models\Actors;
use App\Services\Contracts\ActorServiceInterface;
use Illuminate\Http\Request;

class ActorsController extends Controller
{

    public function __construct(private ActorServiceInterface $actorService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->actorService->getDatatable();
        }
        return view("Dashboard.Actors.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard.Actors.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActorRequest $request)
    {
        $createActor = $this->actorService->store($request->validated());
        if ($createActor){
            return redirect()->route('dashboard.actors')->with("success", "بازیگر با موفقیت ثبت شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در ثبت بازیگر رخ داد");
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
    public function edit(Actors $actor)
    {
        return view("Dashboard.Actors.edit", compact('actor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActorRequest $request, Actors $actor)
    {
        $updateActor = $this->actorService->update($request->validated(),$actor);
        if ($updateActor){
            return redirect()->route('dashboard.actors')->with("success", "بازیگر با موفقیت ویرایش شد");
        } else {
            return redirect()->back()->with("failed", "خطایی در ویرایش بازیگر رخ داد");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actors $actor)
    {
        $deleteActor = $this->actorService->delete($actor);
        if ($deleteActor){
            return redirect()->back()->with("success","بازیگر با موفقیت حذف شد");
        } else {
            return redirect()->back()->with("failed","متاسفانه خطایی در حذف بازیگر رخ داد");
        }
    }

    public function multiDelete(Request $request){
        $request->validate([
            'actors' => ['required','array']
        ]);
        $deleteActors = $this->actorService->multiDelete($request->actors);
        if ($deleteActors){
            return redirect()->back()->with('success', 'بازیگران با موفقیت حذف شدند');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه بازیگران حذف نشدند');
        }
    }
}
