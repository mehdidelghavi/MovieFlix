<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Models\Collections;
use App\Services\Contracts\CollectionServiceInterface;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Services\Contracts\FileServiceInterface;

class CollectionService implements CollectionServiceInterface{
    public function __construct(private FileServiceInterface $fileService){}

    public function getDatatable(){
        $collections = Collections::orderByDesc("id");
        return DataTables::of($collections)
            ->editColumn("thumbnail", function ($collections){
                return "<img src='". asset('storage/collections/' . $collections->thumbnail) ."' width='80' height='80' style='border-radius: 15px;'>";
            })
            ->addColumn("actions", function ($collections){
                return '<a href="' . route('dashboard.collections.destroy' , ['collection' => $collections->id]) .'">
                            <button type="button" class="btn btn-icon btn-danger">
                            <span class="tf-icons bx bx-trash-alt"></span>
                            </button>
                        </a>
                        <a href="' . route('dashboard.collections.edit' , ['collection' => $collections->id]) .'">
                            <button type="button" class="btn btn-icon btn-primary">
                            <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>';
            })
            ->rawColumns(['actions','thumbnail'])
            ->make(true);
    }

    public function store(array $data){
        return DB::transaction( function () use ($data){
            if (isset($data['thumbnail'])){
                $data['thumbnail'] = $this->fileService->upload($data['thumbnail'], 'collections');
            }
            $collectionCreate = Collections::create($data);
            event(new AdminActions(['causer' => auth()->user(), 'model' => $collectionCreate], 'create', 'collection'));
            return $collectionCreate;
        });
    }

    public function update(array $data, Collections $collection){
        return DB::transaction(function () use ($data, $collection){
            if (isset($data['thumbnail'])){
                $this->fileService->delete('collections', $collection->thumbnail);
                $data['thumbnail'] = $this->fileService->upload($data['thumbnail'], 'collections');
            }
            $updateCollection = $collection->update($data);
            event(new AdminActions(['causer' => auth()->user(), 'model' => $collection], 'update', 'collection'));
            return $updateCollection;
        });
    }

    public function delete(Collections $collection){
        return DB::transaction( function () use ($collection){
            $this->fileService->delete('collections', $collection->thumbnail);
            $deleteCollection = $collection->delete();
            event(new AdminActions(['causer' => auth()->user(), 'model' => $collection], 'delete', 'collection'));
            return $deleteCollection;
        });
    }

    public function multiDelete(array $ids){
        return DB::transaction(function () use ($ids) {

            $collections = Collections::whereIn('id', $ids)->get();

            foreach ($collections as $collection) {
                $this->fileService->delete('collections', $collection->thumbnail);
                event(new AdminActions(['causer' => auth()->user(), 'model' => $collection], 'delete', 'collection'));
            }

            return Collections::whereIn('id', $ids)->delete();
        });
    }
}