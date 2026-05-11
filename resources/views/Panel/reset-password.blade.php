<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#6898f8">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#0f0f0f">
    <title>پنل ادمین - فلیکس مووی</title>


    <link rel="icon" href="{{ asset('assets/template/assest/logo/film.ico') }}"> <!-- Favicon -->

    <!-- fontawesome -->
    <link rel="icon" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/template/css/main.css') }}">

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@700&display=swap" rel="stylesheet">
</head>

<body class="panel">
    <section class="panel-form-container">
        <div class="panel-form-inner">
            <div class="panel-form-control">
                <div class="form-logo">
                    <img loading="lazy" src="{{ asset('assets/template/assest/logo/mobile-navigation-icon.svg') }}" alt="">
                </div>

                <h1> ایجاد رمز عبور جدید </h1>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
                        <i class="bx bx-xs bx-store me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
                        <i class="bx bx-xs bx-store me-2"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                <form id="user-login" name="user-login" action="{{ route('panel.password.update') }}" class="panel-form" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ request('email') }}" required>
                    <div class="form-control">
                        <input type="password" required="required" id="password" name="password">
                        <label class="form-legend" for="password">رمز عبور</label>
                    </div>
                    <div class="form-control">
                        <input type="password" required="required" id="password_confirmation" name="password_confirmation">
                        <label class="form-legend" for="password_confirmation">تایید رمز عبور</label>
                    </div>
                    <button class="submit-authentication" type="submit" id="submit-auth">بازیابی</button>

                <div class="beam"></div>
                </form>
            </div>

            <div class="panel-form-img">
                <img loading="lazy" id="panel-thumb" src="{{ asset('assets/template/assest/images/icons/Mobile login-bro.svg') }}" alt="">
            </div>
        </div>

        <div class="sending-animation">
            <?xml?>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering: auto;
                height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <path fill="none" stroke="#5facfa" stroke-width="8"
                    stroke-dasharray="42.76482137044271 42.76482137044271"
                    d="M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z"
                    stroke-linecap="round" style="transform:scale(0.8);transform-origin:50px 50px">
                    <animate attributeName="stroke-dashoffset" repeatCount="indefinite" dur="1s" keyTimes="0;1"
                        values="0;256.58892822265625"></animate>
                </path>
            </svg>
        </div>
    </section>

    <!-- scripts -->
    <script src="{{ asset('assets/template/js/panel-auth.js') }}"></script>
</body>

</html>