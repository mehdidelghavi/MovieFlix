@extends('master')
@section('content')
<section class="main-body top-choises-blog" id="index-main-body">
        <article class="container articles-container">
            <div class="articles-aside">
                <!-- Posts Container -->
                <section id="main-article-container" class="top-choises-articles-blog main-articles">
                    <div class="main-blog-post">
                        <div class="last__posts__container">

                            @foreach ($articles as $article)
                            <!--  -->
                            <div class="last__posts__cr">
                                <div class="post__comment__length" data-comment-length="تعداد نظرات">
                                    <i class="far fa-comment-dots"></i><span class="comment__length__span">{{ $article->comments()->count() }}</span>
                                </div>
                                <div class="last__post__img">
                                    <a href="{{ route('blog.article', ['slug' => $article->slug]) }}" title="{{ $article->title }}">
                                        <img loading="lazy" src="{{ asset('storage/articles/' . $article->thumbnail) }}" alt="{{ $article->title }}">
                                    </a>
                                </div>
                                <div class="last__post__text">
                                    <a href="{{ route('blog.article', ['slug' => $article->slug]) }}">{{ Str::limit($article->title, 30) }}</a>
                                    <p>{{ Str::limit($article->small_text, 100) }}</p>

                                </div>

                                <!-- post readmore btn and date time  -->
                                <div class="read__more__button">
                                    <a href="{{ route('blog.article', ['slug' => $article->slug]) }}">ادامه مطلب</a>
                                </div>

                                <time class="post__date__time">
                                    <p>{{ Morilog\Jalali\Jalalian::forge($article->updated_at)->format("%d %B، %Y") }} <span>/</span> {{ Morilog\Jalali\Jalalian::forge($article->updated_at)->format("H:i") }}</p>
                                </time>
                            </div>
                            <!--  -->
                            @endforeach


                        </div>

                    </div>
                        <!-- pagination -->
                        <div style="margin-top: 30px;">
                            @if ($articles->links())
                                {{ $articles->links("vendor.pagination.movies") }}
                            @endif
                        </div>
                </section>
                <!-- Right aside section end-->
                <!-- ---------------------- -->
                <!-- ---------------------- -->
                <!-- ---------------------- -->

            </div>
        </article>
    </section>
@endsection