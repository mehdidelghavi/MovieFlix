<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Models\Genres;
use App\Services\Contracts\GenreServiceInterface;
use DB;
use Yajra\DataTables\DataTables;

class GenreService implements GenreServiceInterface{
    public function getDatatable(){
        $genres = Genres::orderBy("id","desc")->withCount('movies');
        return DataTables::of($genres)
                ->editColumn("genre_movie", function ($genres){
                    return $genres->movies_count;
                })
                ->addColumn("actions", function ($genres){
                    return '<a href="' . route('dashboard.genres.destroy' , ['genre' => $genres->id]) .'">
                                <button type="button" class="btn btn-icon btn-danger">
                                <span class="tf-icons bx bx-trash-alt"></span>
                                </button>
                            </a>
                            <a href="' . route('dashboard.genres.edit' , ['genre' => $genres->id]) .'">
                                <button type="button" class="btn btn-icon btn-primary">
                                <span class="tf-icons bx bx-edit-alt"></span>
                                </button>
                            </a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
    }

    public function store(array $data){
        return DB::transaction(function () use ($data){
            $createGenre = Genres::create($data);
            $eventData = [
                'causer' => auth()->user(),
                'model' => $createGenre
            ];
            event(new AdminActions($eventData, 'create', 'genre'));
            return $createGenre;
        });
    }

    public function update(array $data, Genres $genre){
        return DB::transaction(function () use ($data, $genre){
            $genreUpdate = $genre->update($data);
            $eventData = [
                'causer' => auth()->user(),
                'model' => $genre
            ];
            event(new AdminActions($eventData, 'update', 'genre'));
            return $genreUpdate;
        });
    }

    public function delete(Genres $genre){
        $genreDelete = $genre->delete();
        $eventData = [
            'causer' => auth()->user(),
            'model' => $genre
        ];
        event(new AdminActions($eventData, 'delete', 'genre'));
        return $genreDelete;
    }

    public function multiDelete(array $ids) {
        $genres = Genres::whereIn('id', $ids)->get();
        $deletedGenres = Genres::whereIn('id', $ids)->delete();
        foreach ($genres as $genre){
            $eventData = [
                'causer' => auth()->user(),
                'model' => $genre
            ];
            event(new AdminActions($eventData, 'delete', 'genre'));
        }
        return $deletedGenres;
    }
}