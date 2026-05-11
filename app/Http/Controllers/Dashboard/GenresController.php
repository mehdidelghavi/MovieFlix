<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Genres\StoreGenreRequest;
use App\Http\Requests\Dashboard\Genres\UpdateGenreRequest;
use App\Models\Genres;
use App\Services\Contracts\GenreServiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GenresController extends Controller
{

    public function __construct(private GenreServiceInterface $genreService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->genreService->getDatatable();
        }
        return view("Dashboard.Genres.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard.Genres.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        $createGenre = $this->genreService->store($request->validated());
        if ($createGenre){
            return redirect()->route('dashboard.genres')->with('success','ژانر با موفقیت اضافه شد');
        } else {
            return redirect()->back()->with('failed','متاسفانه در افزودن ژانر خطایی رخ داد');
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
    public function edit(Genres $genre, Request $request)
    {
        return view("Dashboard.Genres.edit", compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Genres $genre,UpdateGenreRequest $request)
    {
        $updateGenre = $this->genreService->update($request->validated(), $genre);
        if ($updateGenre){
            return redirect()->route('dashboard.genres')->with('success','ژانر با موفقیت ویرایش شد');
        } else {
            return redirect()->back()->with('failed','متاسفانه در ویرایش ژانر خطایی رخ داد');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genres $genre)
    {
        $deleteGenre = $this->genreService->delete($genre);
        if ($deleteGenre){
            return redirect()->back()->with('success','ژانر با موفقیت حذف شد');
        } else {
            return redirect()->back()->with('failed','متاسفانه در حذف ژانر خطایی رخ داد');
        }
    }

    public function multiDelete(Request $request){
        $request->validate([
            'genres' => ['required', 'array']
        ]);
        $deleteGenres = $this->genreService->multiDelete($request->genres);
        if ($deleteGenres){
            return redirect()->back()->with('success', 'ژانر ها با موفقیت حذف شدند');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه ژانرها حذف نشدند');
        }
    }
}
