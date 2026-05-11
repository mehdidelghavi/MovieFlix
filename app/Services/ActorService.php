<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Models\Actors;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Services\Contracts\FileServiceInterface;
use App\Services\Contracts\ActorServiceInterface;


class ActorService implements ActorServiceInterface
{
    public function __construct(
        private FileServiceInterface $fileService
    ) {}

    public function getDatatable()
    {
        $actors = Actors::orderByDesc("id");
        return DataTables::of($actors)
            ->editColumn("thumbnail", function ($actor) {
                return "<img src='" . asset('storage/actors/' . $actor->thumbnail) . "' 
                        width='80' height='80' style='border-radius:15px;'>";
            })
            ->addColumn("actions", function ($actor) {
                return '<a href="' . route('dashboard.actors.destroy', ['actor' => $actor->id]) . '">
                            <button type="button" class="btn btn-icon btn-danger">
                                <span class="tf-icons bx bx-trash-alt"></span>
                            </button>
                        </a>
                        <a href="' . route('dashboard.actors.edit', ['actor' => $actor->id]) . '">
                            <button type="button" class="btn btn-icon btn-primary">
                                <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>';
            })
            ->rawColumns(['actions', 'thumbnail'])
            ->make(true);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            if (isset($data['thumbnail'])) {
                $data['thumbnail'] = $this->fileService->upload($data['thumbnail'], 'actors');
            }

            $createActor = Actors::create($data);
            $eventData = [
                'causer' => auth()->user(),
                'model' => $createActor
            ];
            event(new AdminActions($eventData, 'create', 'actor'));
            return $createActor;
        });
    }

    public function update(array $data, Actors $actor)
    {
        return DB::transaction(function () use ($data, $actor) {

            if (isset($data['thumbnail'])) {
                $this->fileService->delete('actors', $actor->thumbnail);

                $data['thumbnail'] =
                    $this->fileService->upload($data['thumbnail'], 'actors');
            }

            $updateActor = $actor->update($data);
            $eventData = [
                'causer' => auth()->user(),
                'model' => $actor
            ];
            event(new AdminActions($eventData, 'update', 'actor'));
            return $updateActor;
        });
    }

    public function delete(Actors $actor)
    {
        return DB::transaction(function () use ($actor) {
            $this->fileService->delete('actors', $actor->thumbnail);
            $deleteActor = $actor->delete();
            $eventData = [
                'causer' => auth()->user(),
                'model' => $actor
            ];
            event(new AdminActions($eventData, 'delete', 'actor'));
            return $deleteActor;
        });
    }

    public function multiDelete(array $ids)
    {
        return DB::transaction(function () use ($ids) {

            $actors = Actors::whereIn('id', $ids)->get();

            foreach ($actors as $actor) {
                $this->fileService->delete('actors', $actor->thumbnail);
                    $eventData = [
                    'causer' => auth()->user(),
                    'model' => $actor
                ];
                event(new AdminActions($eventData, 'delete', 'actor'));
            }

            return Actors::whereIn('id', $ids)->delete();
        });
    }
}