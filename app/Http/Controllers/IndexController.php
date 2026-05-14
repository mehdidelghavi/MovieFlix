<?php

namespace App\Http\Controllers;

use App\Events\UserPurchase;
use App\Events\UserReaction;
use App\Models\CommentReactions;
use App\Models\Comments;
use App\Models\Episodes;
use App\Models\Genres;
use App\Models\MovieList;
use App\Models\MovieReaction;
use App\Models\Movies;
use App\Models\Newsletters;
use App\Models\Payments;
use App\Models\Plans;
use App\Models\Qualities;
use App\Models\Requirements;
use App\Models\Subescriptions;
use App\Models\Tickets;
use App\Models\Users;
use App\Models\WatchHistory;
use App\Services\SeoService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class IndexController extends Controller
{
    public function index(Request $request){
        $updatedSeries = Movies::select('id', 'title', 'slug', 'type', 'director', 'imdb', 'thumbnail', 'creation_year', 'country', 'about')->whereIn("type", ['series', 'anime'])->where("updated_at", ">=", Carbon::now()->addWeeks(-1))->whereHas('episodes', function ($query){
            $query->where("updated_at", ">=", Carbon::now()->addWeeks(-1));
        })->get();
        $indexMovies = Movies::select('id', 'title', 'slug', 'thumbnail', 'updated_at', 'director', 'story', 'creation_year', 'country')->orderByDesc('updated_at')->paginate(10);
        $suggestedMovies = Movies::select('id', 'title', 'slug', 'imdb', 'thumbnail')->whereHas('lists', function ($query){
            $query->where('slug', "فیلم-های-پیشنهادی");
        })->take(12)->get();
        $releasedMovies = Movies::select('title', 'slug', 'thumbnail', 'updated_at', 'created_at', 'release_date')->whereNotExists(function ($query){
            $query->select(DB::raw(1))->from('episodes')->whereColumn('episodes.movie_id', 'movies.id');
        })->where('release_date', ">=", Carbon::now())->get();
        SeoService::set(
            "صفحه اصلی",
            "دانلود و تماشای رایگان فیلم و سریال"
        );
        return view('index', compact('indexMovies', 'updatedSeries', 'suggestedMovies', 'releasedMovies'));
    }

    public function movie($slug){
        if (Auth::check()){
            $movie = Movies::where('slug', $slug)->with(['genres', 'comments' => function ($query){
                $query->where('verified', 1);
            }])->withCount([
                        'reactions as likes_count' => function ($query) {
                            $query->where('reaction', 1);
                        },
                        'reactions as dislikes_count' => function ($query) {
                            $query->where('reaction', -1);
                        }
                    ])
                    ->addSelect([
                        'user_reaction' => DB::table('movie_reactions')
                            ->select('reaction')
                            ->whereColumn('movie_id', 'movies.id')
                            ->where('user_id', auth()->user()->id)
                            ->limit(1)
                    ])
                    ->firstOrFail();
                    $comments = $movie->comments()->with(['replies' => function ($query){
                        $query->orderByDesc('updated_at')->where('verified', 1);
                    }])->where('verified', 1)->withCount([
                        'reactions as likes_count' => function ($query) {
                            $query->where('reaction', 1);
                        },
                        'reactions as dislikes_count' => function ($query) {
                            $query->where('reaction', -1);
                        }
                    ])
                    ->addSelect([
                        'user_reaction' => DB::table('comment_reactions')
                            ->select('reaction')
                            ->whereColumn('comment_id', 'comments.id')
                            ->where('user_id', auth()->user()->id)
                            ->limit(1)
                    ])->paginate(20);
        } else {
            $movie = Movies::where('slug', $slug)->with(['genres', 'comments' => function ($query){
                $query->where('verified', 1);
            }])->withCount([
                        'reactions as likes_count' => function ($query) {
                            $query->where('reaction', 1);
                        },
                        'reactions as dislikes_count' => function ($query) {
                            $query->where('reaction', -1);
                        }
                    ])
                    ->firstOrFail();
                    $comments = $movie->comments()->with(['replies' => function ($query){
                        $query->orderByDesc('updated_at')->where('verified', 1);
                    }])->where('verified', 1)->withCount([
                        'reactions as likes_count' => function ($query) {
                            $query->where('reaction', 1);
                        },
                        'reactions as dislikes_count' => function ($query) {
                            $query->where('reaction', -1);
                        }
                    ])->paginate(20);
        }
        $total = $movie->likes_count + $movie->dislikes_count;
        if ($total > 0) {
            $movie->satisfaction = round(($movie->likes_count / $total) * 100);
        } else {
            $movie->satisfaction = 0;
        }
        $moviePath = "storage/movies/" . str_replace(" ", "", $movie->title[1]) . "/"; 
        SeoService::set(
            $movie->title[0],
            Str::limit($movie->about, 50),
            asset($moviePath . 'thumbnail/' .$movie->thumbnail),
        );
        $relatedMovies = Movies::select('id', 'title', 'slug', 'thumbnail')->whereHas('genres', function ($query) use ($movie){
            $query->whereIn('genres.id', $movie->genres->pluck('id'));
        })->where('id', '!=', $movie->id)->limit(30)->get();
        return view('movie', compact('movie', 'relatedMovies', 'comments'));
    }

    public function download($slug, Qualities $quality){
        $movie = Movies::where("slug", $slug)->firstOrFail();
        $filename = $quality->url;
        $season = null;
        $episode = $quality->episode;
        if (auth()->check()){
            $user = auth()->user();
            if ($user->hasActiveSub()){
                if (filter_var($filename, FILTER_VALIDATE_URL)){
                    return redirect()->away($filename);
                }
                if ($movie->type == "movie"){
                    $path = '/movies/' . str_replace(" ","", $movie->title[1]) . '/' .$filename ;
                } else {
                    $season = $episode->season;
                    $path = '/movies/' . str_replace(" ","", $movie->title[1]) . "/seasons/" . $season->number . "/" . $filename;
                }
                if (!Storage::disk('local')->exists($path)) {
                    return abort(404);
                }
                return Storage::disk('local')->download($path);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function search(Request $request){
        $indexMovies = Movies::query()->select('id', 'title', 'slug', 'thumbnail', 'updated_at', 'director', 'story', 'creation_year', 'country');
        if ($request->filled('search')){
            $indexMovies = $indexMovies->whereRaw(
                "JSON_UNQUOTE(JSON_EXTRACT(title, '$[0]')) LIKE ?",
                ["%{$request->search}%"]
            )->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(title, '$[1]')) LIKE ?",
                ["%{$request->search}%"]
            );
        }
        if ($request->filled('cat-j')){
            $indexMovies = $indexMovies->whereHas('genres', function ($q) use ($request){
                $q->whereIn('genres.title', $request->input(key: 'cat-j'));
            });
        }
        if ($request->filled('cat-scores')){
            if ($request->input('cat-scores') == "۰ تا ۲"){
                $indexMovies = $indexMovies->where('imdb', ">=" , 0)->where("imdb", "<=", 2);
            }
            if ($request->input('cat-scores') == "۲ تا ۵"){
                $indexMovies = $indexMovies->where('imdb', ">=" , 2)->where("imdb", "<=", 5);
            }
            if ($request->input('cat-scores') == "۵ تا ۷"){
                $indexMovies = $indexMovies->where('imdb', ">=" , 5)->where("imdb", "<=", 7);
            }
            if ($request->input('cat-scores') == "بالای ۷"){
                $indexMovies = $indexMovies->where('imdb', ">" , 7);
            }
        }
        if ($request->filled('cat-country')){
            $indexMovies = $indexMovies->where('country', $request->input('cat-country'));
        }
        if ($request->filled('cat-age')){
            if ($request->input('cat-age') == "نیاز به نظارت والدین"){
                $indexMovies = $indexMovies->where('age', 'نیاز به نظارت والدین');
            } elseif($request->input('cat-age') == 12){
                $indexMovies = $indexMovies->where('age', '>=','12');
            } elseif($request->input('cat-age') == 16){
                $indexMovies = $indexMovies->where('age', ">=",'16');
            } elseif($request->input('cat-age') == "فقط بزرگسالان"){
                $indexMovies = $indexMovies->where('age', ">=",'18');
            }
        }
        if ($request->filled('cat-ofyear')){
            $indexMovies = $indexMovies->where('creation_year', ">=",$request->input('cat-ofyear'));
        }
        if ($request->filled('cat-unyear')){
            $indexMovies = $indexMovies->where('creation_year', "<=",$request->input('cat-unyear'));
        }
        if ($request->filled('cat-n')){
            if ($request->input('cat-n') == "جدیدترین"){
                $indexMovies = $indexMovies->orderByDesc('created_at');
            } elseif($request->input('cat-n') == "قدیمی"){
                $indexMovies = $indexMovies->orderBy('created_at', 'asc');
            } else {
                $indexMovies = $indexMovies->orderByDesc('imdb');
            }
        }
        if ($request->filled('cat-ds')){
            if ($request->input('cat-ds') == "دوبله شده"){
                $indexMovies = $indexMovies->whereHas("episode", function ($query){
                    $query->where("has_persian_dub", 1);
                });
            }
        }
        $indexMovies = $indexMovies->paginate(20);
        $updatedSeries = Movies::select('id', 'title', 'slug', 'type', 'director', 'imdb', 'thumbnail', 'creation_year', 'country', 'about')->whereIn("type", ['series', 'anime'])->where("updated_at", ">=", Carbon::now()->addWeek(-1))->whereHas('episodes')->get();
        SeoService::set(
            "جستجو",
            "جستجو فیلم و سریال"
        );
        return view('search', compact('indexMovies', 'updatedSeries'));
    }

    public function category($category, $category_value = null){
        $indexMovies = Movies::query()->select('id', 'title', 'slug', 'thumbnail', 'updated_at', 'director', 'story', 'creation_year', 'country');
        if ($category == "genre_movies"){
            $indexMovies = $indexMovies->whereHas('genres', function ($q) use ($category_value){
                $q->where('genres.title', $category_value);
            });
        } elseif ($category == "irani"){
            $indexMovies = $indexMovies->where('country', 'ایران')->where('type', 'movie');
        } elseif ($category == "movies"){
            $indexMovies = $indexMovies->where('type', 'movie');
        } elseif ($category == "series"){
            $indexMovies = $indexMovies->where('type', 'series');
            if ($category_value != null){
                if ($category_value == "ایرانی"){
                    $indexMovies = $indexMovies->where('country', 'ایران');
                } elseif($category_value == "خارجی"){
                    $indexMovies = $indexMovies->where('country', '!=', 'ایران');
                } elseif($category_value == "ترکی"){
                    $indexMovies = $indexMovies->where('country', 'ترکیه');
                } elseif($category_value == "کره ای"){
                    $indexMovies = $indexMovies->where('country', 'کره جنوبی');
                }
            }
        } elseif ($category == "animation"){
            $indexMovies = $indexMovies->where('type', 'animation');
        } elseif ($category == "anime"){
            $indexMovies = $indexMovies->where('type', 'anime');
        } elseif ($category == "actor"){
            $indexMovies = $indexMovies->whereHas('actors', function ($q) use ($category_value){
                $q->where('actors.name', $category_value);
            });
        } elseif($category == "director") {
            $indexMovies = $indexMovies->whereJsonContains("director", $category_value);
        } else {
            $list = MovieList::where('slug', $category)->firstOrFail();
            $indexMovies = $list->movies();
        }
        $indexMovies = $indexMovies->paginate(20);
        $updatedSeries = Movies::select('id', 'title', 'slug', 'type', 'director', 'imdb', 'thumbnail', 'creation_year', 'country', 'about')->whereIn("type", ['series', 'anime'])->where("updated_at", ">=", Carbon::now()->addWeek(-1))->whereHas('episodes')->get();
        SeoService::set(
            $category_value ?? $category,
            "جستجو بر اساس دسته بندی فیلم و سریال"
        );
        return view('category', compact('indexMovies', 'updatedSeries'));
    }

    public function plans(){
        $plans = Plans::orderBy('price', 'asc')->get();
        SeoService::set(
            "خرید اشتراک",
            "صفحه خرید اشتراک و انتخاب تعرفه"
        );
        return view('plans', compact('plans'));
    }

    public function checkout(Plans $plan){
        if (auth()->check()){
            SeoService::set(
                "سبد خرید",
                "صفحه خرید اشتراک و انتخاب تعرفه"
            );
            return view('checkout', compact('plan'));
        } else {
            return redirect()->route('panel.login');
        }
    }

    public function checkoutSubmit(Request $request,Plans $plan){
        $request->validate([
            'paymentMethod' => ['required']
        ]);
        $driverSelected = $request->paymentMethod;
        $transactionId = random_int(100000000, 999999999);
        $invoice = new Invoice;
        $invoice->amount($plan->price);
        $invoice->detail(['user_id' => auth()->user()->id])->detail(['plan_id' => $plan->id])->detail(['transaction_id' => $transactionId]);
        $invoice->uuid($transactionId);
        $planSelected = Plans::where('id', $plan->id)->firstOrFail();
        $createPayment = Payments::create([
            'plan_id' => $plan->id,
            'payment_number' => $transactionId,
            'user_id' => auth()->user()->id,
            'status' => 0,
            'message' => 'متاسفانه به درگاه پرداخت متصل نشد',
        ]);
        return Payment::via($driverSelected)->callbackUrl(route('index.checkout.callback', ['plan' => $planSelected->id, 'transaction_id' => $transactionId]))->purchase($invoice, function($driver, $gatewayTransactionId) use($createPayment, $driverSelected) {
                $createPayment->update([
                    'status' => 1,
                    'gateway' => $driverSelected,
                    'terminal_number' => $gatewayTransactionId,
                    'message' => 'به درگاه پرداخت متصل شد'
                ]);
            }
        )->pay()->render();
    }
    public function callback(Request $request,Plans $plan, $transaction_id){
        $plans = Plans::orderBy('price', 'asc')->get();
        $exception = new InvalidPaymentException();
        $payment = Payments::where('payment_number', $transaction_id)->firstOrFail();
        try {
            $receipt = Payment::amount($plan->price)->transactionId($payment->terminal_number)->verify();
            $duration = $plan->duration; 
            $createSub = Subescriptions::create([
                'user_id' => auth()->user()->id,
                'plan_id' => $plan->id,
                'expireDate' => Carbon::now()->addDays((int) $duration),
            ]); 
            $payment->update([
                'status' => 2,
                'subescription_id' => $createSub->id,
                'message' => 'پرداخت با موفیت انجام شد',
            ]);
            event(new UserPurchase(auth()->user(), $payment, $plan));
            SeoService::set(
                "خرید اشتراک",
                "صفحه خرید اشتراک و انتخاب تعرفه"
            );
            return view('plans', compact('plans', 'plan'))->with('success', 'پرداخت با موفقیت انجام شد');
        } catch (InvalidPaymentException $exception) {
            $payment->update([
                'status' => 3,
                'message' => 'متاسفانه پرداخت انجام نشد',
            ]);
            return view('plans', compact('plans', 'plan', 'exception'))->with("failed", $exception->getMessage());
        }
    }

    public function likes(Request $request,$slug){
        $request->validate([
            'reaction' => ['required']
        ]);
        $data = $request->except('_token');
        $movie = Movies::select('id', 'slug', 'title')->where('slug', $slug)->firstOrFail();
        if (!Auth::check()){
            return response()->json([
                'message' => 'برای ثبت ری اکشن باید وارد حساب کاربری خود بشوید',
                'code' => '403'
            ]);
        }
        $user = Auth::user()->id;
        $reactionValue = (int) $data['reaction'];

        // پیدا کردن رأی قبلی کاربر
        $existingReaction = MovieReaction::where('user_id', $user)
            ->where('movie_id', $movie->id)
            ->first();

        if ($existingReaction) {

            // اگر همان رأی را دوباره زد → حذف (toggle off)
            if ($existingReaction->reaction === $reactionValue) {
                $existingReaction->delete();
                $status = 'removed';
            } 
            // اگر رأی متفاوت بود → آپدیت شود
            else {
                $existingReaction->update([
                    'reaction' => $reactionValue
                ]);
                $status = 'updated';
                event(new UserReaction(auth()->user(), $reactionValue, $movie->title[1]));
            }

        } else {
            // اگر قبلاً رأی نداده بود → ایجاد شود
            MovieReaction::create([
                'user_id' => $user,
                'movie_id' => $movie->id,
                'reaction' => $reactionValue
            ]);

            $status = 'created';
            event(new UserReaction(auth()->user(), $reactionValue, $movie->title[1]));
        }

        // گرفتن تعداد جدید
        $likes = MovieReaction::where('movie_id', $movie->id)
            ->where('reaction', 1)
            ->count();

        $dislikes = MovieReaction::where('movie_id', $movie->id)
            ->where('reaction', -1)
            ->count();

        return response()->json([
            'status' => $status,
            'likes' => $likes,
            'dislikes' => $dislikes,
            'code' => 200
        ]);
    }

    public function watch($slug, Episodes $episode){
        $movie = Movies::where('slug', $slug)->firstOrFail();
        $updateOrCreate = WatchHistory::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'episode_id' => $episode->id,
                'movie_id' => $movie->id
            ],
            [
                'watched_at' => Carbon::now()
            ]
        );
        $watchHistory = WatchHistory::where('user_id', auth()->id())
            ->where('episode_id', $episode->id)
            ->first();

        $progress = $watchHistory ? $watchHistory->progress : 0;
        $quality = $episode->qualities()->where('quality', '=', '1080')->firstOrFail();
        $season = $episode->season;
        $moviePath = "storage/movies/" . str_replace(" ", "", $movie->title[1]) . "/"; 
        SeoService::set(
            $movie->title[0],
            Str::limit($movie->about, 50),
            asset($moviePath . 'thumbnail/' .$movie->thumbnail),
        );
        return view('watch', compact('movie', 'quality', 'season', 'episode', 'progress'));
    }

    public function watchProgress(Request $request){
        $request->validate([
            'episode_id' => ['required', 'numeric'],
            'progress' => ['required', 'numeric']
        ]);
        $watchHistory = WatchHistory::where('episode_id', '=', $request->episode_id)->firstOrFail();
        $watchHistory->update(['progress' => $request->progress]);
        return response()->json(["Progress Updated"]);
    }

    public function stream(Request $request){
        $path = $request->path;
        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }
        return Storage::disk('local')->response($path);
    }

    public function contactus(){
        return view('contactus');
    }

    public function contactusSend(Request $request){
        $request->validate([
            'email' => ['required' ,'email'],
            'text' => ['required']
        ]);
        $ticketData = $request->except('_token', 'name');
        $ticketData['subject'] = "تماس با ما";
        $ticketData['departman'] = "contact-departman";
        $ticketData['ticket_number'] = random_int(10000000,99999999);
        $ticketData['status'] = "در انتظار پاسخ";
        $ticketCreate = Tickets::create($ticketData);
        if ($ticketCreate){
            return redirect()->back()->with("success", "پیام شما با موفقیت ارسال شد، جواب آن به زودی به شما ایمیل میشود");
        } else {
            return redirect()->back()->with("failed", "خطایی رخ داد مجدد امتحان کنید");
        }
    }

    public function requirements($slug){
        $requirement = Requirements::where('slug', $slug)->with('files')->firstOrFail();
        $requirements = Requirements::orderByDesc('id')->where('id' , '!=', $requirement->id)->limit(3)->get();
        return view('requirement', compact('requirement'));
    }

    public function newsletter(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:newsletter,email']
        ]);
        if ($validator->fails()){
            return response()->json([
                'email' => $request->email,
                'message' => $validator->errors()->first('email'),
                'code' => 422
            ],422);
        }
        $data = $request->only('email');
        $createSubscriber = Newsletters::create($data);
        if ($createSubscriber){
            return response()->json([
                'email' => $request->email,
                'message' => 'با موفقیت به خبرنامه اضافه شدید',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'email' => $request->email,
                'message' => 'متاسفانه خطایی رخ داد مجدد امتحان کنید',
                'code' => 503
            ]);
        }
        
    }

    public function cmLikes(Request $request, $slug){
        $request->validate([
            'reaction' => ['required']
        ]);
        $data = $request->except('_token');
        if (!Auth::check()){
            return response()->json([
                'message' => 'برای ثبت ری اکشن باید وارد حساب کاربری خود بشوید',
                'code' => '403'
            ]);
        }
        $user = Auth::user()->id;
        $reactionValue = (int) $data['reaction'];

        // پیدا کردن رأی قبلی کاربر
        $existingReaction = CommentReactions::where('user_id', $user)
            ->where('comment_id', $data['commentId'])
            ->first();

        if ($existingReaction) {

            // اگر همان رأی را دوباره زد → حذف (toggle off)
            if ($existingReaction->reaction === $reactionValue) {
                $existingReaction->delete();
                $status = 'removed';
            } 
            // اگر رأی متفاوت بود → آپدیت شود
            else {
                $existingReaction->update([
                    'reaction' => $reactionValue
                ]);
                $status = 'updated';
                // event(new UserReaction(auth()->user(), $reactionValue, $movie->title[1]));
            }

        } else {
            // اگر قبلاً رأی نداده بود → ایجاد شود
            CommentReactions::create([
                'user_id' => $user,
                'comment_id' => $data['commentId'],
                'reaction' => $reactionValue
            ]);

            $status = 'created';
            // event(new UserReaction(auth()->user(), $reactionValue, $movie->title[1]));
        }

        // گرفتن تعداد جدید
        $likes = CommentReactions::where('comment_id', $data['commentId'])
            ->where('reaction', 1)
            ->count();

        $dislikes = CommentReactions::where('comment_id', $data['commentId'])
            ->where('reaction', -1)
            ->count();

        return response()->json([
            'status' => $status,
            'likes' => $likes,
            'dislikes' => $dislikes,
            'code' => 200
        ]);
    }
}
