<?php

namespace App\Http\Controllers\Panel;

use App\Events\UserTicket;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\MovieReaction;
use App\Models\TicketReply;
use App\Models\Tickets;
use App\Models\User;
use App\Models\Users;
use App\Models\WatchHistory;
use App\Services\Contracts\FileServiceInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Morilog\Jalali\Jalalian;
use Str;
use Yajra\DataTables\DataTables;

class PanelController extends Controller
{
    public function __construct(private FileServiceInterface $fileService){}
    public function index(){
        $user = auth()->user();
        $activeSub = $user->subscription()->where('expireDate', '>', Carbon::now())->first();
        $ticketCount = Tickets::where('user_id', $user->id)->count();
        $commentsCount = Comments::where('user_id', $user->id)->count();
        $likesCount = MovieReaction::where('user_id', $user->id)->where('reaction', 1)->count();
        $watchedMovies = $user->watched()->select('movies.id', 'movies.title', 'movies.time', 'movies.slug')->with('genres')->orderByPivot('watched_at', 'desc')->limit(5)->get();
        $comments = $user->comments()->with(['commentable' => function ($query){
            $query->select('id','slug','title');
        }, 'reactions'])->withCount([
            'reactions as likes_count' => function ($query){
                $query->where('reaction', 1);
            },
            'reactions as dislikes_count' => function ($query){
                $query->where('reaction', -1);
            }
        ])->get();
        $likedMovies = $user->movieLiked()->select('movies.id', 'movies.title', 'movies.slug', 'movies.imdb')->withCount([
            'reactions as likes_count' => function ($query) {
                $query->where('reaction', 1);
            },
            'reactions as dislikes_count' => function ($query) {
                $query->where('reaction', -1);
            }
        ])->orderByDesc('movies.updated_at')->limit(5)->get();
        return view('Panel.index', compact('user', 'activeSub', 'ticketCount', 'commentsCount', 'likesCount', 'watchedMovies', 'watchedMovies', 'comments', 'likedMovies'));
    }

    public function sendTicket(){
        return view('Panel.sendTicket');
    }

    public function sendTicketDo(Request $request,Tickets $ticket = null){
        if ($ticket != null){
            $request->validate([
                'text' => ['required'],
                'attachment' => ['nullable', 'mimes:png,jpg,webp']
            ]);
            $ticketData = [
                'user_id' => auth()->user()->id,
                'ticket_id' => $ticket->id,
                'text' => $request->text,
                'last_reply' => Carbon::now()
            ];
            if ($request->has('attachment')){
                $ticketData['attachment'] = $this->fileService->upload($request->attachment, 'tickets');
            }
            $createTicket = TicketReply::create($ticketData);
            if ($createTicket){
                $updateTicketStatus = $ticket->update(['status' => 'پاسخ مشتری']);
                event(new UserTicket(auth()->user(), $ticket->ticket_number, $createTicket));
                return redirect()->back()->with('success', "پاسخ به تیکت شماره #{$ticket->ticket_number} با موفقیت ارسال شد");
            } else {
                return redirect()->back()->with('failed', 'متاسفانه خطایی در ارسال تیکت به وجود آمد لطفا مجدد تلاش کنید');
            }
        } else {
            $request->validate([
                'subject' => ['required'],
                'text' => ['required'],
                'departman' => ['required'],
                'attachment' => ['nullable', 'mimes:png,jpg,webp']
            ]);
            $ticketData = [
                'subject' => $request->subject,
                'user_id' => auth()->user()->id,
                'text' => $request->text,
                'departman' => $request->departman,
                'status' => 'در انتظار پاسخ'
            ];
            if ($request->has('attachment')){
                $ticketData['attachment'] = $this->fileService->upload($request->attachment, 'tickets');
            }
            $ticketData['ticket_number'] = random_int(10000000,99999999);
            $createTicket = Tickets::create($ticketData);
            if ($createTicket){
                event(new UserTicket(auth()->user(), $ticketData['ticket_number'], $createTicket));
                return redirect()->back()->with('success', 'تیکت شما به شماره ' . $ticketData['ticket_number'] . ' ' . 'با موفقیت ارسال شد');
            } else {
                return redirect()->back()->with('failed', 'متاسفانه خطایی در ارسال تیکت به وجود آمد لطفا مجدد تلاش کنید');
            }
        }
        
    }

    public function tickets(Request $request){
        if ($request->ajax()){
            $tickets = Tickets::orderByDesc("id")->where('user_id', auth()->user()->id);
            return DataTables::of($tickets)
                ->editColumn('created_at', function ($tickets){
                    return Jalalian::forge($tickets->created_at)->format("Y-m-d H:i:s");
                })
                ->addColumn("actions", function ($tickets){
                    return '<a href="' . route('panel.tickets.show' , ['ticket' => $tickets->id]) .'">
                                <button type="button" class="btn btn-icon btn-danger">
                                نمایش 
                                </button>
                            </a>';
                })
                ->rawColumns(['actions','thumbnail'])
                ->make(true);
        }
        return view('Panel.tickets');
    }

