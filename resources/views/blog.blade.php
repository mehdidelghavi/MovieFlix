@extends("master")
@section('content')
    <!-- Main Body -->
    <main class="main__section" id="index-main-blog">
            <section class="mansory__grid">
                <div class="mansory__grid__cr container">
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($topViews as $topview)
                        <!-- main post container start -->
                        <div class="main__posts__cr" id="main-post-item{{ $i }}">
                            <a style="background: url({{ asset('storage/articles/' . $topview->thumbnail) }}) !important;" data-background="true" class="main__post__cr__link" href="{{ route('blog.article', ['slug'=> $topview->slug]) }}">
                                <button class="read__more__text"><span>ادامه مطلب</span></button>
                                <a href="{{ route('blog.article', ['slug'=> $topview->slug]) }}" class="main__posts__link">{{ $topview->title }}</a>
                            </a>
                        </div>
                        <!-- main post container end -->
                         @php
                         $i++;
                         @endphp
                    @endforeach
                </div>
            </section>

    </main>
<section class="main-body" id="index-main-body">
        <article class="container articles-container">
            <div class="articles-aside">
                <!-- Posts Container -->
                <section id="main-article-container" class="blog-right-aside main-articles">
                    <div class="main-blog-post">
                        <h1 class="last__posts__blog title">آخرین عناوین</h1>

                        <div class="last__posts__container">
                            @foreach ($articles as $article)
                                <!--  -->
                                <div class="last__posts__cr">
                                    <div class="post__comment__length" data-comment-length="تعداد نظرات">
                                        <i class="far fa-comment-dots"></i><span class="comment__length__span">{{ $article->comments()->count() }}</span>
                                    </div>
                                    <div class="last__post__img">
                                        <a href="{{ route('blog.article', ['slug' => $article->slug]) }}" title="{{ $article->title }}">
                                            <img loading="lazy" src="{{ asset('storage/articles/' . $article->thumbnail) }}"
                                                alt="{{ $article->title }}">
                                        </a>
                                    </div>
                                    <div class="last__post__text">
                                        <a href="{{ route('blog.article', ['slug' => $article->slug]) }}">{{ Str::limit($article->title, 30) }}</a>
                                        <p>{{ Str::limit($article->small_text, 100) }}</p>
                                    </div>
                                </div>
                                <!--  -->
                            @endforeach
                            

                        </div>

                    </div>
                    <div style="margin-top: 30px;">
                    {{ $articles->links("vendor.pagination.movies") }}
                    </div>
                </section>
                <!-- Right aside section end-->
                <!-- ---------------------- -->
                <!-- ---------------------- -->
                <!-- ---------------------- -->

                <!-- Main Aside Container -->
                <aside class="main-aside">
                    <section class="aside-section">

                        <!-- blog btn -->


                        <!-- blog tags container -->
                        <div class="blog__sort__list__and__tags__container">

                            <section id="serials-upd" class="blog__tags">
                                <div id="blog__tags__title" class="serial-updates">
                                    <h1 class="serial-updates-title title"><i class="fas fa-tags"></i> تگ های مقالات
                                    </h1>
                                </div>
                                <ul class="blog__tags__container">
                                    @foreach ($tagSelected as $key => $value)
                                    <li><a href="{{ route('blog.articles.tag', ['tag' => $value]) }}">{{ $value }}</a></li>
                                    @endforeach
                                </ul>
                            </section>
                        </div>

                        <section id="most__view__cr" class="most__view__container">

                            <div class="most__view__post">
                                <a href="blog-post2.html" class="most__view__link">
                                    <div class="most__view__img">
                                        <img loading="lazy" src="assest/blog-images/squid-game.jpg" alt="اسکویید گیم">
                                    </div>
                                    <p>چرا سریال بازی مرکب اینقدر معروف شده نقد و بررسی</p>
                                </a>
                            </div>

                            <div class="most__view__post">
                                <a href="#" class="most__view__link">
                                    <div class="most__view__img">
                                        <img loading="lazy" src="assest/blog-images/best-sereis.jpg"
                                            alt="بهترین سریال ها">
                                    </div>
                                    <p>بهترین سریال های معروف نت فلیکس برای تماشا</p>
                                </a>
                            </div>

                            <div class="most__view__post">
                                <a href="#" class="most__view__link">
                                    <div class="most__view__img">
                                        <img loading="lazy" src="assest/blog-images/kate.jpg" alt="فیلم Kate">
                                    </div>
                                    <p>تاریخ اکران فیلم Kate</p>
                                </a>
                            </div>

                            <div class="most__view__post">
                                <a href="#" class="most__view__link">
                                    <div class="most__view__img">
                                        <img loading="lazy" src="assest/blog-images/spider-man.jpg" alt="اسپایدر من">
                                    </div>
                                    <p>تاریخ اکران فیلم مرد عنکبوتی راهی به خانه نیست</p>
                                </a>
                            </div>

                        </section>
                </aside>
                <!-- aside end -->
            </div>
        </article>
    </section>
    <!-- main body end -->
@endsection
