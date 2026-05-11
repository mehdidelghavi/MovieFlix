<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Models\MovieList;
use App\Services\Contracts\ListServiceInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Services\Contracts\FileServiceInterface;

class ListService implements ListServiceInterface{
    public function __construct(private FileServiceInterface $fileService){}

    public function getDatatable(){
        $lists = MovieList::orderBy("updated_at","desc");
        return DataTables::of($lists)
                ->addColumn("actions", function ($lists){
                    return '<a href="' . route('dashboard.lists.destroy' , ['list' => $lists->id]) .'">
                                <button type="button" class="btn btn-icon btn-danger">
                                <span class="tf-icons bx bx-trash-alt"></span>
                                </button>
                            </a>
                            <a href="' . route('dashboard.lists.edit' , ['list' => $lists->id]) .'">
                                <button type="button" class="btn btn-icon btn-primary">
                                <span class="tf-icons bx bx-edit-alt"></span>
                                </button>
                            </a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
    }

    public function store(array $data){
        $data['generated_at'] = Carbon::now();
        $data['slug'] = mb_strtolower(preg_replace('/\s+/u', '-', trim($data['title'])));
        $algorithm = $data['algorithm'];
        if ($algorithm['award'] != null){
            $data['algorithm']['award'] = $algorithm['award'];
        }
        if ($algorithm['year'] != null){
            $data['algorithm']['year'] = $algorithm['year'];
        }
        if ($algorithm['sort_by'] != null){
            $data['algorithm']['sort_by'] = $algorithm['sort_by'];
        }
        if ($algorithm['limit'] != null){
            $data['algorithm']['limit'] = $algorithm['limit'];
        }
        $createList = MovieList::create($data);
        event(new AdminActions(['causer' => auth()->user(), 'model' => $createList], 'create', 'movie_list'));
        return $createList;
    }

    public function update(array $data, $listID){
        $list = MovieList::findOrFail($listID);
        $data['generated_at'] = Carbon::now();
        $data['slug'] = mb_strtolower(preg_replace('/\s+/u', '-', trim($data['title'])));
        $algorithm = $data['algorithm'];
        if ($algorithm ['award'] != null){
            $data['algorithm']['award'] = $algorithm ['award'];
        }
        if ($algorithm ['year'] != null){
            $data['algorithm']['year'] = $algorithm ['year'];
        }
        if ($algorithm ['sort_by'] != null){
            $data['algorithm']['sort_by'] = $algorithm ['sort_by'];
        }
        if ($algorithm ['limit'] != null){
            $data['algorithm']['limit'] = $algorithm ['limit'];
        }
        $updateList = $list->update($data);
        event(new AdminActions(['causer' => auth()->user(), 'model' => $list], 'update', 'movie_list'));
        return $updateList;
    }

    public function delete($listID){
        $list = MovieList::where('id', $listID)->firstOrFail();
        $deleteList = $list->delete();
        event(new AdminActions(['causer' => auth()->user(), 'model' => $list], 'delete', 'movie_list'));
        return $deleteList;
    }

    public function multiDelete(array $listIDS){
        $lists = MovieList::whereIn("id", $listIDS)->get();
        $deleteLists = MovieList::whereIn("id", $listIDS)->delete();
        foreach ($lists as $listItem){
            event(new AdminActions(['causer' => auth()->user(), 'model' => $listItem], 'update', 'movie_list'));
        }
        return $deleteLists;
    }
}