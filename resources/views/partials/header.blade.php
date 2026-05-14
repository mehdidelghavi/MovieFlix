<!-- Project Name : FlixMovie -->
<!-- Version : 1.0 -->
<!-- Created Data : 2021/09/16 | 1400/06/25 -->
<!-- Created By : Mahdi Illusion -->
<!-- All rights reserved -->
<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="locale" content="fa_IR">
    <meta name="url" content="https://movieflix.ir">
    <meta name="type" content="movie theme">
    <meta name="author" content="Admin">
    <meta name="engineer" content="Mahdi Rostami">
    <meta name="owner" content="Mehdi Delghavi">
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#6898f8">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#0f0f0f">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="newsletter-route" content="{{ route('index.newsletter') }}">
    @yield("metaHeader")
    <!-- description -->
    {!! SEO::generate() !!}
    <link rel="icon" href="{{ asset('assets/template/assest/logo/film.ico') }}"> <!-- Favicon -->
    <!-- Fontawesome -->
    <link rel="icon" href="{{ asset('assets/template/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/all2.min.css') }}">
    {{-- <link rel="icon" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/template/css/main.css') }}"> <!-- Css Include -->

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@700&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    <!-- ---------------- -->
    <!-- Loader animation -->
    <script>
        window.addEventListener("load", function () {
            document.querySelector('.loader-parent').classList.add('loaded');
            setTimeout(function () {
                document.querySelector('.loader-parent').remove();
            }, 3000)
        });

        function showBannerUpdate() {
            const banner = document.querySelector('#header-banner');
            const CloseBanner = document.querySelector('.close__banner');
            banner.classList.add('showUpdate');
            CloseBanner.addEventListener('click', function () {
                banner.classList.remove('showUpdate');
            })
        }

        setTimeout(showBannerUpdate, 1000);

    </script>

    <!-- show 404 page banner -->
    <div id="header-banner" class="container">
        <div id="Update-banner">
            <button class="close__banner"></button>
            <a href="https://flixmovie.mrluster.com/FlixMovie%20Panel/PanelLogin.html" target="_blank">هم اکنون از پنل
                فلیکس مووی هم
                بازدید کنید با اطلاعات 👈 <span class="badge blue-badge"> user-pass : admin </span></a>
        </div>
    </div>

    <!-- loader 3 -->
    <div class="loader-parent loader3">
        <div class="loader-film-strip">
            <div class="loader-strip-inner">
                <div class="loader-film-strip-inner"></div>
                <div class="loader-film-strip-inner inner-2"></div>
                <div class="loader-film-strip-inner inner-3"></div>
                <div class="loader-film-strip-inner inner-4"></div>
            </div>
        </div>
        <p class="loader-text">در حال بارگزاری</p>
    </div>
    <!-- Loader animation end -->
    <!-- --------------- -->

    <!-- Black mask -->
    <div class="mask"></div>

    <!-- Mobile Navigation Menu -->
    <nav class="mobile-navbar">
        <div class="mobile-nav-header">
            <div class="mobile-logo-container">
                <a href="index.html">
                    <img loading="lazy" src="{{ asset('assets/template/') }}/assest/logo/mobile-navigation-icon.svg" alt="">
                </a>
            </div>
        </div>

        <ul class="mobile-navigation-items">
            <li class="mobile-menu-title" data-dropdown="true">لینک دمو ها</li>
            <ul class="mobile-menu-collapse">
                <li class="mobile-link-item"><a href="index.html">صفحه اصلی</a></li>
                <li class="mobile-link-item"><a href="articles-demos.html">صفحه داخلی پست ها</a></li>
                <li class="mobile-link-item"><a href="matrix.html">صفحه در حال اکران</a></li>
                <li class="mobile-link-item"><a href="venom.html">صفحه در حال اکران ۲</a></li>
                <li class="mobile-link-item"><a href="spiderman.html">صفحه در حال اکران ۳</a></li>
                <li class="mobile-link-item"><a href="meydanesorkh.html">سریال میدان سرخ</a></li>
                <li class="mobile-link-item"><a href="contactus.html">صفحه تماس با ما</a></li>
                <li class="mobile-link-item"><a href="blog.html">وبلاگ</a></li>
                <li class="mobile-link-item"><a href="actors/KeanuReeves.html">صفحه بازیگران</a></li>
            </ul>

            <ul class="mobile-navigation-items">
                <li class="mobile-menu-title" data-dropdown="false"><a href="loaders.html">لودر ها</a> </li>
            </ul>

            <li class="mobile-menu-title" data-dropdown="true">فیلم خارجی</li>
            <ul class="mobile-menu-collapse">
                <li class="mobile-link-item"><a href="#">اکشن</a></li>
                <li class="mobile-link-item"><a href="#">تخیلی</a></li>
                <li class="mobile-link-item"><a href="#">علمی</a></li>
                <li class="mobile-link-item"><a href="#">کمدی</a></li>
                <li class="mobile-link-item"><a href="#">هندی</a></li>
                <li class="mobile-link-item"><a href="#">ترسناک</a></li>
                <li class="mobile-link-item"><a href="#">درام</a></li>
                <li class="mobile-link-item"><a href="#">تاریخی</a></li>
                <li class="view-all-videos-mobile"><a href="#" class="view-all-videos "> همه فیلم های خارجی
                        <svg class="arrow-left-icon" xmlns="http://www.w3.org/2000/svg"
                            enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#f9f9f9">
                            <rect fill="none" height="24" width="24" />
                            <path d="M9,19l1.41-1.41L5.83,13H22V11H5.83l4.59-4.59L9,5l-7,7L9,19z" />
                        </svg><i></i></a></li>
            </ul>
        </ul>

        <ul class="mobile-navigation-items">
            <li class="mobile-menu-title" data-dropdown="true">فیلم ایرانی </li>
            <ul class="mobile-menu-collapse">
                <li class="mobile-link-item"><a href="#">اجتماعی</a></li>
                <li class="mobile-link-item"><a href="#">کمدی</a></li>
                <li class="mobile-link-item"><a href="#">ترسناک</a></li>
                <li class="mobile-link-item"><a href="#">خانوادگی</a></li>
                <li class="mobile-link-item"><a href="#">رزمی</a></li>
                <li class="mobile-link-item"><a href="#">تاریخی</a></li>
                <li class="view-all-videos-mobile"><a href="#" class="view-all-videos "> همه فیلم های ایرانی
                        <svg class="arrow-left-icon" xmlns="http://www.w3.org/2000/svg"
                            enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#f9f9f9">
                            <rect fill="none" height="24" width="24" />
                            <path d="M9,19l1.41-1.41L5.83,13H22V11H5.83l4.59-4.59L9,5l-7,7L9,19z" />
                        </svg><i></i></a></li>
            </ul>
        </ul>

        <ul class="mobile-navigation-items">
            <li class="mobile-menu-title" data-dropdown="false"><a href="#">انیمیشن</a> </li>
        </ul>
        <ul class="mobile-navigation-items">
            <li class="mobile-menu-title" data-dropdown="false"><a href="#">سریال خارجی</a></li>
        </ul>
        <ul class="mobile-navigation-items">
            <li class="mobile-menu-title" data-dropdown="false"><a href="#">انیمه</a></li>
        </ul>
        <ul class="mobile-navigation-items">
            <li class="mobile-menu-title" data-dropdown="false"><a href="#">سریال کره ای</a></li>
        </ul>
        <ul class="mobile-navigation-items">
            <li class="mobile-menu-title" data-dropdown="true">بهترین ها </li>
            <ul class="mobile-menu-collapse">
                <li class="mobile-link-item"><a href="250-imdb.html">۲۵۰ فیلم برتر IMDB</a></li>
                <li class="mobile-link-item"><a href="collection.html">کالکشن</a></li>
                <li class="mobile-link-item"><a href="marvel.html">فیلم های Marvel</a></li>
                <li class="mobile-link-item"><a href="dc-movies.html">فیلم های DC</a></li>
                <li class="mobile-link-item"><a href="oscar.html">اسکار</a></li>
                <li class="mobile-link-item"><a href="nostalgia.html">نوستالژی</a></li>
            </ul>
        </ul>
        <ul class="mobile-navigation-items">
            <li class="mobile-menu-title" data-dropdown="false"><a href="contactus.html">ارتباط با ما</a></li>
        </ul>
        <ul class="mobile-navigation-items">
            <li class="mobile-menu-title" data-dropdown="false"><a href="blog.html">ورود به پنل</a></li>
        </ul>
    </nav>
    <!-- Mobile Navigation End-->
    <!-- -------------------- -->
    <!-- -------------------- -->
    <!-- -------------------- -->

    <!-- Header -->
    <header class="header">
        <!-- Navigation bar on header -->
        <nav class="desktop-navbar" role="navigation" aria-label="navigation">

            <div class="container desktop-navbar-container">

                <!-- Mobile Navbar -->
                <div class="mobile-menu-icon">
                    <svg role="button" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                    </svg>
                </div>

                <!-- Desktop and mobile logo -->
                <div class="desktop-logo-container">
                    <a href="{{ route('index') }}">
                        <svg class="desktop-logo" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                            version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 512 512"
                            style="enable-background:new 0 0 512 512" xml:space="preserve">
                            <g>
                                <linearGradient xmlns="http://www.w3.org/2000/svg" id="SVGID_1_"
                                    gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="496" y2="16">
                                    <stop stop-opacity="1" stop-color="#fa697c" offset="0" />
                                    <stop stop-opacity="1" stop-color="#fa9f6f" offset="1" />
                                </linearGradient>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="m100 256c-11.046 0-20 8.954-20 20s8.954 20 20 20 20-8.954 20-20-8.954-20-20-20zm296 160h-360v40h360v40h40v-40h40v-40h-40zm-296-240c-11.046 0-20 8.954-20 20s8.954 20 20 20 20-8.954 20-20-8.954-20-20-20zm0-80c-11.046 0-20 8.954-20 20s8.954 20 20 20 20-8.954 20-20-8.954-20-20-20zm312 0c-11.046 0-20 8.954-20 20s8.954 20 20 20 20-8.954 20-20-8.954-20-20-20zm40-80h-392c-33.084 0-60 26.916-60 60v240c0 33.084 26.916 60 60 60h392c33.084 0 60-26.916 60-60v-240c0-33.084-26.916-60-60-60zm20 300c0 11.028-8.972 20-20 20h-392c-11.028 0-20-8.972-20-20v-240c0-11.028 8.972-20 20-20h392c11.028 0 20 8.972 20 20zm-276-20 133.333-100-133.333-100zm40-120 26.667 20-26.667 20zm176 0c-11.046 0-20 8.954-20 20s8.954 20 20 20 20-8.954 20-20-8.954-20-20-20zm0 80c-11.046 0-20 8.954-20 20s8.954 20 20 20 20-8.954 20-20-8.954-20-20-20z"
                                            fill="url(#SVGID_1_)" data-original="url(#SVGID_1_)" style="fill: auto;"> />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>

                <!-- Desktop Navigation Items -->
                <ul class="navigation-items">
                    <!-- demo links -->
                    <div class="menu-with-dropdown">
                        <li class="navlinks-title"><a href="{{ route('index.category', ['category' => 'movies']) }}">فیلم ها <svg class="angle-bottom-menu-icon"
                                    xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                    fill="#f9f9f9">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z" />
                                </svg></a></li>
                        <ul class="dropdown-desktop-menu">
                            @foreach ($genres as $genre)
                                <li><a href="{{ route('index.category', ['category'=> 'genre_movies', 'category_value' => $genre->title]) }}">{{ $genre->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- demo links end -->

                    <div class="menu-with-dropdown">
                        <li class="navlinks-title"><a href="{{ route('index.category', ['category' => 'irani']) }}">فیلم ایرانی</a></li>
                    </div>
                    <div class="menu-with-dropdown">
                        <li class="navlinks-title"><a href="{{ route('index.category', ['category' => 'series']) }}">سریال<svg class="angle-bottom-menu-icon"
                                    xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                    fill="#f9f9f9">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z" />
                                </svg></a></li>
                        <ul class="dropdown-desktop-menu">
                            <li><a href="{{ route('index.category', ['category' => 'series', 'category_value' => 'ایرانی']) }}">سریال ایرانی</a></li>
                            <li><a href="{{ route('index.category', ['category' => 'series', 'category_value' => 'خارجی']) }}">سریال خارجی</a></li>
                            <li><a href="{{ route('index.category', ['category' => 'series', 'category_value' => 'ترکی']) }}">سریال ترکی</a></li>
                            <li><a href="{{ route('index.category', ['category' => 'series', 'category_value' => 'کره ای']) }}">سریال کره ای</a></li>
                        </ul>
                    </div>
                    <li class="navlinks-title"><a href="{{ route('index.category', ['category' => 'animation']) }}"> انیمیشن</a></li>
                    <li class="navlinks-title"><a href="{{ route('index.category', ['category' => 'anime']) }}"> انیمه</a></li>
                    <div class="menu-with-dropdown">
                        <li class="navlinks-title"><a> سایر <svg class="angle-bottom-menu-icon"
                                    xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                    fill="#f9f9f9">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z" />
                                </svg></a></li>
                        <ul class="dropdown-desktop-menu">
                            @foreach ($lists as $list)
                                <li><a href="{{ route('index.category', ['category' => $list->slug]) }}">{{ $list->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <li class="navlinks-title vip-btn"><a href="{{ route('panel.login') }}">ورود به پنل کاربری</a></li>
                </ul>
                <!-- Desktop searchbox -->
                <div class="desktop-searchbox">
                    <button class="closeSearchBox">بستن</button>
                    <form id="searchBoxForm" class="desktop-searchbox-form" method="GET" action="@if(Str::contains(request()->url(), 'blog')){{ route('blog.search') }} @else {{ route('index.search') }}  @endif">
                        <input id="searchInput" name="search" autocomplete="off" type="text" placeholder="کلمه مورد نظر">
                        <button type="submit"><svg class="searchbox-icon" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 98 98"
                                style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <style xmlns="http://www.w3.org/2000/svg" type="text/css">
                                        .st0 {
                                            fill: url(#SVGID_1_);
                                        }
                                    </style>
                                    <linearGradient xmlns="http://www.w3.org/2000/svg" id="SVGID_1_"
                                        gradientUnits="userSpaceOnUse" x1="49" y1="14.0999" x2="49" y2="87.9001">
                                        <stop stop-opacity="1" stop-color="#fa697c" offset="0" />
                                        <stop stop-opacity="1" stop-color="#fa9f6f" offset="1" />
                                    </linearGradient>
                                    <path xmlns="http://www.w3.org/2000/svg" class="st0"
                                        d="M85,82.8L69.6,67.3c4.7-5.6,7.5-12.9,7.5-20.7c0-17.9-14.6-32.5-32.5-32.5S12.1,28.7,12.1,46.6  s14.6,32.5,32.5,32.5c7.9,0,15.1-2.8,20.7-7.5L80.8,87c0.6,0.6,1.4,0.9,2.1,0.9s1.5-0.3,2.1-0.9C86.2,85.9,86.2,83.9,85,82.8z   M18.1,46.6C18.1,32,30,20.1,44.6,20.1c14.6,0,26.5,11.9,26.5,26.5c0,14.6-11.9,26.5-26.5,26.5C30,73.1,18.1,61.2,18.1,46.6z"
                                        fill="#000000" data-original="#000000" style="fill: auto;"> />
                                </g>
                            </svg>
                            <!-- Clear search icon -->
                            <div class="cancelSearchIcon"></div>
                        </button>
                    </form>
                </div>
                <button class="MobileSearchbox-icon-Container"><svg class="Mobile-searchbox-icon"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0"
                        viewBox="0 0 98 98" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <style xmlns="http://www.w3.org/2000/svg" type="text/css">
                                .st0 {
                                    fill: url(#SVGID_1_);
                                }
                            </style>
                            <linearGradient xmlns="http://www.w3.org/2000/svg" id="SVGID_1_"
                                gradientUnits="userSpaceOnUse" x1="49" y1="14.0999" x2="49" y2="87.9001">
                                <stop stop-opacity="1" stop-color="#fa697c" offset="0" />
                                <stop stop-opacity="1" stop-color="#fa9f6f" offset="1" />
                            </linearGradient>
                            <path xmlns="http://www.w3.org/2000/svg" class="st0"
                                d="M85,82.8L69.6,67.3c4.7-5.6,7.5-12.9,7.5-20.7c0-17.9-14.6-32.5-32.5-32.5S12.1,28.7,12.1,46.6  s14.6,32.5,32.5,32.5c7.9,0,15.1-2.8,20.7-7.5L80.8,87c0.6,0.6,1.4,0.9,2.1,0.9s1.5-0.3,2.1-0.9C86.2,85.9,86.2,83.9,85,82.8z   M18.1,46.6C18.1,32,30,20.1,44.6,20.1c14.6,0,26.5,11.9,26.5,26.5c0,14.6-11.9,26.5-26.5,26.5C30,73.1,18.1,61.2,18.1,46.6z"
                                fill="#000000" data-original="#000000" style="fill: auto;"> />
                        </g>
                    </svg>
                </button>
            </div>
        </nav>
    </header>
    <!-- Header end -->