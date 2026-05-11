@extends('master')
@section("content")
    <!-- Main Section -->
    <main class="main-content-top-video-choises">
        <!-- Top choices Videos Start-->
        <section class="container top-choices-items">
        @foreach ($suggestedMovies as $suggestedMovie)
                <section class="top-choices-item">
                    <div class="video-thumbmail relative">
                        <a class="video-thumbmail-link" href="{{ route('index.movie', ['slug' => $suggestedMovie->slug]) }}" title="{{ $suggestedMovie->title[0] }}">
                            <img loading="lazy" class="top-choices-imgages" class="top-choices-imgages"
                                src="{{ env('APP_URL') . "storage/movies/" . str_replace(" ", "", $suggestedMovie->title[1]) . '/thumbnail/' . $suggestedMovie->thumbnail }}" alt="فیلم جنگ فردا">
                            <div class="top-choices-video-overlay">
                                <p class="top-choices-info">
                                    <span class="top-choices-like"><i class="fa fa-heart"></i> ۸۴% </span> <span
                                        class="top-choices-imdb"><i class="fab fa-imdb"></i>
                                        <span> {{ $suggestedMovie->imdb }} / ۱۰ </span></span>
                                </p>
                                <h2 class="top-choices-title">{{ $suggestedMovie->title[0] }}</h2>
                                <p class="top-choices-espoide">{{ $suggestedMovie->title[1] }}</p>
                                <p class="top-choices-badge">
                                    <span class="yellow-badge badge">مشاهده</span>
                                </p>
                            </div>
                        </a>
                    </div>
                </section>
            @endforeach
        </section>
        <!-- Top choices Videos End-->
    </main>
    <!-- Main section end -->
    <!-- ---------------- -->
    <!-- ---------------- -->
    <!-- ---------------- -->

    <!-- Main Body -->
    <section class="main-body" id="index-main-body">
        <article class="container articles-container">

            <div class="articles-aside">
                <!-- Posts Container -->
                <section id="main-article-container" class="main-articles">
                    <div class="article-header">
                        <p class="title">جدیدترین فیلم و سریال ها</p>
                        <button id="ArticlesSearchFilter"><i class="fas fa-search"></i> جستجوی پیشرفته</button>
                    </div>
                    @foreach ($indexMovies as $indexMovie)
                        <!-- Post container -->
                        <article class="main-post">
                            <div class="post-img-container">
                                <a href="{{ route('index.movie', ['slug' => $indexMovie->slug]) }}" title="{{ $indexMovie->title[0] }}">
                                    <img loading="lazy" class="article-img"
                                        src="{{ env('APP_URL') . "storage/movies/" . str_replace(" " ,"", $indexMovie->title[1]) . "/thumbnail/" . $indexMovie->thumbnail }}"
                                        alt="{{ $indexMovie->title[0] }}">
                                </a>
                            </div>
                            <div class="post-info">
                                <div class="post-title-container">
                                    <h1 class="post-info-title">
                                        <a class="post-info-link" href="{{ route('index.movie', ['slug' => $indexMovie->slug]) }}" title="{{ $indexMovie->title[0] }}">
                                            {{ $indexMovie->title[0] }}
                                        </a>
                                    </h1>
                                </div>
                                <div class="post-meta">
                                    <span class="post-meta-tags"><i class="fa fa-tag"></i> 
                                        @foreach ($indexMovie->genres as $indexMovieGenre)
                                            <a href="{{ route('index.category', ['category' => 'genre_movies', 'category_value' => $indexMovieGenre->title]) }}">{{ $indexMovieGenre->title }}</a> 
                                            @if (!$loop->first)
                                                <span class="tags-horzontal-line"></span> 
                                            @endif
                                        @endforeach
                                    </span>
                                    <span class="top-choices-like post-meta-like"><i class="fa fa-heart"></i> ۹۵%
                                        رضایت</span>
                                </div>

                                <div class="actors-director-container">
                                    <div class="actors">
                                        <span class="actors-title">بازیگران </span>
                                        @foreach ($indexMovie->actors as $indexMovieActor)
                                            <a href="{{ route('index.category', ['category' => 'actor', 'category_value' => $indexMovieActor->name]) }}">{{ $indexMovieActor->name }} @if(!$loop->last) ,@endif</a>
                                        @endforeach
                                    </div>
                                    <div class="director">
                                        <span class="actors-title">کارگردان </span>
                                        @php
                                            $indexMovieDirectors = $indexMovie->director;
                                            $i = 0;
                                        @endphp
                                        @for ($i = 0;$i < count($indexMovieDirectors);$i++)
                                            <a href="{{ route('index.category', ['category' => 'director', 'category_value' => $indexMovieDirectors[$i]]) }}">@if($i != 0) , @endif{{ $indexMovieDirectors[$i] }}</a>
                                        @endfor
                                    </div>
                                </div>
                                <div class="post-summary">
                                    <p class="post-summary-text">{{ Str::limit($indexMovie->story, 110) }}</p>
                                </div>
                                <div class="post-time-country-score-btn-container">
                                    <div class="post-time-country-score">
                                        <p><i class="far fa-calendar"></i> سال انتشار : {{ $indexMovie->creation_year }} </p>
                                        <p><i class="fas fa-globe-europe"></i> کشور : {{ $indexMovie->country }} </p>
                                    </div>
                                    <div class="post-btn">
                                        <button class="post-btn-con">
                                            <a class="post-btn-link" href="{{ route('index.movie', ['slug' => $indexMovie->slug]) }}"><i class="fa fa-download"></i>
                                                دانلود
                                                سریال</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <!-- Post container end -->
                    @endforeach

                    {{ $indexMovies->links("vendor.pagination.movies") }}

                    
                </section>
                <!-- Right aside section end-->
                <!-- ---------------------- -->
                <!-- ---------------------- -->
                <!-- ---------------------- -->

                <!-- Main Aside Container -->
                <aside class="main-aside">
                    <section class="aside-section">

                        <!-- Serials btn -->
                        <div class="updates-and-search-btn">
                            <div class="aside-tab"></div>
                            <nav class="tabs-container">
                                <div class="updates-video">
                                    <a href="javascript:void(0)">به روز شده ها</a>
                                </div>
                                <div class="filters-tab">
                                    <a id="Search-Filter" href="javascript:void(0)">فیلتر جستجو</a>
                                </div>
                            </nav>
                        </div>

                        <section id="serials-upd">
                            @if (count($updatedSeries) > 0)
                            <div class="serial-updates">
                                <h1 class="serial-updates-title"><i class="fas fa-sync"></i> آپدیت سریال ها </h1>
                                <div class="view-all-serial-updates">
                                    <a href="#">مشاهده همه</a>
                                </div>
                            </div>

                            <!-- new serialas container -->
                            <section class="serials-container">
                            @foreach ($updatedSeries as $updatedSerie)
                                    <!-- Serial Update Container -->
                                    <div class="serial-container">
                                        <a title=" سریال The Morning show" href="{{ route("index.movie", ['slug' => $updatedSerie->slug]) }}">
                                            <div class="serial-thumbmail">
                                                <img loading="lazy"
                                                    src="{{ env("APP_URL") . 'storage/movies/' . str_replace(" ","", $updatedSerie->title[1]) . '/thumbnail/' . $updatedSerie->thumbnail }}"
                                                    alt="سریال The Morning show">
                                            </div>

                                            <div class="serial-overlay">
                                                <p>{{ $updatedSerie->title[0] }}</p>
                                                @php
                                                    $date = \Carbon\Carbon::parse($updatedSerie->updated_at);

                                                    if ($date->isToday()) {
                                                        $humanDate = 'امروز';
                                                    } elseif ($date->isYesterday()) {
                                                        $humanDate = 'دیروز';
                                                    } else {
                                                        $days = $date->diffInDays();
                                                        $humanDate = floor($days) . ' روز پیش';
                                                    }
                                                @endphp
                                                <span class="serial-badge">{{ $humanDate }}</span>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- Serial Update Container end -->
                                @endforeach
                            </section>
                            <!-- ---------- -->
                            @endif
                            <!-- ---------- -->
                            <!-- ---------- -->

                            <!-- Dubbed Section -->
                            <section class="dubbed-section">
                                <div class="dubbed-mic">
                                    <div class="dubbed-img-container">
                                        <img loading="lazy" src="{{ asset('assets/template/') }}/assest/images/icons/mic-4029237-3337935.png" alt="">
                                    </div>
                                    <div class="dubbed-text-container">
                                        <p>فقط در فلیکس مووی</p>
                                        <h1>دوبله های فارسی</h1>
                                    </div>
                                </div>

                                <div class="dubbed-options">
                                    <div class="fa-film-dubbed">
                                        <a title="فیلم های دوبله فارسی" href="{{ route('index.category', ['category' => 'فیلم-های-دوبله-فارسی']) }}">فیلم های دوبله فارسی</a>
                                    </div>
                                    <div class="fa-animation-dubbed">
                                        <a title="انیمیشن دوبله فارسی" href="{{ route('index.category', ['category' => 'انیمیشن-های-دوبله-فارسی']) }}">انیمیشن دوبله فارسی</a>
                                    </div>
                                </div>
                            </section>


                            <div class="serial-updates coming-soon-serials-title">
                                <h1 class="serial-updates-title"><i class="fas fa-film"></i> به زودی </h1>
                                <div class="view-all-serial-updates">
                                    <a href="#">مشاهده همه</a>
                                </div>
                            </div>
                            <!-- --------------- -->
                            <!-- --------------- -->
                            <!-- --------------- -->

                            @if (count($releasedMovies) > 0)
                            <!-- Coming Soon Serials container -->
                            <section class="serials-container coming-soon-serials">
                                @foreach ($releasedMovies as $rMovie)
                                    <!-- Serial Update Container -->
                                        <div class="serial-container">
                                            <a title="{{ $rMovie->title[0] }}" href="{{ route('index.movie', ['slug' => $rMovie->slug]) }}">
                                                <div class="serial-thumbmail">
                                                    <img loading="lazy" src="{{ env('APP_URL') . "storage/movies/" . str_replace(" ", "", $rMovie->title[1]) . "/thumbnail/" . $rMovie->thumbnail  }}"
                                                        alt="{{ $rMovie->title[0] }}">
                                                </div>

                                                <div class="serial-overlay">
                                                    <p>{{ Str::limit($rMovie->title[0], 40) }}</p>
                                                    <span class="serial-badge">{{ Carbon\Carbon::now()->diffForHumans($rMovie->release_date,true) }}</span>
                                                </div>
                                            </a>
                                        </div>
                                    <!-- Serial Update Container end -->
                                @endforeach
                            </section>
                            <!-- ----------- -->
                            @endif
                            <!-- ----------- -->
                            <!-- ----------- -->
                        </section>
                        <!-- New serials container end -->

                        <!-- Search Filter -->
                        @include("searchFields")
                </aside>
                <!-- aside end -->
            </div>
        </article>
    </section>
    <!-- main body end -->
    <!-- ------------- -->
    <!-- ------------- -->
@endsection