@extends('master')
@section('metaHeader')
<meta name="cmLikeRoute" content="{{ route('index.cm.likes', ['slug' => $article->slug]) }}">
@endsection
@section('content')
<main id="index-blog-post" class="blog-post-main-container">
        <section class="blog-post-container container">

            <!-- blog post btns -->
            <div class="blog__post__btn__container">
                <ul class="blog__post__btns">
                    <li>
                        <a href="#writer-info"><i class="fa fa-user"></i>
                            <span class="sticky-buttons-tooltip">درباره نویسنده</span>
                        </a>
                    </li>
                    <li>
                        <a href="#share-post-navigation"><i class="fas fa-share-alt"></i>
                            <span class="sticky-buttons-tooltip">اشتراک گذاری</span>
                        </a>
                    </li>
                    <li>
                        <a id="blog-post-related-link" href="#blog-post-related"><i class="fas fa-ellipsis-h"></i>
                            <span class="sticky-buttons-tooltip">مطالب مرتبط</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="blog__post__main__section">
                <div class="blog__post__info">
                    <div class="blog__post__img">
                        <img loading="lazy" src="{{ asset('storage/articles/' . $article->thumbnail) }}" alt="{{ $article->title }}">
                    </div>
                    <h1 class="title blog__post__title">{{ $article->title }}</h1>
                    <div class="blog__post__infography">
                        <li><i class="fa fa-user"></i> <span>{{ $article->author->name . " " . $article->author->family }}</span></li>
                        <li><i class="fa fa-pen"></i> <span>{{ Morilog\Jalali\Jalalian::forge($article->updated_at)->format("%B %d، %Y") }}  </span></li>
                        <li><i class="fas fa-clock"></i> <span>{{ Morilog\Jalali\Jalalian::forge($article->updated_at)->format("H:i") }}</span></li>
                    </div>

                    <div class="article__body">
                        {!! $article->text !!}
                    </div>

                    <!-- article tags and share buttons footer -->
                    <div class="article__tag__share">
                        <div class="article__tags">
                            <p>برچسب ها :</p>
                            <ul class="blog__tags__container">
                                @for ($i = 0;$i<=count($article->tags) - 1;$i++)
                                    <li><a href="{{ route('blog.articles.tag', ['tag'=> $article->tags[$i]]) }}">{{ $article->tags[$i] }}</a></li>
                                @endfor
                            </ul>
                        </div>

                        <div id="share-post-navigation" class="article__share">
                            <ul data-share-tooltip="اشتراک گذاری پست" class="article__share__nav">
                                <li>
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-telegram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- article tags and share buttons footer -->
                </div>

                <!-- writer info section -->
                <div id="writer-info" class="writer__info">
                    <div class="write__info__box">
                        <div class="writer__img__container">
                            <span class="best__writer__badge"><i>i</i></span>
                            <img loading="lazy" src="{{ env("APP_URL") . "storage/users/" . $article->author->avatar }}" alt="{{ $article->author->name . ' ' . $article->author->family }}">
                        </div>
                        <div class="writer__text">
                            <h1 class="title">{{ $article->author->name . " " . $article->author->family }}</h1>
                            <p>
                                {{ $article->author->about }}
                            </p>
                        </div>
                    </div>
                    <div class="writer__post__links">
                        <a href="{{ route('blog.article.author', ['user' => $article->author->id]) }}" title="همه مطالب نویسنده">همه مطالب نویسنده</a>
                    </div>
                </div>
                <!-- writer info section end-->

                <!-- blog comment section start -->
                <div class="blog__comments__container comments__container__class">
                    <!-- post comments container and form -->
                    <div class="comments__inner__cr">
                        <div class="cm__title__btn">
                            <h1 id="comments__length" class="comments__length"><i class="fas fa-comment-dots"></i> {{ count($article->comments) }}
                                دیدگاه</h1>
                            <button class="add__comment__btn green-badge " id="addComment"><i class="fa fa-plus"></i>
                                <span>افزودن
                                    دیدگاه</span></button>
                        </div>

                        <!-- post comment section -->
                        <form id="post__cm__form" method="post" action="{{ route('blog.article.sendcomment', ['type' => 'article','id' => $article->id]) }}" class="comment__below__form">
                            @csrf
                            <!-- post comment animation after submit -->
                            <div class="PostComment__Animation">
                                <div class="loader-parent postcm__animation">
                                    <div class="loader-bg">
                                        <div class="mid-circle"></div>
                                        <div class="loader-circle-2"></div>
                                        <div class="loader-circle-2"></div>
                                        <div class="loader-circle-2"></div>
                                        <div class="loader-circle-2"></div>
                                    </div>
                                </div>
                            </div>
                            <label class="add__comment__label" for="add-comment-input">دیدگاهتان را بنویسید</label>
                            <div class="replyBox">
                                <div class="replyUser">
                                    <i class="fa fa-reply"></i>
                                    <span id="replyUserInfo"></span>
                                </div>
                                <div class="replyRemove">
                                    <i class="fa fa-close"></i>
                                </div>
                            </div>
                            <input type="text" name="comment_id" value="0" id="reply" hidden>
                            <div class="comment__form__control">
                                <textarea spellcheck="false" class="add_cm__input" name="text"
                                    id="add-comment-input" cols="30" rows="3" placeholder="این فیلم چه طور بود؟"
                                    required="required"></textarea>
                            </div>

                            <div class="auther__email__btn">
                                <div class="comment__form__control">
                                    <input id="auther" type="text" name="name" placeholder="نام شما"
                                        maxlength="100" minlength="4" required="required" @if (auth()->check()) value="{{ auth()->user()->name . ' ' . auth()->user()->family }}" readonly @endif>
                                    <span id="UserNameErr"></span>
                                </div>

                                <div class="comment__form__control">
                                    <input id="email" type="email" name="email" placeholder="ایمیل"
                                        maxlength="100" minlength="4" required="required" @if (auth()->check()) value="{{ auth()->user()->email }}" readonly @endif>
                                    <span id="UserEmailErr"></span>
                                </div>

                                <div class="comment__form__control">
                                    <input id="submit__comment" type="submit" name="submitbtn" value="فرستادن دیدگاه">
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- all comments container -->
                    <div class="allComments__cr">
                        @foreach ($comments as $comment)
                        <div class="comment__cr">
                            <div class="CommentReply" >
                                <a href="#comments__length" class="replyButton" data-commentid="{{ $comment->id }}" data-userinfo="{{ $comment->user->name . " " . $comment->user->family }}">
                                    <i class="fa fa-reply"></i>
                                </a>
                            </div>
                            <div class="WrapCmDiv">
                                <div class="DateNameIcon__cr"><i class="fas fa-user Comment__user__icon"></i>
                                    <p class="Comment__user__name">
                                        @if ($comment->user_id != null)
                                        {{ $comment->user->name . " " . $comment->user->family }}
                                        @else 
                                        {{ $comment->name }}
                                        @endif
                                    </p><span
                                        class="Comment__date__cr">{{ Morilog\Jalali\Jalalian::forge($comment->created_at)->format("Y-m-d H:i") }}</span>
                                </div>
                                <div class="LikeDislike__cr">
                                    <div title="پسندیدم" class="cm_like_btn" data-commentID="{{ $comment->id }}" data-reaction="1">
                                        <i class="fa fa-thumbs-up"></i>
                                        <span id="cmLikeCounter-{{ $comment->id }}" @if ($comment->user_reaction != null && $comment->user_reaction == 1) class="text-green" @endif>
                                            {{ $comment->likes_count }}
                                        </span>
                                    </div>
                                    <div title="نپسندیدم" class="cm_dislike_btn" data-commentID="{{ $comment->id }}" data-reaction="-1">
                                        <i class="fa fa-thumbs-down"></i>
                                        <span id="cmDisLikeCounter-{{ $comment->id }}" @if ($comment->user_reaction != null && $comment->user_reaction == -1) class="text-red" @endif>
                                            {{ $comment->dislikes_count }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="CommentTextCr" @if (count($comment->replies) > 0 ) style="margin-bottom: 1.4rem" @endif>
                                <p>{{ $comment->text }}</p>
                            </div>
                            @if (count($comment->replies) > 0)
                                @foreach ($comment->replies as $replies)
                                    <div class="comment__cr">
                                        <div class="WrapCmDiv">
                                            <div class="DateNameIcon__cr"><i class="fas fa-user Comment__user__icon"></i>
                                                <p class="Comment__user__name">
                                                    {{ $replies->user->name . " " . $replies->user->family }}
                                                </p><span
                                                    class="Comment__date__cr">{{ Morilog\Jalali\Jalalian::forge($replies->created_at)->format("Y-m-d H:i") }}</span>
                                            </div>
                                        </div>
                                        <div class="CommentTextCr">
                                            <p>{{ $replies->text }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @endforeach

                        <!-- all comments container -->
                        <div id="allComments"></div>
                    </div>
                    {{ $comments->links("vendor.pagination.movies") }}
                </div>
                <!-- blog comment section end -->
            </div>

            <!-- blog aside start -->
            <div class="blog__post__aside">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24"
                    style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <g xmlns="http://www.w3.org/2000/svg" id="Layer_5" data-name="Layer 5">
                            <path
                                d="m21.0127 4.0166a.9944.9944 0 0 0 -1.166.8013 7.5315 7.5315 0 0 1 -2.4922 4.4184 7.4464 7.4464 0 0 1 -3.5322 1.64 1 1 0 0 0 .1767 1.9837.971.971 0 0 0 .1787-.0161 9.5477 9.5477 0 0 0 4.4688-2.0811 9.5023 9.5023 0 0 0 3.167-5.5806 1 1 0 0 0 -.8008-1.1656z"
                                fill="#6898f8" data-original="#5cfaa9" class="path1"></path>
                            <path
                                d="m9.95 10.8613a8.3123 8.3123 0 0 0 -8.0889 8.09 1.0009 1.0009 0 0 0 .95 1.0478l.05.001a1.0005 1.0005 0 0 0 .9981-.9512 6.3139 6.3139 0 0 1 6.19-6.19 1 1 0 0 0 .9492-1.0479.9734.9734 0 0 0 -1.0484-.9497z"
                                fill="#6898f8" data-original="#5cfaa9" class="path2"></path>
                            <g fill="#212529">
                                <path
                                    d="m13 9h-2a2.0023 2.0023 0 0 0 -2 2v2a2.0023 2.0023 0 0 0 2 2h2a2.0023 2.0023 0 0 0 2-2v-2a2.0023 2.0023 0 0 0 -2-2zm-2 4v-2h2l.001 2z"
                                    fill="#1c1c22" data-original="#212529" class="path3"></path>
                                <path
                                    d="m22 0h-2a2.0023 2.0023 0 0 0 -2 2v2a2.0023 2.0023 0 0 0 2 2h2a2.0023 2.0023 0 0 0 2-2v-2a2.0023 2.0023 0 0 0 -2-2zm-2 4v-2h2l.001 2z"
                                    fill="#1c1c22" data-original="#212529" class="path4"></path>
                                <path
                                    d="m4 18h-2a2.0023 2.0023 0 0 0 -2 2v2a2.0023 2.0023 0 0 0 2 2h2a2.0023 2.0023 0 0 0 2-2v-2a2.0023 2.0023 0 0 0 -2-2zm-2 4v-2h2l.001 2z"
                                    fill="#1c1c22" data-original="#212529" class="path5"></path>
                            </g>
                        </g>
                    </g>
                </svg>

                <h1 id="blog-post-related" class="title">مطالب مرتبط </h1>

                @foreach ($relatedArticles as $rArticle)
                <!-- related article post -->
                <div class="related__posts">
                    <div data-image-hover-effect class="post-related-img">
                        <a href="{{ route('blog.article', ['slug'=> $rArticle->slug]) }}" class="related__post__img">
                            <img loading="lazy" src="{{ asset('articles/' . $rArticle->thumbnail) }}" alt="{{ $rArticle->title }}">
                        </a>
                    </div>

                    <div class="related__post__info">
                        <a href="{{ route('blog.article', ['slug'=> $rArticle->slug]) }}">{{ $rArticle->title }}</a>
                        <div class="related__post__date__time">
                            <time>{{ Morilog\Jalali\Jalalian::forge($rArticle->updated_at)->format('%B %d، %Y') }}</time>
                            <time>{{ Morilog\Jalali\Jalalian::forge($rArticle->updated_at)->format('H:i') }}</time>
                        </div>
                    </div>
                </div>
                <!-- post related article end -->
                @endforeach
            </div>
        </section>
    </main>
@endsection
@section('js')
<script src="{{ asset("assets/template/js/blog.js") }}"></script>
<script src="{{ asset("assets/template/js/comments.js") }}"></script>
@endsection