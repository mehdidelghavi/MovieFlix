<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#6898f8">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#0f0f0f">
    <title>پنل کاربری - فلیکس مووی</title>

@yield('css')
    <link rel="icon" href="{{ asset('assets/template/assest/logo/film.ico') }}"> <!-- Favicon -->

    <!-- fontawesome -->
    {{-- <link rel="icon" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}
    <link rel="icon" href="{{ asset('assets/template/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/css/all2.min.css') }}">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/template/css/main.css') }}">

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@700&display=swap" rel="stylesheet">
</head>

<body class="panel">
    <!-- scripts -->
    <script>
        // loader animation
        window.addEventListener("load", function () {
            document.querySelector('.loader-parent').classList.add('loaded');
            setTimeout(function () {
                document.querySelector('.loader-parent').remove();
            }, 3000)
        });
    </script>

    <!--  loader 3  -->
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
    <!--Loader animation end-- >
 < !-- --------------- -->

    <!-- start panel container -->
    <main class="panel__main__container container">
        <div class="sidebar">
            <header class="panel__left__logo">
                <div class="panel__logo">
                    <a title="صفحه اصلی" class="panel__link" href="{{ route('panel.index') }}">
                        <img loading="lazy" class="panel-logo" src="{{ asset('assets/template/assest/logo/mobile-navigation-icon.svg') }}" alt="">
                        <p>Flix Movie</p>
                    </a>
                </div>
            </header>

            <!--sidebar menu section -->
            <menu class="sidebar__menu">
                <div class="user__info">
                    <div class="user__name">
                        <div class="user__profile__img">
                            <img src="{{ env('APP_URL') . 'users/' . auth()->user()->avatar }}" alt="user profile image">
                        </div>
                        <div class="user__info__text">
                            <h1>{{ auth()->user()->name . ' ' . auth()->user()->family }}</h1>
                        </div>
                    </div>
                </div>
                <nav class="user-action-lists">
                    <ul class="admin__actions">
                        <li>
                            <a class="admin__actions__link user__actions__link" href="{{ route('panel.index') }}">
                                <svg version="1.1" viewBox="0 0 512 512">
                                    <g>
                                        <path
                                            d="m498.195312 222.695312c-.011718-.011718-.023437-.023437-.035156-.035156l-208.855468-208.847656c-8.902344-8.90625-20.738282-13.8125-33.328126-13.8125-12.589843 0-24.425781 4.902344-33.332031 13.808594l-208.746093 208.742187c-.070313.070313-.140626.144531-.210938.214844-18.28125 18.386719-18.25 48.21875.089844 66.558594 8.378906 8.382812 19.445312 13.238281 31.277344 13.746093.480468.046876.964843.070313 1.453124.070313h8.324219v153.699219c0 30.414062 24.746094 55.160156 55.167969 55.160156h81.710938c8.28125 0 15-6.714844 15-15v-120.5c0-13.878906 11.289062-25.167969 25.167968-25.167969h48.195313c13.878906 0 25.167969 11.289063 25.167969 25.167969v120.5c0 8.285156 6.714843 15 15 15h81.710937c30.421875 0 55.167969-24.746094 55.167969-55.160156v-153.699219h7.71875c12.585937 0 24.421875-4.902344 33.332031-13.808594 18.359375-18.371093 18.367187-48.253906.023437-66.636719zm0 0">
                                        </path>
                                    </g>
                                </svg>
                                <p>پیشخوان</p>
                            </a>
                        </li>
                        <li>
                            <a class="admin__actions__link user__actions__link" href="{{ route('panel.likedMovies') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512">
                                    <g>
                                        <path
                                            d="m376 43.839c-60.645 0-99.609 39.683-120 75.337-20.391-35.654-59.355-75.337-120-75.337-76.963 0-136 58.945-136 137.124 0 84.771 73.964 142.5 184.413 229.907 54.082 42.761 57.557 46.011 71.587 57.29 11.45-9.205 17.787-14.751 71.587-57.29 110.449-87.407 184.413-145.136 184.413-229.907 0-78.178-59.037-137.124-136-137.124z">
                                        </path>
                                    </g>
                                </svg>
                                <p>علاقه مندی ها</p>
                            </a>
                        </li>
                        <li>
                            <a class="admin__actions__link user__actions__link" href="{{ route('panel.watched') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 511.816 511.816">
                                    <g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path
                                                    d="M20.949,298.483v160c0,29.419,23.936,53.333,53.333,53.333h384c29.419,0,53.333-23.915,53.333-53.333v-160H20.949z">
                                                </path>
                                            </g>
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <polygon
                                                    points="252.757,48.776 172.927,67.72 239.807,166.131 326.271,146.462   ">
                                                </polygon>
                                            </g>
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <polygon
                                                    points="150.741,72.99 64.703,93.384 130.879,190.878 217.471,171.187   ">
                                                </polygon>
                                            </g>
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path
                                                    d="M511.274,93.086l-18.155-68.864c-4.181-16.747-21.333-27.285-38.251-23.424l-71.68,17.024l68.011,100.267l52.117-11.861    c2.837-0.64,5.269-2.411,6.763-4.885S511.999,95.902,511.274,93.086z">
                                                </path>
                                            </g>
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <polygon
                                                    points="360.981,23.091 275.413,43.4 349.055,141.299 428.863,123.144   ">
                                                </polygon>
                                            </g>
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <polygon
                                                    points="128.447,191.838 94.314,277.15 178.005,277.15 212.138,191.838   ">
                                                </polygon>
                                            </g>
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <polygon
                                                    points="235.114,191.838 200.981,277.15 284.671,277.15 318.805,191.838   ">
                                                </polygon>
                                            </g>
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path
                                                    d="M500.949,191.838h-52.501l-34.133,85.333h97.301v-74.667C511.615,196.595,506.858,191.838,500.949,191.838z">
                                                </path>
                                            </g>
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <polygon
                                                    points="341.781,191.838 307.647,277.15 391.317,277.15 425.471,191.838   ">
                                                </polygon>
                                            </g>
                                        </g>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path
                                                    d="M42.517,98.675l-17.387,4.117c-8.469,1.92-15.637,7.061-20.181,14.443c-4.544,7.403-5.888,16.107-3.776,24.533    l19.776,78.165v57.216h50.389l32.021-80.021l5.205-1.173L42.517,98.675z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <p>فیلم های دیده شده</p>
                            </a>
                        </li>
                        <li>
                            <a class="admin__actions__link user__actions__link" href="{{ route('panel.comments') }}">
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
                                <p>نظرات ارسال شده</p>
                            </a>
                        </li>
                        <li>
                            <a class="admin__actions__link user__actions__link" href="{{ route('panel.tickets') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                                </svg>  
                                <p>تیکت ها</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </menu>
            <!--sidebar menu section end -->
        </div>