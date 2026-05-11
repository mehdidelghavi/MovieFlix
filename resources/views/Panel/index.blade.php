@extends('Panel.master')
@section('content')


        <!-- main panel container -->
        <section class="main__panel__section">
            <!-- panel header start -->
            <header class="main__panel__header">
                <!-- menu panel header fixed -->
                <div class="mobile__panel__header">
                    <div class="mobile__panel__logo ">
                        <a href="Panel.html">
                            <img loading="lazy" clsas="panel-logo" src="../assest/logo/mobile-navigation-icon.svg"
                                alt="">
                        </a>
                    </div>
                    <button id="openPanelNav" class="OpenPanelNavbar" role="button">
                        <div class="panel-bar"></div>
                        <div class="panel-bar"></div>
                        <div class="panel-bar"></div>
                    </button>
                </div>
                <!-- menu panel header fixed end-->

                <!-- panel page title -->
                <div class="panel__page__title" id="user-panel-page-title">
                    <h1>پیشخوان کاربری</h1>

                    @include('Panel.partials.head')

                </div>
                <!-- panel page title end-->
            </header>
            <!-- page header end -->

            <!-- website analytics counters -->
            <section class="website__analytics">
                <div class="website-analytics-cr">
                    <p>اشتراک فعال</p>
                    <div class="website-analytics-count">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="4" width="18" height="18" rx="2" stroke="#2196F3" stroke-width="2"/>
                        <path d="M16 2V6M8 2V6M3 10H21" stroke="#2196F3" stroke-width="2"/>
                        <path d="M9 16L11 18L15 14" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <p id="website-views">
                            @if($activeSub != null)
                                @php

                                    $expireDate = Carbon\Carbon::parse($activeSub->expireDate);
                                    $today = Carbon\Carbon::now();
                                    $daysLeft = $today->diffInDays($expireDate, false);
                                @endphp
                                {{ round($daysLeft) }} روز باقی مانده
                            @else
                                اشتراک فعالی ندارید
                            @endif
                        </p>
                    </div>
                </div>

                <div class="website-analytics-cr">
                    <p>تیکت ها</p>
                    <div class="website-analytics-count">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0"
                            viewBox="0 0 48 48">
                            <g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m3 43h42a1 1 0 0 0 1-1v-7a1 1 0 0 0 -1-1h-2a3 3 0 0 1 0-6h2a1 1 0 0 0 1-1v-7a1 1 0 0 0 -1-1h-42a1 1 0 0 0 -1 1v7a1 1 0 0 0 1 1h2a3 3 0 0 1 0 6h-2a1 1 0 0 0 -1 1v7a1 1 0 0 0 1 1zm29-19a1 1 0 0 1 2 0v2a1 1 0 0 1 -2 0zm0 6a1 1 0 0 1 2 0v2a1 1 0 0 1 -2 0zm0 6a1 1 0 0 1 2 0v2a1 1 0 0 1 -2 0zm-17-11h12a1 1 0 0 1 0 2h-12a1 1 0 0 1 0-2zm0 5h12a1 1 0 0 1 0 2h-12a1 1 0 0 1 0-2zm0 5h12a1 1 0 0 1 0 2h-12a1 1 0 0 1 0-2z">
                                    </path>
                                    <path
                                        d="m9.24 5.62-2.66 6.47a.94.94 0 0 0 0 .77 1 1 0 0 0 .54.54l1.88.76a3 3 0 0 1 1.82 2.84h28.67l-28.94-11.92a1 1 0 0 0 -1.31.54z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <p id="added-items">{{ $ticketCount }}</p>
                    </div>
                </div>

                <div class="website-analytics-cr">
                    <p>نظرات ارسال شده</p>
                    <div class="website-analytics-count">
                        <svg version="1.1" viewBox="0 0 512 512">
                            <g>
                                <path
                                    d="m303.392 61.393c-31.795-19.61-69.472-30.393-108.392-30.393-105.946 0-195 78.933-195 180 0 35.435 11.008 69.404 31.918 98.741l-29.21 91.706c-3.086 9.687 4.17 19.553 14.295 19.553 2.315 0 4.645-.535 6.795-1.629l88.832-45.167c3.597 1.549 7.239 2.99 10.918 4.328-20.567-32.102-31.548-68.952-31.548-107.532 0-114.897 96.678-203.228 211.392-209.607z">
                                </path>
                                <path
                                    d="m480.082 369.741c20.91-29.337 31.918-63.306 31.918-98.741 0-101.104-89.092-180-195-180-105.946 0-195 78.933-195 180 0 101.104 89.092 180 195 180 28.417 0 56.732-5.791 82.365-16.798l88.837 45.169c5.391 2.741 11.903 1.976 16.512-1.941s6.415-10.219 4.579-15.982zm-224.082-83.741c-8.284 0-15-6.716-15-15s6.716-15 15-15 15 6.716 15 15-6.716 15-15 15zm60 0c-8.284 0-15-6.716-15-15s6.716-15 15-15 15 6.716 15 15-6.716 15-15 15zm60 0c-8.284 0-15-6.716-15-15s6.716-15 15-15 15 6.716 15 15-6.716 15-15 15z">
                                </path>
                            </g>
                        </svg>
                        <p id="new-comments">{{ $commentsCount }}</p>
                    </div>
                </div>

                <div class="website-analytics-cr">
                    <p>علاقه مندی ها</p>
                    <div class="website-analytics-count">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512">
                            <g>
                                <path
                                    d="m376 43.839c-60.645 0-99.609 39.683-120 75.337-20.391-35.654-59.355-75.337-120-75.337-76.963 0-136 58.945-136 137.124 0 84.771 73.964 142.5 184.413 229.907 54.082 42.761 57.557 46.011 71.587 57.29 11.45-9.205 17.787-14.751 71.587-57.29 110.449-87.407 184.413-145.136 184.413-229.907 0-78.178-59.037-137.124-136-137.124z">
                                </path>
                            </g>
                        </svg>
                        <p id="fav-movies">{{ $likesCount }}</p>
                    </div>
                </div>
            </section>
            <!-- website analytics counters end-->

            <!-- website analytics tables -->
            <section class="website-analytics-last-cr">
                <!-- start -->
                <div class="analytics-container">
                    @if (count($watchedMovies) > 0)
                        <div class="analytics-title">
                            <div class="analytics-right-title">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512">
                                    <g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="m347 356.272v41.456l41.455-20.728z">
                                                </path>
                                                <path d="m242 242v270h270v-270zm75 204.272v-138.544l138.545 69.272z"></path>
                                            </g>
                                            <g>
                                                <path d="m90 8.789-81.211 81.211h81.211z">
                                                </path>
                                                <path
                                                    d="m120 0v120h-120v332h212v-90h-152v-30h152v-30h-152v-30h152v-30h-152v-30h272v-212zm152 182h-212v-30h212z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <h2>فیلم های دیده شده</h2>
                            </div>

                            <div class="analytics-left-title">
                                <a href="{{ route('panel.watched') }}" class="show-all-btn">
                                    <p>نمایش همه</p>
                                </a>
                            </div>
                        </div>
                        <div class="analytics-table">
                            <div class="analytics-tr">
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th">عنوان</h3>
                                    @foreach ($watchedMovies as $wMovies)
                                        <li> <a href="{{ route('index.movie', ['slug' => $wMovies->slug]) }}" class="analytics-table-link">{{ Str::limit($wMovies->title[0], 30) }}</a></li>
                                    @endforeach
                                </ul>
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th">ژانر</h3>
                                    @foreach ($watchedMovies as $wMovies)
                                        <li>
                                            @foreach ($wMovies->genres as $wGenres)
                                                {{ $wGenres->title }}
                                                @if(!$loop->last)
                                                ,
                                                @endif
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th">زمان فیلم</h3>
                                    @foreach ($watchedMovies as $wMovies)
                                        <li class="panel-green-class">
                                            {{ $wMovies->getFormattedDurationAttribute() }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="analytics-table">
                            <div class="ticket-send-section nullitem">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512" class="__web-inspector-hide-shortcut__">
                                    <g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="m347 356.272v41.456l41.455-20.728z">
                                                </path>
                                                <path d="m242 242v270h270v-270zm75 204.272v-138.544l138.545 69.272z"></path>
                                            </g>
                                            <g>
                                                <path d="m90 8.789-81.211 81.211h81.211z">
                                                </path>
                                                <path d="m120 0v120h-120v332h212v-90h-152v-30h152v-30h-152v-30h152v-30h-152v-30h272v-212zm152 182h-212v-30h212z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <h1>فیلم و سریال های تماشا شده</h1>
                                <p>هیچ فیلم یا سریالی تماشا نکرده اید</p>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- end -->
                <!-- start -->
                <div class="analytics-container">
                    @if (count($comments) > 0)
                        <div class="analytics-title">
                            <div class="analytics-right-title">
                                <svg version="1.1" viewBox="0 0 512 512">
                                    <g>
                                        <path
                                            d="m303.392 61.393c-31.795-19.61-69.472-30.393-108.392-30.393-105.946 0-195 78.933-195 180 0 35.435 11.008 69.404 31.918 98.741l-29.21 91.706c-3.086 9.687 4.17 19.553 14.295 19.553 2.315 0 4.645-.535 6.795-1.629l88.832-45.167c3.597 1.549 7.239 2.99 10.918 4.328-20.567-32.102-31.548-68.952-31.548-107.532 0-114.897 96.678-203.228 211.392-209.607z">
                                        </path>
                                        <path
                                            d="m480.082 369.741c20.91-29.337 31.918-63.306 31.918-98.741 0-101.104-89.092-180-195-180-105.946 0-195 78.933-195 180 0 101.104 89.092 180 195 180 28.417 0 56.732-5.791 82.365-16.798l88.837 45.169c5.391 2.741 11.903 1.976 16.512-1.941s6.415-10.219 4.579-15.982zm-224.082-83.741c-8.284 0-15-6.716-15-15s6.716-15 15-15 15 6.716 15 15-6.716 15-15 15zm60 0c-8.284 0-15-6.716-15-15s6.716-15 15-15 15 6.716 15 15-6.716 15-15 15zm60 0c-8.284 0-15-6.716-15-15s6.716-15 15-15 15 6.716 15 15-6.716 15-15 15z">
                                        </path>
                                    </g>
                                </svg>
                                <h2>نظرات ارسال شده</h2>
                            </div>

                            <div class="analytics-left-title">
                                <a href="{{ route('panel.comments') }}" class="show-all-btn">
                                    <p>نمایش همه</p>
                                </a>
                            </div>
                        </div>
                        <div class="analytics-table">
                            <div class="analytics-tr">
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th">نظر به پست</h3>
                                    @foreach ($comments as $comment)
                                        <li>{!! $comment->commentable->getCommentLink(40) !!}</li>
                                    @endforeach
                                </ul>
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th"> لایک ها</h3>
                                    @foreach ($comments as $comment)
                                        <li class="panel-green-class">{{ $comment->likes_count }}</li>
                                    @endforeach
                                </ul>
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th"> دیسلایک ها</h3>
                                    @foreach ($comments as $comment)
                                        <li class="panel-red-class">{{ $comment->dislikes_count }}</li>
                                    @endforeach
                                </ul>
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th">متن کامنت</h3>
                                    @foreach ($comments as $comment)
                                        <li class="panel-green-class">
                                            {{ Str::limit($comment->text, 20) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="analytics-table">
                            <div class="ticket-send-section nullitem">
                                <svg version="1.1" viewBox="0 0 512 512">
                                    <g>
                                        <path d="m303.392 61.393c-31.795-19.61-69.472-30.393-108.392-30.393-105.946 0-195 78.933-195 180 0 35.435 11.008 69.404 31.918 98.741l-29.21 91.706c-3.086 9.687 4.17 19.553 14.295 19.553 2.315 0 4.645-.535 6.795-1.629l88.832-45.167c3.597 1.549 7.239 2.99 10.918 4.328-20.567-32.102-31.548-68.952-31.548-107.532 0-114.897 96.678-203.228 211.392-209.607z">
                                        </path>
                                        <path d="m480.082 369.741c20.91-29.337 31.918-63.306 31.918-98.741 0-101.104-89.092-180-195-180-105.946 0-195 78.933-195 180 0 101.104 89.092 180 195 180 28.417 0 56.732-5.791 82.365-16.798l88.837 45.169c5.391 2.741 11.903 1.976 16.512-1.941s6.415-10.219 4.579-15.982zm-224.082-83.741c-8.284 0-15-6.716-15-15s6.716-15 15-15 15 6.716 15 15-6.716 15-15 15zm60 0c-8.284 0-15-6.716-15-15s6.716-15 15-15 15 6.716 15 15-6.716 15-15 15zm60 0c-8.284 0-15-6.716-15-15s6.716-15 15-15 15 6.716 15 15-6.716 15-15 15z">
                                        </path>
                                    </g>
                                </svg>
                                <h1>نظرات ارسال شده</h1>
                                <p>برای ارسال نظر وارد حساب کاربری خود شوید و در قسمت ارسال نظرات فیلم یا سریال و مقالات اقدام کنید</p>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- end -->
                <!-- start -->
                <div class="analytics-container">
                    @if (count($likedMovies) > 0)
                        <div class="analytics-title">
                            <div class="analytics-right-title">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512">
                                    <g>
                                        <path
                                            d="m376 43.839c-60.645 0-99.609 39.683-120 75.337-20.391-35.654-59.355-75.337-120-75.337-76.963 0-136 58.945-136 137.124 0 84.771 73.964 142.5 184.413 229.907 54.082 42.761 57.557 46.011 71.587 57.29 11.45-9.205 17.787-14.751 71.587-57.29 110.449-87.407 184.413-145.136 184.413-229.907 0-78.178-59.037-137.124-136-137.124z">
                                        </path>
                                    </g>
                                </svg>
                                <h2>علاقه مندی ها</h2>
                            </div>
                            <div class="analytics-left-title">
                                <a href="{{ route('panel.likedMovies') }}" class="show-all-btn">
                                    <p>نمایش همه</p>
                                </a>
                            </div>
                        </div>
                        <div class="analytics-table">
                            <div class="analytics-tr">
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th">نام فیلم</h3>
                                    @foreach ($likedMovies as $lMovies)
                                        <li><a href="{{ route('index.movie', ['slug' => $lMovies->slug]) }}">{{ Str::limit($lMovies->title[0] , 30) }}</a></li>
                                    @endforeach
                                </ul>
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th"> لایک ها</h3>
                                    @foreach ($likedMovies as $lMovies)
                                        <li class="panel-green-class">{{ $lMovies->likes_count }}</li>
                                    @endforeach
                                </ul>
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th"> دیسلایک ها</h3>
                                    @foreach ($likedMovies as $lMovies)
                                        <li class="panel-red-class">{{ $lMovies->dislikes_count }}</li>
                                    @endforeach
                                </ul>
                                <ul class="analytics-table-container-tr">
                                    <h3 class="analytics-table-th">امتیاز imdb</h3>
                                    @foreach ($likedMovies as $lMovies)
                                        <li> {{ $lMovies->imdb }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="analytics-table">
                            <div class="ticket-send-section nullitem">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512">
                                    <g>
                                        <path
                                            d="m376 43.839c-60.645 0-99.609 39.683-120 75.337-20.391-35.654-59.355-75.337-120-75.337-76.963 0-136 58.945-136 137.124 0 84.771 73.964 142.5 184.413 229.907 54.082 42.761 57.557 46.011 71.587 57.29 11.45-9.205 17.787-14.751 71.587-57.29 110.449-87.407 184.413-145.136 184.413-229.907 0-78.178-59.037-137.124-136-137.124z">
                                        </path>
                                    </g>
                                </svg>
                                <h1>علاقه مندی ها</h1>
                                <p>برای افزودن فیلم یا سریال به علاقه مندی ها در صفحه مربوط به فیلم یا سریال آن را لایک کنید</p>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- end -->
            </section>
            <!-- website analytics tables end-->
        </section>
        <!-- menu panel container end -->
    </main>

    <div class="user-balance-alert">
        <h1>موجودی حساب شما</h1>
        <div class="chest">
            <img src="/assest/images/backgrounds/chest.png" alt="chest">
        </div>
        <p class="balance-counter">2378</p>

        <div class="balance-action-buttons">
            <button class="balance-action-btn">شارژ حساب</button>
            <button class="balance-action-btn danger" id="close-balance-alert">بستن</button>
        </div>
    </div>
@endsection