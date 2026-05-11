<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Events\Dashboard\CreateMovie;
use App\Models\Genres;
use App\Models\MovieList;
use App\Models\Movies;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Services\Contracts\FileServiceInterface;
use App\Services\Contracts\MovieServiceInterface;


class MovieService implements MovieServiceInterface
{
    public function __construct(
        private FileServiceInterface $fileService
    ) {}

    public function getDatatable()
    {
        $movies = Movies::orderByDesc('updated_at');
        return DataTables::of($movies)
        ->editColumn('title', function ($movies){
            return $movies->title[0];
        })
        ->editColumn("thumbnail", function ($movies){
            $thumbnailPath = "storage/movies/" . str_replace(" ", "", $movies->title[1]) . "/thumbnail/"; 
            return "<img src='". asset($thumbnailPath . $movies->thumbnail) ."' width='80' height='80' style='border-radius: 15px;'>";
        })
        ->editColumn('type', function ($movies){
            if ($movies->type == "movie"){
                return "فیلم";
            } elseif($movies->type == "series") {
                return "سریال";
            } elseif($movies->type == "animation"){
                return "انیمیشن";
            } elseif ($movies->type == "anime"){
                return "انیمه";
            }
        })
        ->addColumn("actions", function ($movies){
            return '<a href="' . route('dashboard.movies.episodes' , ['movie' => $movies->id]) .'">
                        <button type="button" class="btn btn-i  con btn-secondary">
                        مدیریت قسمت ها
                        </button>
                    </a>
                    <a href="' . route('dashboard.movies.destroy' , ['movie' => $movies->id]) .'">
                        <button type="button" class="btn btn-icon btn-danger">
                        <span class="tf-icons bx bx-trash-alt"></span>
                        </button>
                    </a>
                    <a href="' . route('dashboard.movies.edit' , ['movie' => $movies->id]) .'">
                        <button type="button" class="btn btn-icon btn-primary">
                        <span class="tf-icons bx bx-edit-alt"></span>
                        </button>
                    </a>';
        })
        ->rawColumns(['actions', 'thumbnail'])
        ->make(true);
    }

    public function create(){
        $genres = Genres::orderByDesc('id')->get();
        $lists = MovieList::orderByDesc('updated_at')->get();
        return [
            'genres' => $genres,
            'lists' => $lists
        ];
    }

    public function store(array $data,$thumbnail = null, $trailer = null)
    {
        $data['director'] = $data['directors'];
        $data['slug'] = Str::slug($data['title'][1]);
        if (isset($data['collection'])){
            $data['collection_id'] = $data['collection'];
        }
        return DB::transaction(function () use ($thumbnail, $trailer, $data){
            if ($thumbnail != null){
                $thumbnailPath = "movies/" . str_replace(" ", "",$data['title'][1]) . "/thumbnail/";
                $data['thumbnail'] = $this->fileService->upload($thumbnail, $thumbnailPath, $data['title'][1], true);
            }
            if ($trailer != null){
                $trailerPath = "movies/" . str_replace(" ", "",$data['title'][1]) . "/trailer/";
                $data['trailer'] = $this->fileService->upload($trailer, $trailerPath, $data['title'][1], true);
            }
            $createMovie = Movies::create($data);
            event(new AdminActions(['causer' => auth()->user(), 'model' => $createMovie], 'create', 'movie'));
            $createMovie->actors()->attach($data['actors']);
            $createMovie->genres()->attach($data['genres']);
            if (isset($data['lists'])){
                $createMovie->lists()->attach($data['lists']);
            }
            event(new CreateMovie(['title' => $data['title'], 'content' => "<p>سریال / فیلم {$createMovie->title[0]}  به تازگی منتشر شد</p>", 'link' => route('index.movie', ['slug' => $data['slug']])]));
            return $createMovie;
        });
    }

    public function update(array $data, Movies $movie,$thumbnail = null, $trailer = null)
    {
        $data['director'] = $data['directors'];
        $data['slug'] = Str::slug($data['title'][1]);
        if (isset($data['collection'])){
            $data['collection_id'] = $data['collection'];
        }
        return DB::transaction(function () use ($thumbnail, $trailer,$data, $movie){
            if ($thumbnail != null){
                $thumbnailPath = "movies/" . str_replace(" ", "",$data['title'][1]) . "/thumbnail/";
                if ($movie->thumbnail != null){
                    $deleteOldThumbnail = $this->fileService->delete($thumbnailPath, $movie->thumbnail);
                }
                $data['thumbnail'] = $this->fileService->upload($thumbnail, $thumbnailPath, $data['title'][1], true);
            }
            if ($trailer != null){
                $trailerPath = "movies/" . str_replace(" ", "",$data['title'][1]) . "/trailer/";
                if ($movie->trailer != null){
                    $deleteOldThumbnail = $this->fileService->delete($trailerPath, $movie->trailer);
                }
                $data['trailer'] = $this->fileService->upload($trailer, $trailerPath, $data['title'][1], true);
            }
            $updateMovie = $movie->update($data);
            if (isset($data['lists'] )){
                $movie->lists()->sync($data['lists']);
            }
            $movie->actors()->sync($data['actors']);
            $movie->genres()->sync($data['genres']);
            event(new AdminActions(['causer' => auth()->user(), 'model' => $movie], 'update', 'movie'));
            return $updateMovie;
        });
    }

    public function delete(Movies $movie)
    {
        $moviePath = "movies/" . str_replace(" ", "", $movie->title[1]); 
        Storage::disk("public")->deleteDirectory($moviePath);
        Storage::disk("local")->deleteDirectory($moviePath);
        $deleteMovie = $movie->delete();
        event(new AdminActions(['causer' => auth()->user(), 'model' => $movie], 'delete', 'movie'));
        return $deleteMovie;
    }

    public function multiDelete(array $ids)
    {
        return DB::transaction(function () use ($ids) {

            $movies = Movies::whereIn('id', $ids)->get();

            foreach ($movies as $movie) {
                $moviePath = "movies/" . str_replace(" ", "", $movie->title[1]); 
                Storage::disk("public")->deleteDirectory($moviePath);
                Storage::disk("local")->deleteDirectory($moviePath);
                event(new AdminActions(['causer' => auth()->user(), 'model' => $movie], 'delete', 'movie'));
            }

            return Movies::whereIn('id', $ids)->delete();
        });
    }
}