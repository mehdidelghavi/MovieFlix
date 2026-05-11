<?php

namespace App\Services;

use App\Events\Dashboard\AnswerTicket;
use App\Events\Dashboard\CloseTicket;
use App\Models\TicketReply;
use App\Models\Tickets;
use App\Services\Contracts\FileServiceInterface;
use App\Services\Contracts\TicketServiceInterface;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class TicketService implements TicketServiceInterface{

    public function __construct(private FileServiceInterface $fileService){}
    public function getDatatable(){
        $tickets = Tickets::orderByDesc("id")->where('status', '!=', 'بسته شد')->with('user');
            return DataTables::of($tickets)
                ->editColumn("updated_at", function ($tickets){
                    return Jalalian::forge($tickets->updated_at)->format('%A, %d %B %Y | H:i:s');
                })
                ->editColumn("user_id", function ($tickets){
                    if ($tickets->user_id == null){
                        return $tickets->email;
                    } else {
                        return "<a href='". route('dashboard.users.edit', ['user' => $tickets->user->id]) ."'>". $tickets->user->name. ' ' . $tickets->user->family ."</a>";
                    }
                })
                ->editColumn("departman", function ($tickets){
                    return $tickets->departmanFormat();
                })
                ->editColumn("status", function ($tickets){
                    return "<span class='badge bg-label-secondary'>$tickets->status</span>";
                })
                ->addColumn("actions", function ($tickets){
                    return '<a href="' . route('dashboard.tickets.show' , ['ticket' => $tickets->id]) .'">
                                <button type="button" class="btn btn-icon btn-warning">
                                <span class="tf-icons bx bx-glasses"></span>
                                </button>
                            </a>
                            <a href="' . route('dashboard.tickets.close' , ['ticket' => $tickets->id]) .'">
                                <button type="button" class="btn btn-icon btn-danger">
                                <span class="tf-icons bx bx-lock"></span>
                                </button>
                            </a>';
                })
                ->rawColumns(['actions', 'user_id', 'departman', 'status'])
                ->make(true);
    }

    public function show($ticket){
        return Tickets::with('replies', 'user')->where('id', $ticket)->firstOrFail();
    }

    public function close(Tickets $ticket){
        $closed = $ticket->update(['status' => 'بسته شد']);
        event(new CloseTicket($ticket->user, $ticket, auth()->user()));
        return $closed;
    }

    public function answer($data, Tickets $ticket){
        $data['user_id'] = auth()->user()->id;
        $data['ticket_id'] = $ticket->id;
        $data['subject'] = $ticket->subject;
        $data['last_reply'] = Carbon::now();
        if (isset($data['attachment'])){
            $data['attachment'] = $this->fileService->upload($data['attachment'], "tickets");
        }
        $createTicket = TicketReply::create($data);
        if ($createTicket){
            $ticket->update(['status' => 'پاسخ داده شده']);
            if ($ticket->user_id == null){
                event(new AnswerTicket($ticket->email, $ticket, auth()->user(), $data['text']));
            } else {
                event(new AnswerTicket($ticket->user, $ticket, auth()->user(), $data['text']));
            }
        }
        return $createTicket;
    }

}