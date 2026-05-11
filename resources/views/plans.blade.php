@extends('master')
@section('content')
<section class="main-body top-choises-blog" id="index-main-body">
        <article class="container articles-container">
            <p class="p-title">خرید اشتراک</p>
            <div class="articles-aside">
                <!-- Posts Container -->
                <section id="imdb-cr" class="top-choises-articles-blog main-articles">
                    <div class="main-blog-post">
                        @if (isset($success))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-desktop me-2"></i>موفقیت!</h6>
                                <span>{{ $success }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (isset($failed))
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-desktop me-2"></i>اخطار!</h6>
                                <span>{{ $failed }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="last__posts__container">
                            @foreach ($plans as $plan)
                                <div class="last__posts__cr">
                                    <div class="last__post__text">
                                        <h4 class="yl-hover p-2">{{ $plan->title }}</h4>
                                        <p>{{ $plan->about }}</p>
                                        <h4 class="yl-hover p-2">{{ $plan->duration }} روزه </h4>
                                    </div>
                                    <div class="subescriptionPrice">
                                        {{ number_format($plan->price) }} تومان
                                    </div>
                                    <a href="{{ route('index.checkout', ['plan' => $plan->id]) }}" class="link-btn badge yellow-badge">
                                        خرید
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </article>
</section>
<!-- main body end -->
@endsection