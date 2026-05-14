<!-- Project Name : FlixMovie -->
<!-- Version : 1.0 -->
<!-- Created Data : 2021/09/16 | 1400/06/25 -->
<!-- Created By : Mahdi Illusion -->
<!-- All rights reserved -->

<html dir="rtl" lang="fa-IR" locale="IRAN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="keywords" content="MovieFlix Movie Theme">
    <meta name="locale" content="fa_IR">
    <meta name="url" content="https://FlixMovie.bmdec.ir">
    <meta name="type" content="movie theme">
    <meta name="author" content="Admin">
    <meta name="engineer" content="Mahdi Rostami">
    <meta name="owner" content="Admin">
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#6898f8">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#0f0f0f">
    <!-- description -->
    {!! SEO::generate() !!}
    <link rel="icon" href="{{ asset('assets/template/assest/logo/film.ico') }}"> <!-- Favicon -->

    <!-- Fontawesome -->
    <link rel="icon" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- video js links -->
    <link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

    <!-- Css Include -->
    <link rel="stylesheet" href="{{ asset('assets/template/css/main.css') }}">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@700&display=swap" rel="stylesheet">
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
    </script>

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
    @php
        $moviePath = "movies/" . str_replace(" ", "", $movie->title[1]) . "/"; 
    @endphp
    <div class="full__page__video">
        <video id="video-js" class="video-js vjs-big-play-centered" data-setup="{}"
            src="{{ asset($moviePath . 'trailer/' .$movie->trailer) }}" preload="auto" controls
            poster="{{ env('APP_URL') . "storage/movies/" . str_replace(" " ,"", $movie->title[1]) . "/thumbnail/" . $movie->thumbnail }}">
            @php
                $filename = $quality->url;
            @endphp
            @if ($movie->type == "movie")
                @php
                    $path = 'storage/movies/' . str_replace(" ","", $movie->title[1]) . '/' .$filename ;
                @endphp
                @else
                @php
                    $path = 'storage/movies/' . str_replace(" ","", $movie->title[1]) . "/seasons/" . $season->number . "/" . $filename;
                @endphp
            @endif
            <source src="{{ route('index.movie.stream', ['path' => $path]) }}" type="video/{{ $quality->format }}" label="{{ $quality->quality }}" res="{{ $quality->quality }}">
        </video>

        <div class="logo__on__video">
            <div class="desktop-logo-container">
                <a href="../index.html">
                    <svg class="desktop-logo" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1"
                        width="512" height="512" x="0" y="0" viewBox="0 0 512 512"
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
            <h1>فلیکس مووی</h1>
        </div>
    </div>

    <!-- video js player -->
    <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
    <!-- babel or webpack usage -->
    <!-- <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script> -->
    <script src="{{ asset('assets/template/js/app.js') }}"></script>
    <script>
        var player = videojs('video-js');
        player.on('loadedmetadata', function() {

            let savedTime = {{ $progress }};

            if (savedTime > 0) {
                player.currentTime(savedTime);
            }

        });
        function saveProgress() {
            let currentTime = Math.floor(player.currentTime());
            fetch("{{ route('index.movie.watch.progress') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    episode_id: {{ $episode->id }},
                    progress: currentTime
                })
            })
        }

        // وقتی pause شد
        player.on('pause', saveProgress);

        // وقتی ویدیو تموم شد
        player.on('ended', saveProgress);

        // وقتی کاربر صفحه رو بست
        window.addEventListener('beforeunload', saveProgress);
    </script>
    <!-- <script src="js/SearchFilter.js"></script> -->
    <!-- <script src="js/pagination.js"></script> -->
    <!-- Scripts Include end-->
</body>

</html>