<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Models\RequirementFiles;
use App\Models\Requirements;
use App\Services\Contracts\FileServiceInterface;
use App\Services\Contracts\RequirementServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class RequirementService implements RequirementServiceInterface{
    public function __construct(private FileServiceInterface $fileService){}
    public function getDataTable(){
        $requirements = Requirements::orderByDesc("id")->withCount('files');
        return DataTables::of($requirements)
            ->editColumn("thumbnail", function ($requirements){
                return "<img src='". asset('storage/requirements/' . $requirements->thumbnail) ."' width='80' height='80' style='border-radius: 15px;'>";
            })
            ->addColumn("fileCount", function ($requirements){
                return $requirements->files_count;
            })
            ->addColumn("actions", function ($requirements){
                return '<a href="' . route('dashboard.requirements.destroy' , ['requirement' => $requirements->id]) .'">
                            <button type="button" class="btn btn-icon btn-danger">
                            <span class="tf-icons bx bx-trash-alt"></span>
                            </button>
                        </a>
                        <a href="' . route('dashboard.requirements.edit' , ['requirement' => $requirements->id]) .'">
                            <button type="button" class="btn btn-icon btn-primary">
                            <span class="tf-icons bx bx-edit-alt"></span>
                            </button>
                        </a>';
            })
            ->rawColumns(['actions','thumbnail'])
            ->make(true);
    }
    public function store(array $data){
        $data['slug'] = Str::slug($data['title']);
        $dataFiles = [];
        if (isset($data['group-a'])){
            $dataFiles = $data['group-a'];
            unset($data['group-a']);
        } 
        return DB::transaction( function () use ($data, $dataFiles){
            if (isset($data['thumbnail'])){
                $data['thumbnail'] = $this->fileService->upload($data['thumbnail'], 'requirements');
            }

            $createRequirement = Requirements::create($data);
            if (count($dataFiles) > 0 && $createRequirement){
                foreach ($dataFiles as $key => $value){
                    if ($value['title'] != null){
                        $file = $this->fileService->upload($value['file'], 'requirementFiles');
                        $createFiles = RequirementFiles::create([
                            'title' => $value['title'],
                            'format' => $value['format'],
                            'size' => $value['size'],
                            'file' => $file,
                            'requirement_id' => $createRequirement->id
                        ]);
                    }
                }
            }
            event(new AdminActions(['causer' => auth()->user(), 'model' => $createRequirement], 'create', 'requirement'));
            return $createRequirement;
        });
    }
    public function update(array $data, Requirements $requirement){
        $data['slug'] = Str::slug($data['title']);
        $dataFiles = [];
        if (isset($data['group-a'])){
            $dataFiles = $data['group-a'];
            unset($data['group-a']);
        } 
        return DB::transaction( function () use ($data, $requirement, $dataFiles){
            if (isset($data['thumbnail'])){
                $this->fileService->delete("requirements/",$requirement->thumbnail);
                $data['thumbnail'] = $this->fileService->upload($data['thumbnail'], 'requirements');
            }

            $updateRequirement = $requirement->update($data);
            if (count($dataFiles) > 0 && $updateRequirement){
                foreach ($dataFiles as $key => $value){
                    $previousFile = null;
                    $dataFileArray = [
                        'title' => $value['title'],
                        'format' => $value['format'],
                        'size' => $value['size'],
                        'file' => null,
                        'requirement_id' => $requirement->id
                    ];
                    if ($value['id'] != null){
                        $previousFile = RequirementFiles::where('id', $value['id'])->first();
                        $dataFileArray['file'] = $previousFile->file;
                    }
                    if (isset($value['file'])){
                        if ($value['id'] != null){
                            $this->fileService->delete('requirementFiles/', $previousFile->file);
                        }
                        $file = $this->fileService->upload($value['file'], 'requirementFiles');
                        $dataFileArray['file'] = $file;
                    }
                    if ($previousFile != null){
                        $previousFile->delete();
                    }
                    if ($value['title'] != null){
                        $updateRequirementFiles = RequirementFiles::create($dataFileArray);
                    }
                }
            } else {
                $previousFiles = $requirement->files;
                if ($previousFiles->count() > 0){
                    foreach ($previousFiles as $fileItems){
                        $this->fileService->delete('requirementFiles/', $fileItems->file);
                    }
                    RequirementFiles::where('requirement_id', $requirement->id)->delete();
                }
            }
            event(new AdminActions(['causer' => auth()->user(), 'model' => $requirement], 'update', 'requirement'));
            return $updateRequirement;
        });
    }
    public function delete(Requirements $requirement){
        $files = $requirement->files;
        return DB::transaction( function () use ($requirement, $files){
            if ($files->count() > 0){
                foreach ($files as $fileItems){
                    $this->fileService->delete("requirementFiles/",$fileItems->file);
                    $fileItems->delete();
                }
            }
            $this->fileService->delete("requirements/",$requirement->thumbnail);
            $deleteRequirement = $requirement->delete();
            event(new AdminActions(['causer' => auth()->user(), 'model' => $requirement], 'delete', 'requirement'));
            return $deleteRequirement;
        });
    }
    public function multiDelete(array $ids){
        return DB::transaction(function () use ($ids) {

            $requirements = Requirements::whereIn('id', $ids)->get();

            foreach ($requirements as $requirement) {
                $files = $requirement->files;
                if ($files->count() > 0){
                    foreach ($files as $fileItems){
                        $this->fileService->delete("requirementFiles/",$fileItems->file);
                        $fileItems->delete();
                    }
                }
                $this->fileService->delete('requirements/', $requirement->thumbnail);
                event(new AdminActions(['causer' => auth()->user(), 'model' => $requirement], 'delete', 'requirement'));
            }

            return Requirements::whereIn('id', $ids)->delete();
        });
    }
}