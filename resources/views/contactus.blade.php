@extends('master')
@section('content')
<section id="index-req-post" class="req__posts__container ">
    <div class="req__posts container">

        <!-- requament post links -->
        <div class="requament__links">
            <div class="req__posts__links">
                <h1>فهرست</h1>
                <div class="req__post__link">
                    <a href="reqs/addAudioToFilm.html"><i class="fa fa-external-link-alt"></i> آموزش اضافه کردن صدا
                        به فیلم با استفاده از
                        MKVToolNix GUI</a>
                </div>
                <div class="req__post__link">
                    <a href="reqs/kmplayer.html"><i class="fa fa-external-link-alt"></i> دانلود برنامه KMPlayer</a>
                </div>
                <div class="req__post__link">
                    <a href="reqs/videoformats.html"><i class="fa fa-external-link-alt"></i> راهنمای فرمت های
                        ویدیویی</a>
                </div>

            </div>

            <a class="contact__us__btn" href="contactus.html" target="_blank">تماس با ما</a>
        </div>

        <!-- requament text box -->
        <div class="req__posts__text">
            <div class="post__text__cr video__formats">
                <h1>تماس با ما</h1>
                <p>از طریق صفحه فوق میتوانید با ما در ارتباط باشید و انتقادات و پیشنهادات خود را ارائه دهید.
                </p>

                <div class="form-control-container">
                    <form action="{{ route('index.contactus.send') }}" method="POST" id="contact-us-form" class="contact__us__form">
                        @csrf
                        <div class="form-control">
                            <input id="contact-us-name" name="name" type="text" autocomplete="on"
                                required="required" value="{{ old('name') }}">
                            <span class="contact-us-line"></span>
                            <label>نام </label>

                        </div>
                        <div class="form-control">
                            <input id="contact-us-email" name="email" type="email" autocomplete="on"
                                required="required" value="{{ old('email') }}">
                            <span class="contact-us-line"></span>
                            <label>ایمیل </label>

                        </div>
                        <div class="form-control">
                            <textarea id="contact-us-text" name="text" required="required">{{ old('text') }}</textarea>
                            <span class="contact-us-line"></span>
                            <label>پیام شما </label>
                        </div>

                        <div class="form-control btn-form-cr">
                            <button type="submit" id="contactus-btn"><span>ارسال</span></button>
                        </div>

                        <div class="err__box">
                            <p>فرم نام خالی مباشد.</p>
                            <p>فرم ایمیل خالی می باشد.</p>
                            <p>فرم پیام ارسالی خالی مباشد.</p>
                        </div>
                    </form>

                    <div class="movie-png__container">
                        <img loading="lazy" src="{{ asset('assets/template/assest/images/backgrounds/globe.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
