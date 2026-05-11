<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Newsletters\SendNewsletterRequest;
use App\Models\Newsletters;
use App\Services\Contracts\NewsletterServiceInterface;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{

    public function __construct(private NewsletterServiceInterface $newsletterService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->newsletterService->getDataTable();
        }
        return view('Dashboard.Newsletter.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.Newsletter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function send(SendNewsletterRequest $request)
    {
        $data = $request->validated();
        try{
            $this->newsletterService->send($data);
            return redirect()->back()->with('success', 'خبر نامه با موفقیت در صف ارسال قرار گرفت');
        } catch (\Exception $e) { 
            return redirect()->back()->with('failed', 'متاسفانه خطایی رخ داد' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletters $newsletter)
    {
        $deleteMember = $this->newsletterService->delete($newsletter);
        if ($deleteMember){
            return redirect()->back()->with('success', 'عضو با موفیت حذف شد');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه خطایی در حذف عضو به وجود آمد');
        }
    }

    public function multiDelete(Request $request){
        $ids = $request->ids;
        $multiDelete = $this->newsletterService->multiDelete($ids);
        if ($multiDelete){
            return redirect()->back()->with('success', 'اعضا با موفیت حذف شد');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه خطایی در حذف اعضا به وجود آمد');
        }
    }
}
