@extends('master')
@section('metaHeader')
<meta name="likeRoute" content="{{ route('index.likes', ['slug' => $movie->slug]) }}">
<meta name="cmLikeRoute" content="{{ route('index.cm.likes', ['slug' => $movie->slug]) }}">
@endsection
@section('content')
 <!-- post header -->
    <!-- ----------- -->
    <section class="post__header relative">
        <div class="post__header__cover absolute"></div>
        <div class="post__header__bg absolute"></div>
        <!-- Post container -->
        @php
            $moviePath = "storage/movies/" . str_replace(" ", "", $movie->title[1]) . "/"; 
        @endphp
        <article class="main-post container row">
            <div class="post-img-container">
                <a href="{{ route('index.movie', ['slug' => $movie->slug]) }}" title="{{ $movie->title[0] }}">
                    <img loading="lazy" class="article-img" src="{{ asset($moviePath . 'thumbnail/' .$movie->thumbnail) }}"
                        alt="{{ $movie->title[0] }}">
                </a>
            </div>
            <div class="post-info">
                <div class="post-title-container">
                    <h1 class="post-info-title">
                        <a class="post-info-link" href="{{ route('index.movie', ['slug' => $movie->slug]) }}" title="{{ $movie->title[0] }}">
                            {{ $movie->title[0] }}
                        </a>
                    </h1>
                </div>
                <div class="post-meta">
                    <div>
                        <span class="post-meta-tags"><i class="fa fa-tag"></i> 
                        @foreach ($movie->genres as $genre)
                            <a href="{{ route('index.category', ['category' => 'genre_movies', 'category_value' => $genre->title]) }}">{{ $genre->title }}</a>
                        @endforeach
                        </span>
                        <span class="tag__line">|</span>
                        <!--  -->
                        <span class="movie__year">{{ $movie->creation_year }}</span>
                        <span class="tag__line">|</span>
                        <!--  -->
                        <span class="post__year">بالای {{ $movie->age }} سال</span>
                        <span class="tag__line">|</span>
                        <!--  -->
                        <span class="post__time">{{ $movie->time }} دقیقه</span>
                        <span class="tag__line">|</span>
                        <span class="post__country">{{ $movie->country }}</span>
                    </div>
                </div>

                <div class="director__likes">
                    <div class="likes">
                        <div class="like__cr">
                            <i class="fa fa-heart"></i>
                        </div>
                        <p> <span>{{ $movie->satisfaction }}%</span> رضایت</p>
                    </div>

                    <div class="actors-director-container">
                        <div class="actors">
                            <span class="actors-title">بازیگران </span>
                            @foreach ($movie->actors as $actor)
                                <a href="{{ route('index.category', ['category' => 'actor', 'category_value' => $actor->name]) }}">{{ $actor->name }}</a>
                            @endforeach
                        </div>
                        <div class="director">
                            <span class="actors-title">کارگردان </span>
                            @php
                                $director = $movie->director;
                                $i = 0;
                            @endphp
                            @for ($i = 0;$i < count($director);$i++)
                                <a href="{{ route('index.category', ['category' => 'director', 'category_value' => $director[$i]]) }}">@if($i != 0) , @endif{{ $director[$i] }}</a>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="like__dislike__section">
                    <div class="like__cr">
                        <p id="like__btn" @if ($movie->user_reaction != null && $movie->user_reaction == 1) class="liked" @endif><span id="likes">{{ $movie->likes_count }}</span> <i class="like__icon fa fa-thumbs-up"></i></p>
                        <p id="dislike__btn" @if ($movie->user_reaction != null && $movie->user_reaction == -1) class="disliked" @endif><span id="dislikes">{{ $movie->dislikes_count }}</span> <i class="dislike__icon fa fa-thumbs-down"></i>
                        </p>
                    </div>

                    <div class="likes mob__likes">
                        <div class="like__cr">
                            <i class="fa fa-heart"></i>
                        </div>
                        <p class="post__page__likes"> <span>{{ $movie->satisfaction }}%</span> رضایت</p>
                    </div>
                </div>

            </div>
        </article>
        <!-- Post container end -->
    </section>
    <!-- post header end -->
    <!-- --------------- -->

    <!-- post video inforamtion start -->
    <section class="post__video__info container">
        <div class="video__container">
            <video src="{{ asset($moviePath . 'trailer/' .$movie->trailer) }}" preload="auto" controls
                poster="{{ asset($moviePath . 'thumbnail/' .$movie->thumbnail) }}">
                <source src="{{ asset($moviePath . 'trailer/' .$movie->trailer) }}" type="video/mp4">
            </video>
        </div>
        <div class="movie__info__cr">
            <div class="movie__story">
                <h4 class="movie__story__title"> <i class="fas fa-film"></i> داستان سریال </h4>
                <p>
                    {{ $movie->story }}
                </p>
            </div>

            <div class="movie__info">
                <h4 class="movie__story__title"> <i class="fas fa-film"></i> درباره سریال </h4>
                <p>
                    {{ $movie->about }}
                </p>
            </div>
        </div>
    </section>
    <!-- post video inforamtion end -->

    <!-- horzontal line for post page -->
    <div class="video__horzontal__line container"></div>
    <!-- contant us tell cr -->
    <div class="contant__us__tel container">
        <p>
            <i class="fa fa-phone-volume"></i> شماره پشتیبانی ۰۹۰۴۵۹۸۹۶۸۹
            <a href="#">پشتیبانی تلگرام</a> <a href="#">راهنما</a>
        </p>
    </div>
    <!-- download nim baha text -->

    <!-- sell serials cr -->
            @if ($movie->type == "series" || $movie->type == "anime")
                @php
                    $seasons = $movie->seasons;
                @endphp
                @if ($movie->seasons()->exists())
                <div class="download__star container">
                    <p><i class="fa fa-star"></i> دانلود شما داخلی و نیم بها محاسبه میشود</p>
                </div>
                    <div class="sell__serials__container container">
                        <div class="sell__serials relative">
                            <h4 class="serials__title"> فصل ها</h4>
                            <button class="scrollTo absolute"><i class="fa fa-angle-right"></i></button>
                            <button class="scrollBack absolute"><i class="fa fa-angle-left"></i></button>
                            <div class="serial__or__film__btns">
                                <ul class="buttons__cr row">
                                    @foreach ($seasons as $season)
                                        @if($loop->first)
                                            <a id="defOpen" class="active__serial__page" onclick="seasons('season{{ $season->number }}' , this)"
                                            href="javascript:void(0)">{{ $season->name }}</a>
                                            @else
                                            <a onclick="seasons('season{{ $season->number }}' , this)"
                                            href="javascript:void(0)">{{ $season->name }}</a>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                            <div class="serials____cr">
                                <!-- seasons 1-->
                                @foreach ($seasons as $season)
                                    <div id="season{{ $season->number }}" class="sell__serials__download__section season Serials__dw__animation" @if ($loop->first)style="display: block;"@endif>
                                        @foreach($season->episodes as $episode)
                                            @php
                                                $has1080 = $episode->qualities()
                                                    ->where('quality', 1080)
                                                    ->exists();
                                            @endphp 
                                            <div class="sell__serial__inner">
                                                    <div class="sell__serial__info">
                                                        <span class="film__quality">{{ $episode->title }}</span>
                                                        @if ($episode->has_persian_subtitle)
                                                            <span class="subtitle__tag badge">زیرنویس چسبیده</span>
                                                        @endif
                                                        @if ($episode->has_persian_dub)
                                                            <span class="subtitle__tag badge">دوبله فارسی</span>
                                                        @endif
                                                    </div>

                                                    <div class="download__serial__btn">    
                                                        @foreach($episode->qualities as $quality)
                                                            <a href="{{ route("index.movie.download", ['slug' => $movie->slug, 'quality' => $quality->id]) }}" target="_blank"><i class="fa fa-download"></i> دانلود {{ $quality->quality }} </a>
                                                        @endforeach
                                                        @if ($has1080)
                                                            <a class="play__online" href="{{ route('index.movie.watch', ['slug' => $movie->slug, 'episode' => $episode->id]) }}" target="_blank">
                                                                <span>پخش آنلاین </span>
                                                                <span class="fa fa-play"></span>
                                                            </a>
                                                        @endif
                                                    </div>

                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    @else
                    <div class="contant__us__tel container">
                            <p>
                                تاریخ انتشار {{ \Morilog\Jalali\Jalalian::forge($movie->release_date)->format("Y/m/d H:i:s") }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                @else
                <div class="sell__serials__container container">
                <div class="download__star container">
                    <p><i class="fa fa-star"></i> دانلود شما داخلی و نیم بها محاسبه میشود</p>
                </div>
                    <div class="sell__serials relative">

                    <div class="serials____cr">
                        <!-- seasons 1-->
                        <div id="season1" class="sell__serials__download__section season Serials__dw__animation" style="display: block;">
                            @foreach($movie->episodes as $episode)
                                @php
                                    $has1080 = $episode->qualities()
                                        ->where('quality', 1080)
                                        ->exists();
                                @endphp 
                                <div class="sell__serial__inner">
                                        <div class="sell__serial__info">
                                            <span class="film__quality">{{ $episode->title }}</span>
                                            @if ($episode->has_persian_subtitle)
                                                <span class="subtitle__tag badge">زیرنویس چسبیده</span>
                                            @endif
                                            @if ($episode->has_persian_dub)
                                                <span class="subtitle__tag badge">دوبله فارسی</span>
                                            @endif
                                        </div>

                                        <div class="download__serial__btn">
                                            @foreach($episode->qualities as $quality)
                                                <a href="{{ route("index.movie.download", ['slug' => $movie->slug, 'quality' => $quality->id]) }}" target="_blank"><i class="fa fa-download"></i> دانلود {{ $quality->quality }} </a>
                                            @endforeach
                                            @if ($has1080)
                                                <a class="play__online" href="{{ route('index.movie.watch', ['slug' => $movie->slug, 'episode' => $episode->id]) }}" target="_blank">
                                                    <span>پخش آنلاین </span>
                                                    <span class="fa fa-play"></span>
                                                </a>
                                            @endif
                                        </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                    </div>
                    </div>
            @endif

    <!-- related posts -->
    <div id="index-post-relatedes" class="post__relatedes__cr container">
        <section class="post__related">

            <h1>
                @if ($movie->type == "movie")
                    فیلم های
                    @elseif($movie->type == "series")
                    سریال های
                    @elseif($movie->type == "anime")
                    انیمه های 
                    @else
                    انیمیشن های
                @endif
                مشابه
            </h1>

            <div class="post__related__cr row">

                @foreach($relatedMovies as $rMovies)
                    <div class="post__relatedes__container">
                        <a class="related__post__link" href="{{ route('index.movie', ['slug' => $rMovies->slug]) }}">
                            <div class="related__img__cr">
                                <img loading="lazy" src="{{ env('APP_URL') . "storage/movies/" . str_replace(" " ,"", $rMovies->title[1]) . "/thumbnail/" . $rMovies->thumbnail }}"
                                    alt="{{ $rMovies->title[0] }}">
                            </div>
                            <h4 class="related__title">{{ Str::limit($rMovies->title[0], 20) }}</h4>
                            <p><i class="fa fa-heart"></i> ۷۵% رضایت</p>
                        </a>
                    </div>
                @endforeach
            </div>

        </section>
    </div>

    <!-- comments section -->
    <div class="comments__container__class container">
        <!-- post comments container and form -->
        <div class="comments__inner__cr">
            <div class="cm__title__btn">
                <h1 id="comments__length" class="comments__length"><i class="fas fa-comment-dots"></i> {{ count($movie->comments) }} دیدگاه</h1>
                <button class="add__comment__btn green-badge " id="addComment"><i class="fa fa-plus"></i> <span>افزودن
                        دیدگاه</span></button>
            </div>

            <!-- post comment section -->
            <form id="post__cm__form" action="{{ route('blog.article.sendcomment', ['type' => 'movie','id' => $movie->id]) }}" method="POST" class="comment__below__form">
                @csrf
                <!-- post comment animation after submit -->
                <div class="PostComment__Animation">
                    <div class="loader-parent postcm__animation">
                        <div class="loader-bg">
                            <div class="mid-circle"></div>
                            <div class="loader-circle-2"></div>
                            <div class="loader-circle-2"></div>
                            <div class="loader-circle-2"></div>
                            <div class="loader-circle-2"></div>
                        </div>
                    </div>
                </div>

                <label class="add__comment__label" for="add-comment-input">دیدگاهتان را بنویسید</label>
                <div class="replyBox">
                    <div class="replyUser">
                        <i class="fa fa-reply"></i>
                        <span id="replyUserInfo"></span>
                    </div>
                    <div class="replyRemove">
                        <i class="fa fa-close"></i>
                    </div>
                </div>
                <input type="text" name="comment_id" value="0" id="reply" hidden>
                <div class="comment__form__control">
                    <textarea spellcheck="false" class="add_cm__input" name="text" id="add-comment-input"
                        cols="30" rows="3" placeholder="این فیلم چه طور بود؟" required="required"></textarea>
                </div>

                <div class="auther__email__btn">
                    <div class="comment__form__control">
                        <input id="auther" type="text" name="name" placeholder="نام شما" maxlength="100"
                            minlength="4" required="required" @if (auth()->check()) value="{{ auth()->user()->name . ' ' . auth()->user()->family }}" readonly @endif>
                        <span id="UserNameErr"></span>
                    </div>

                    <div class="comment__form__control">
                        <input id="email" type="email" name="email" placeholder="ایمیل" maxlength="100"
                            minlength="4" required="required" @if (auth()->check()) value="{{ auth()->user()->email }}" readonly @endif>
                        <span id="UserEmailErr"></span>
                    </div>

                    <div class="comment__form__control">
                        <input id="submit__comment" type="submit" name="submitbtn" value="فرستادن دیدگاه">
                    </div>
                </div>
            </form>
        </div>

        <!-- all comments container -->
        <div class="allComments__cr">

            @foreach($comments as $comment)
            <div class="comment__cr">
                <div class="CommentReply" >
                    <a href="#comments__length" class="replyButton" data-commentid="{{ $comment->id }}" data-userinfo="{{ $comment->user->name . " " . $comment->user->family }}">
                        <i class="fa fa-reply"></i>
                    </a>
                </div>
                <div class="WrapCmDiv">
                    <div class="DateNameIcon__cr"><i class="fas fa-user Comment__user__icon"></i>
                        <p class="Comment__user__name">{{ $comment->name }}</p><span class="Comment__date__cr">{{ Morilog\Jalali\Jalalian::forge($comment->created_at)->format("Y-m-d H:i") }}</span>
                    </div>
                    <div class="LikeDislike__cr">
                        <div title="پسندیدم" class="cm_like_btn" data-commentID="{{ $comment->id }}" data-reaction="1">
                            <i class="fa fa-thumbs-up"></i>
                            <span id="cmLikeCounter-{{ $comment->id }}" @if ($comment->user_reaction != null && $comment->user_reaction == 1) class="text-green" @endif>
                                {{ $comment->likes_count }}
                            </span>
                        </div>
                        <div title="نپسندیدم" class="cm_dislike_btn" data-commentID="{{ $comment->id }}" data-reaction="-1">
                            <i class="fa fa-thumbs-down"></i>
                            <span id="cmDisLikeCounter-{{ $comment->id }}" @if ($comment->user_reaction != null && $comment->user_reaction == -1) class="text-red" @endif>
                                {{ $comment->dislikes_count }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="CommentTextCr">
                    <p>{{ $comment->text }}</p>
                </div>
                @if (count($comment->replies) > 0)
                    @foreach ($comment->replies as $replies)
                        <div class="comment__cr">
                            <div class="WrapCmDiv">
                                <div class="DateNameIcon__cr"><i class="fas fa-user Comment__user__icon"></i>
                                    <p class="Comment__user__name">
                                        {{ $replies->user->name . " " . $replies->user->family }}
                                    </p><span
                                        class="Comment__date__cr">{{ Morilog\Jalali\Jalalian::forge($replies->created_at)->format("Y-m-d H:i") }}</span>
                                </div>
                            </div>
                            <div class="CommentTextCr">
                                <p>{{ $replies->text }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @endforeach
            <div id="allComments"></div>
        </div>
        {{ $comments->links("vendor.pagination.movies") }}
    </div>
@endsection
@section('js')

<script src="{{ asset('assets/template/js/comments.js') }}"></script>
<script src="{{ asset("assets/template/js/Postinner.js") }}"></script>
<script>

</script>
@endsection