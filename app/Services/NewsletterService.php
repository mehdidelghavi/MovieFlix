<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Jobs\SendNewsletterEmail;
use App\Models\Newsletters;
use App\Services\Contracts\NewsletterServiceInterface;
use Yajra\DataTables\DataTables;

class NewsletterService implements NewsletterServiceInterface{
    public function getDataTable(){
        $newsletters = Newsletters::orderBy("id","desc");
        return DataTables::of($newsletters)
                ->addColumn("actions", function ($newsletters){
                    return '<a href="' . route('dashboard.newsletter.destroy' , ['newsletter' => $newsletters->id]) .'">
                                <button type="button" class="btn btn-icon btn-danger">
                                <span class="tf-icons bx bx-trash-alt"></span>
                                </button>
                            </a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
    }

    public function send($data){
        Newsletters::chunk(100, function ($subscribers) use ($data){
            foreach ($subscribers as $subscribe){
                $data['email'] = $subscribe->email;
                dispatch(new SendNewsletterEmail($data));
            }
            event(new AdminActions(['causer' => auth()->user(), 'model' => $data], 'create', 'newsletter'));
        });
    }

    public function delete(Newsletters $newsletter){
        return $newsletter->delete();
    }

    public function multiDelete(array $ids){
        return Newsletters::whereIn('id', $ids)->delete();
    }
}