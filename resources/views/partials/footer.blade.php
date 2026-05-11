<!-- footer start here -->
<footer id="index-footer" class="footer">

<!-- footer requament section -->
<section class="footer-section container">
    @if (isset($requirements))
        <div class="footer-right-aside">
        @foreach ($requirements as $requirement)
            <div class="req-software">
                <div class="footer-box yellow-box">
                    <i class="{{ $requirement->icon }}"></i>
                </div>
                <div class="footer-text">
                    <a href="{{ route('index.requirements', ['slug' => $requirement->slug]) }}">پیش نیاز ها</a>
                    <a href="{{ route('index.requirements', ['slug' => $requirement->slug]) }}">{{ Str::limit($requirement->title,30) }} <i
                            class="fas fa-long-arrow-alt-left"></i></a>
                </div>
            </div>
        @endforeach
    </div>
    @endif

    <div class="footer-left-aside">
        @if (array_key_exists('instagram', $settings->options))
            <a href="https://instagram.com/{{ $settings->options['instagram'] }}" class="instagram">
                <div class="social-icons ">
                    <p class="social-text">
                        <i class="fab fa-instagram"></i> <span>صفحه اینستاگرام</span>
                    </p>
                    <p class="arrow-social">
                        <i class="fa fa-angle-left"></i>
                    </p>
                </div>
            </a>
        @endif

        @if (array_key_exists('telegram', $settings->options))
            <a href="https://t.me/{{ $settings->options['telegram'] }}" class="telegram">
                <div class="social-icons ">
                    <p class="social-text">
                        <i class="fab fa-telegram-plane"></i> <span>کانال تلگرام</span>
                    </p>
                    <p class="arrow-social">
                        <i class="fa fa-angle-left"></i>
                    </p>
                </div>
            </a>
        @endif
    </div>
</section>
<!-- footer requament end -->
<!-- -------------------- -->
<!-- -------------------- -->

<!-- main footer section start here -->
<section class="footer-bg">

    <!-- change footer background btn-->
    <button id="change-footer-bg"><i class="fas fa-photo-video"></i></button>

    <div class="footer-nav container">
        <div class="footer-logo-container">
            <p class="footer-logo-text"><i>F</i>lix <i>M</i>ovie </p>
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
                                        fill="url(#SVGID_1_)" data-original="url(#SVGID_1_)"
                                        style="fill: auto;"> />
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
        <div class="footer-nav-links">
            <h1 class="footer-nav-link-title">ناوبری</h1>
            <ul>
                @foreach ($lists as $list)
                    <li><a href="{{ route('index.category', ['category' => $list->slug]) }}">{{ $list->title }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="footer-nav-links">
            <h1 class="footer-nav-link-title">لینک های مفید</h1>
            <ul>
                <li><a href="{{ route('blog.index') }}">نقد و بررسی فیلم</a></li>
                <li><a href="{{ route('index.plans') }}">اشتراک ویژه</a></li>
            </ul>
        </div>
        <div class="footer-nav-links">
            <h1 class="footer-nav-link-title">لینک های مفید</h1>
            <ul>
                <li><a href="{{ route('index.contactus') }}">تماس باما</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-second-nav container">
        <div class="form-control">
            <p>از اخبار سینما با خبر شوید.</p>
            <form id="newsletter-inp" name="newsletter-inp" action="{{ route('index.newsletter') }}" method="POST">
                <button class="newsletter-btn"></button>
                <input placeholder="ایمیل" type="email" name="newsletter" id="newsletter" autocomplete="on"
                    spellcheck="false">
                <div class="newsletter-err">
                    <p></p>
                </div>
            </form>
        </div>
        <div class="socials">
            <ul>
                @if (array_key_exists('telegram', $settings->options))
                    <div class="socials-cr">
                        <a href="https://t.me/{{ $settings->options['telegram'] }}"><i class="fab fa-telegram-plane"></i></a>
                    </div>
                @endif
                @if (array_key_exists('twitch', $settings->options))
                    <div class="socials-cr">
                        <a href="https://twitch.com/{{ $settings->options['twitch'] }}"><i class="fab fa-twitch"></i></a>
                    </div>
                @endif
                @if (array_key_exists('youtube', $settings->options))
                    <div class="socials-cr">
                        <a href="https://youtube.com/{{ $settings->options['youtube'] }}"><i class="fab fa-youtube"></i></a>
                    </div>
                @endif
                @if (array_key_exists('instagram', $settings->options))
                    <div class="socials-cr">
                        <a href="https://instagram.com/{{ $settings->options['instagram'] }}"><i class="fab fa-instagram"></i></a>
                    </div>
                @endif
            </ul>
        </div>
    </div>

    <div class="copy-right">
        @if (array_key_exists('footer_text', $settings->options))
            {!! $settings->options['footer_text'] !!}
        @else
            <p>تمامی حقوق برای سایت <span>فلیکس مووی</span> محفوظ می باشد.</p>
        @endif
    </div>

    <section class="next-movie">
        <p>بازگشت به بالا</p>
        <a id="gotop"><button><i class="fas fa-angle-up"></i></button></a>
    </section>
</section>
<!-- main footer section end-->
</footer>
<!-- footer end -->
<!-- ---------- -->
<!-- ---------- -->

<!-- Script Include -->
<script src="{{ asset('assets/template/js/app.js') }}"></script>
<script src="{{ asset('assets/template/js/SearchFilter.js') }}"></script>
@yield('js')
<!-- Scripts Include end-->
</body>

</html>