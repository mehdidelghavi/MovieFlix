<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\Dashboard\AnswerTicket;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Tickets\AnswerTicketRequest;
use App\Models\Announcements;
use App\Models\Tickets;
use App\Services\Contracts\TicketServiceInterface;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class TicketsController extends Controller
{

    public function __construct(private TicketServiceInterface $ticketService){}
    public function index(Request $request){
        if ($request->ajax()){
            return $this->ticketService->getDatatable();
        }
        return view("Dashboard.Tickets.index");
    }

    public function show($ticket){
        $ticket = $this->ticketService->show($ticket);
        return view("Dashboard.Tickets.show", compact('ticket'));
    }

    public function close(Tickets $ticket){
        $closeTicket = $this->ticketService->close($ticket);
        if ($closeTicket){
            return redirect()->back()->with('success', 'تیکت با موفقیت بسته شد');
        } else {
            return redirect()->back()->with('failed', 'خطایی در بستن تیکت به وجود آمد');
        }
    }

    public function answer(AnswerTicketRequest $request,Tickets $ticket){
        $createTicket = $this->ticketService->answer($request->validated(), $ticket);
        if ($createTicket){
            return redirect()->route('dashboard.tickets')->with('success', 'تیکت با موفقیت ثبت شد');
        } else {
            return redirect()->back()->with('failed', 'خطایی در ثبت تیکت به وجود آمد');
        }
    }
}
