<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Movies\StoreMovieRequest;
use App\Http\Requests\Dashboard\Movies\UpdateMovieRequest;
use App\Models\Actors;
use App\Models\Collections;
use App\Models\Episodes;
use App\Models\Genres;
use App\Models\MovieList;
use App\Models\Movies;
use App\Models\Qualities;
use App\Models\Seasons;
use App\Services\Contracts\MovieServiceInterface;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MoviesController extends Controller
{

    public function __construct(private MovieServiceInterface $movieService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->movieService->getDatatable();
        }
        return view('Dashboard.Movies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->movieService->create();
        return view('Dashboard.Movies.create',['genres' => $data['genres'], 'lists' => $data['lists']]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $thumbnail = $request->file('thumbnail');
        $trailer = $request->file('trailer');
        $createMovie = $this->movieService->store($request->safe()->except(['_token', 'thumbnail', 'trailer']), $thumbnail, $trailer);
        if ($createMovie){
            return redirect()->route('dashboard.movies')->with('success', 'فیلم با موفقیت آپلود و ثبت شد');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه مشکلی پیش آمد مجدد تلاش کنید');
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
    public function edit(Request $request, Movies $movie)
    {
        $selectedActors = [];
        $directors = $movie->director;
        $directors = Actors::whereIn('name', $directors)->get();
        $collection = $movie->collection;
        $selectedDirectors = [];
        $selectedCollection = [];
        foreach ($movie->actors as $selectedActor){
            $selectedActors[] = ['id' => $selectedActor->id, 'text' => $selectedActor->name];
        }
        foreach ($directors as $selectedDirector){
            $selectedDirectors[] = ['id' => $selectedDirector->id, 'text' => $selectedDirector->name];
        }
        if ($movie->collection){
            $selectedCollection[] = ['id' => $movie->collection->id, 'text' => $movie->collection->name];
        }
        $genres = Genres::orderByDesc('id')->get();
        $movie_genres = $movie->genres;
        $movieGenres = [];
        $movieLists = [];
        foreach ($movie_genres as $movieGenre){
            $movieGenres[] = $movieGenre->id;
        }
        $movie_lists = $movie->lists;
        foreach ($movie_lists as $movieList){
            $movieLists[] = $movieList->id;
        }
        $lists = MovieList::orderByDesc('updated_at')->get();
        return view("Dashboard.Movies.edit", compact('movie', 'selectedActors', 'selectedDirectors', 'genres', 'movieGenres', 'selectedCollection', 'movieLists', 'lists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movies $movie)
    {
        $thumbnail = $request->file('thumbnail');
        $trailer = $request->file('trailer');
        $updateMovie = $this->movieService->update($request->safe()->except(['_token', 'thumbnail', 'trailer']), $movie,$thumbnail, $trailer);
        if ($updateMovie){
            return redirect()->route('dashboard.movies')->with('success', 'فیلم با موفقیت آپلود و ویرایش شد');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه مشکلی پیش آمد مجدد تلاش کنید');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movies $movie)
    {
        $deleteMovie = $this->movieService->delete($movie);
        if ($deleteMovie){
            return redirect()->route('dashboard.movies')->with('success', 'فیلم با موفقیت حذف شد');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه مشکلی پیش آمد مجدد تلاش کنید');
        }
    }

    public function searchActors(Request $request){
        $search = $request->get('q', '');

        $users = Actors::query()
            ->where('name', 'like', "%{$search}%")
            ->select(['id', 'name as text'])
            ->limit(20)
            ->get();
    
        return response()->json($users);
    }

    public function multiDelete(Request $request){
        $request->validate([
            'movies' => ['required']
        ]);
        $deleteMovies = $this->movieService->multiDelete($request->movies);
        if ($deleteMovies){
            return redirect()->back()->with('success', 'فیلم ها با موفقیت حذف شدند');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه فیلم ها حذف نشدند');
        }
    }

    public function searchCollections(Request $request){
        $search = $request->get('q', '');

        $users = Collections::query()
            ->where('name', 'like', "%{$search}%")
            ->select(['id', 'name as text'])
            ->limit(20)
            ->get();
    
        return response()->json($users);
    }

    public function episodes(Movies $movie, Request $request){
        $seasons = $movie->seasons;
        $episodes = $movie->episodes;
        $files = collect();
        foreach ($episodes as $episode){
            foreach ($episode->qualities as $quality){
                $files->push($quality);
            }
        }
        if ($request->ajax()){
            return DataTables::of($files)
            ->editColumn('url', function ($files){
                if (filter_var($files->url, FILTER_VALIDATE_URL)){
                    $url = explode("/", $files->url);
                    return "<a href='" . $files->url . "'>" . $url[count($url) - 1] . "</a>";
                } else {
                    return "<a>" . $files->url . "</a>";
                }
            })
            ->editColumn('episode_id', function ($files){
                return "<a href='" . route('dashboard.movies.edit.episodes' , ['movie' => $files->episode->movie->id, 'episode' => $files->episode->id]) . "'>" . $files->episode->title . "</a>";
            })
            ->addColumn("season_id", function ($files){
                if ($files->episode->season()->exists()){
                    return "<a href='" . route('dashboard.movies.edit.episodes' , ['movie' => $files->episode->movie->id, 'season' => $files->episode->season->id]) . "'>" . $files->episode->season->name . "</a>";
                } else {
                    return "فاقد فصل";
                }
            })
            ->addColumn("actions", function ($files){
                return '<a href="' . route('dashboard.movies.destroy' , ['movie' => $files->episode->movie->id]) .'">
                            <button type="button" class="btn btn-icon btn-danger">
                            <span class="tf-icons bx bx-trash-alt"></span>
                            </button>
                        </a>
                        <a href="' . route('dashboard.movies.edit.episodes' , ['movie' => $files->episode->movie->id, 'quality' => $files->id]) .'">
                            <button type="button" class="btn btn-icon btn-primary">
                            <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>';
            })
            ->rawColumns(['actions', 'episode_id', 'season_id' , 'url'])
            ->make(true);
        }
        return view("Dashboard.Movies.episodes", compact('movie', 'seasons', 'episodes'));
    }

    public function seasonStore(Request $request,Movies $movie){
        $request->validate([
            'name' => ['required', 'string'],
            'number' => ['required', 'numeric']
        ]);
        $seasonData = [
            'name' => $request->name,
            'number' => $request->number
        ];
        $moviePath = "movies/" . str_replace(" ", "", $movie->title[1]);
        mkdir(public_path($moviePath . "/seasons/" . $request->number), 0777, true);
        $createSeason = $movie->seasons()->create($seasonData);
        if ($createSeason){
            return redirect()->back()->with('success','فصل با موفقیت ثبت شد');
        } else {
            return redirect()->back()->with('success','متاسفانه خطایی رخ داد');
        }
    }

    public function episodeStore(Request $request,Movies $movie){
        $request->validate([
            'title' => ['required', 'string'],
            'number' => ['required', 'numeric'],
            'duration' => ['required', 'numeric'],
            'season_id' => ['required', 'numeric']
        ]);
        $episodeData = [
            'title' => $request->title,
            'duration' => $request->duration,
            'number' => $request->number,
            'season_id' => $request->season_id != 0 ? $request->season_id : null,
            'has_persian_subtitle' => 0,
            'has_persian_dub' => 0
        ];
        if ($request->has('has_persian_subtitle')){
            $episodeData['has_persian_subtitle'] = 1;
        }
        if ($request->has('has_persian_dub')){
            $episodeData['has_persian_dub'] = 1;
        }
        $moviePath = "movies/" . str_replace(" ", "", subject: $movie->title[1]);
        $createEpisode = $movie->episodes()->create($episodeData);
        if ($request->season_id == 0){
            mkdir($moviePath . "/episodes", 0777 ,true);
        }
        if ($createEpisode){
            return redirect()->back()->with('success','قسمت با موفقیت ثبت شد');
        } else {
            return redirect()->back()->with('success','متاسفانه خطایی رخ داد');
        }
    }

    public function qualityStore(Request $request, Movies $movie){
        $request->validate([
            'quality' => ['required', 'string'],
            'format' => ['required', 'string'],
            'episode_id' => ['numeric'],
            'url' => ['required']
        ]);
        $qualityData = [
            'quality' => $request->quality,
            'format' => $request->input('format'),
            'episode_id' => $request->episode_id,
            'url' => $request->url
        ];
        $createQuality = Qualities::create($qualityData);
        if ($createQuality){
            $episode = $createQuality->episode;
            $movie = $episode->movie;

            $episode->touch();
            $movie->touch();
            return redirect()->back()->with('success','فایل با موفقیت ثبت شد');
        } else {
            return redirect()->back()->with('success','متاسفانه خطایی رخ داد');
        }
    }

    public function qualityUpload(Request $request, Movies $movie){
        $file = $request->file('file');
        $episode = $request->input('episode');
        $quality = $request->input('quality');

        $chunkIndex = $request->get('dzchunkindex');
        $totalChunks = $request->get('dztotalchunkcount');
        $identifier = $request->get('dzuuid');
        $filename = $request->get('dzuploadfilename', $file->getClientOriginalName());
        $episodeSelect = Episodes::where("id", $episode)->first();
        $qualitySelect = Qualities::where("id", $request->quality_id)->first();
        // مسیر موقت ذخیره‌سازی تکه‌ها
        $moviePath = "/app/private/movies/chunks/" . str_replace(" ", "", $movie->title[1]);
        $chunkDir = storage_path($moviePath . $identifier);
        if (!is_dir($chunkDir)) {
            mkdir($chunkDir, 0777, true);
        }

        // ذخیره تکه
        $file->move($chunkDir, $chunkIndex);
        $url = "";
        // اگر آخرین تکه است => ادغام کل فایل
        if ($chunkIndex == $totalChunks - 1) {
            if ($episodeSelect->season()->exists()){
                $moviePath = "app/private/movies/" . str_replace(" ", "", $movie->title[1]) . "/seasons/" . $episodeSelect->season->number;
                $filename = str_replace(" ", "", $movie->title[1]) . "S" . $episodeSelect->season->number . "E" . $episodeSelect->number . $quality . "." . $file->getClientOriginalExtension();
                $url= env('APP_URL') . "movies/" . str_replace(" ", "", $movie->title[1]) . "/seasons/" . $episodeSelect->season->number . "/" . $filename;
            } else {
                $moviePath = "app/private/movies/" . str_replace(" ", "", $movie->title[1]);
                $filename = str_replace(" ", "", $movie->title[1]) . $quality . "." . $file->getClientOriginalExtension();
                $url= env('APP_URL') . "movies/" . str_replace(" ", "", $movie->title[1]) . $filename;
            }
            if ($request->has('quality_id')){
                $urlSelect = explode("/", $qualitySelect->url);
                if (file_exists(storage_path('app/private/' . $moviePath) . '/' . $urlSelect[count($urlSelect) - 1])){
                    unlink(storage_path('app/private/' . $moviePath) . '/' . $urlSelect[count($urlSelect) - 1]);
                }
            }
            $finalPath = storage_path($moviePath);
            if (!is_dir($finalPath)) {
                mkdir($finalPath, 0777, true);
            }

            $finalFilePath = $finalPath . '/' . $filename;
            $output = fopen($finalFilePath, 'ab');

            for ($i = 0; $i < $totalChunks; $i++) {
                $chunk = fopen($chunkDir . '/' . $i, 'rb');
                stream_copy_to_stream($chunk, $output);
                fclose($chunk);
            }

            fclose($output);

            // حذف تکه‌ها
            array_map('unlink', glob($chunkDir . '/*'));
            rmdir($chunkDir);

            return response()->json(['status' => 'completed', 'url' => $filename]);
        }

        return response()->json(['status' => 'chunk_uploaded']);
    }

    public function editEpisode(Request $request, Movies $movie){
        $episode = null;
        $quality = null;
        $season = null;
        if ($request->has('quality')) {
            $quality = $request->quality;
            $quality = Qualities::where("id", $quality)->first();
        }
        if ($request->has('season')) {
            $season = $request->season;
            $season = Seasons::where("id", $season)->first();
        }
        if ($request->has('episode')) {
            $episode = $request->episode;
            $episode = Episodes::where("id", $episode)->first();
        }
        $seasons = $movie->seasons;
        $episodes = $movie->episodes;
        return view("Dashboard.Movies.episodes", compact('movie', 'seasons', 'episodes', 'episode', 'quality', 'season'));
    }

    public function updateEpisode(Request $request, Movies $movie){
        if ($request->has('episode')) {
            $request->validate([
                'title' => ['required', 'string'],
                'number' => ['required', 'numeric'],
                'duration' => ['required', 'numeric'],
                'season_id' => ['required', 'numeric']
            ]);
            $episodeData = [
                'title' => $request->title,
                'duration' => $request->duration,
                'number' => $request->number,
                'season_id' => $request->season_id != 0 ? $request->season_id : null,
                'has_persian_subtitle' => 0,
                'has_persian_dub' => 0
            ];
            if ($request->has('has_persian_subtitle')){
                $episodeData['has_persian_subtitle'] = 1;
            }
            if ($request->has('has_persian_dub')){
                $episodeData['has_persian_dub'] = 1;
            }
            $moviePath = "movies/" . str_replace(" ", "",$movie->title[1]);
            $updateEpisode = $movie->episodes()->update($episodeData);
            if ($request->season_id == 0){
                if (!is_dir($moviePath . "/episodes")){
                    mkdir($moviePath . "/episodes", 0777 ,true);
                }
            }
            if ($updateEpisode){
                return redirect()->route("dashboard.movies.episodes", ['movie' => $movie->id])->with('success','قسمت با موفقیت ویرایش شد');
            } else {
                return redirect()->back()->with('success','متاسفانه خطایی رخ داد');
            }
        }
        elseif ($request->has('season')){
            $request->validate([
                'name' => ['required', 'string'],
                'number' => ['required', 'numeric']
            ]);
            $seasonData = [
                'name' => $request->name,
                'number' => $request->number
            ];
            $moviePath = "movies/" . str_replace(" ", "", $movie->title[1]);
            if (!is_dir(public_path($moviePath . "/seasons/" . $request->number))){
                mkdir(public_path($moviePath . "/seasons/" . $request->number), 0777, true);
            }
            $updateSeason = $movie->seasons()->update($seasonData);
            if ($updateSeason){
                return redirect()->route("dashboard.movies.episodes", ['movie' => $movie->id])->with('success','فصل با موفقیت ویرایش شد');
            } else {
                return redirect()->back()->with('success','متاسفانه خطایی رخ داد');
            }
        } elseif($request->has('quality')){
            $request->validate([
                'quality' => ['required', 'string'],
                'format' => ['required', 'string'],
                'episode_id' => ['numeric'],
                'url' => ['required','active_url']
            ]);
            $qualityData = [
                'quality' => $request->quality,
                'format' => $request->input('format'),
                'episode_id' => $request->episode_id,
                'url' => $request->url
            ];
            $updateQuality = Qualities::where("id", $request->get('quality'))->update($qualityData);
            if ($updateQuality){
                $episode = $updateQuality->episode;
                $movie = $episode->movie;
    
                $episode->touch();
                $movie->touch();
                return redirect()->back()->with('success','فایل با موفقیت ویرایش شد');
            } else {
                return redirect()->back()->with('success','متاسفانه خطایی رخ داد');
            }
        }
    }
}