    public function showTicket(Tickets $ticket){
        $ticket = $ticket->with('replies', 'user','announcements')->where('id', $ticket->id)->first();
        $announcementsDelete = $ticket->announcements()->delete();
        return view('Panel.showTicket',compact('ticket'));
    }

    public function comments(Request $request){
        $comments = Comments::where('user_id', auth()->user()->id)->with('commentable')->get();
        if ($request->ajax()){
            return DataTables::of($comments)
                ->editColumn('created_at', function ($comments){
                    return Jalalian::forge($comments->created_at)->format("Y-m-d H:i:s");
                })
                ->editColumn('text', function ($comments){
                    return Str::limit($comments->text, 60);
                })
                ->editColumn('commentable_type', function ($comments){
                    return $comments->commentable?->getCommentLink();
                })
                ->rawColumns(['commentable_type'])
                ->make(true);
        }
        return view('Panel.comments');
    }
    public function likedMovies(Request $request){
        $user = auth()->user();
        if ($request->ajax()){
            $likedMovies = $user->movieLiked()->select('movies.id', 'movies.title', 'movies.slug', 'movies.imdb')->withCount([
                'reactions as likes_count' => function ($query) {
                    $query->where('reaction', 1);
                },
                'reactions as dislikes_count' => function ($query) {
                    $query->where('reaction', -1);
                }
            ])->orderByDesc('movies.updated_at');
            return DataTables::of($likedMovies)
                ->editColumn('likes', function ($likedMovies){
                    return $likedMovies->likes_count;
                })
                ->editColumn('dislikes', function ($likedMovies){
                    return $likedMovies->dislikes_count;
                })
                ->editColumn('title', function ($likedMovies){
                    return "<a href='". route('index.movie', ['slug' => $likedMovies->slug]) ."'>" . Str::limit($likedMovies->title[0], 40) . "</a>";
                })
                ->editColumn('imdb', function ($likedMovies){
                    return $likedMovies->imdb;
                })
                ->rawColumns(['title'])
            ->make(true);
        }
        return view('Panel.likedMovies');
    }

    public function watched(Request $request){
        $user = auth()->user();
        if ($request->ajax()){
            $watchedMovies = $user->watched()->select('movies.id', 'movies.title', 'movies.time', 'movies.slug')->with('genres')->orderByPivot('watched_at', 'desc');
            return DataTables::of($watchedMovies)
                ->editColumn('title', function ($watchedMovies){
                    return "<a href='". route('index.movie', ['slug' => $watchedMovies->slug]) ."'>" . Str::limit($watchedMovies->title[0], 40) . "</a>";
                })
                ->editColumn('genres', function ($watchedMovies){
                    $genreText = "";
                    foreach($watchedMovies->genres as $genre){
                        $genreText .= $genre->title . ", ";
                    }
                    return $genreText;
                })
                ->editColumn('time', function ($likedMovies){
                    return $likedMovies->getFormattedDurationAttribute();
                })
                ->rawColumns(['title'])
            ->make(true);
        }
        return view('Panel.watched');
    }

    public function account(){
        $user = auth()->user();
        return view('Panel.account', compact('user'));
    }

    public function accountUpdate(Request $request){
        $request->validate([
            'name' => ['required', 'string'],
            'family' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'numeric'],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);
        $user = auth()->user();
        $userData = $request->except('_token');
        if ($request->password == null){
            unset($userData['password']);
        }
        $updateUser = $user->update($userData);
        if($updateUser){
            return redirect()->back()->with('success', 'اطلاعات شما با موفقیت ویرایش شد.');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه خطایی در ویرایش اطلاعات به وجود آمد');
        }
    }

    public function avatarUpload(Request $request){
        try{
            $request->validate([
                'avatar' => ['required', 'image', 'mimes:jpg,png,webp']
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
        $user = auth()->user();
        if ($user->avatar != null) {
            try{
                unlink(public_path('users/' . $user->avatar));
            } catch (Exception $e){
                return response()->json([$e->getMessage()]);
            }
        }
        $image = $request->file('avatar');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move('users/', $imageName);
        $userData = ['avatar' => $imageName];
        $uploadAvatar = $user->update($userData);
        if ($uploadAvatar){
            return response()->json([
                'message' => 'آواتار با موفقیت آپلود شد',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'متاسفانه خطایی در آپلود آواتار به وجود آمد',
                'code' => 503
            ]);
        }
    }
}
