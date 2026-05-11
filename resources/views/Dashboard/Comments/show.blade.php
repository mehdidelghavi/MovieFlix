@extends('Dashboard.master')
@section("CSS")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/animate-css/animate.css") }}">
@endsection
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">نمایش نظرات /</span> لیست نظرات
            </h4>

            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-12">
                  <div class="card mb-2" id="page-block">
                    <h5 class="card-header heading-color">نمایش نظر</h5>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-desktop me-2"></i>موفقیت!</h6>
                            <span>{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('failed'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-desktop me-2"></i>خطا!</h6>
                            <span>{{ session('failed') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                      <small class="text-light fw-semibold">
                        @if ($comment->user_id != null)
                            <a href="{{ route('dashboard.users.edit', ['user' => $comment->user_id]) }}">{{ $comment->name }}</a>
                        @else
                            {{ $comment->name }}
                        @endif
                        {{ $comment->email }}
                      </small>
                      <figure class="text-center mt-2">
                        <blockquote class="blockquote">
                          <p class="mb-0">
                            {{ $comment->text }}
                          </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                          ایجاد شده در تاریخ <cite>{{ Morilog\Jalali\Jalalian::forge($comment->created_at)->format('%A, %d %B %Y | H:i:s')}}</cite>
                        </figcaption>
                      </figure>
                    </div>
                    
                  </div>

                </div>
                <div class="row">
                    <div class="d-grid gap-2 col-lg-6 mx-auto">
                        @if ($comment->verified == 0)
                            <a href="{{ route('dashboard.comments.verify', ['comment' => $comment->id]) }}">
                                <button class="btn btn-success btn-lg" type="button" style="width: 100%"><i class="tf-icons bx bx-check me-1"></i>تایید و انتشار</button>
                            </a>
                        @endif
                        <a href="{{ route('dashboard.comments.destroy', ['comment' => $comment->id]) }}">
                            <button class="btn btn-danger btn-lg" type="button" style="width: 100%"><i class="tf-icons bx bx-trash-alt me-1"></i>حذف نظر</button>
                        </a>
                    </div>
                </div>
                <div class="row mt-5">
                    @if (count($comment->replies ) > 0)
                        @foreach ($comment->replies as $replies)
                            <div class="col-xl-3 col-md-4 col-sm-12">
                                <div class="card mb-2" id="page-block">
                                    <div class="card-body">
                                    <small class="text-light fw-semibold">
                                        <a href="{{ route('dashboard.users.edit', ['user' => $replies->user_id]) }}">{{ $replies->user->name . " " . $replies->user->family }}</a>
                                    </small>
                                    <figure class="text-center mt-2">
                                        <blockquote class="blockquote">
                                        <p class="mb-0">
                                            {{ $replies->text }}
                                        </p>
                                        </blockquote>
                                        <figcaption class="blockquote-footer">
                                        ایجاد شده در تاریخ <cite>{{ Morilog\Jalali\Jalalian::forge($replies->created_at)->format('%A, %d %B %Y | H:i:s')}}</cite>
                                        </figcaption>
                                    </figure>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="d-grid gap-2 col-lg-6 mx-auto">
                                        @if ($replies->verified == 0)
                                            <a href="{{ route('dashboard.comments.verify', ['comment' => $comment->id, 'reply' => $replies->id]) }}">
                                                <button class="btn btn-success" type="button" style="width: 100%"><i class="tf-icons bx bx-check me-1"></i>تایید</button>
                                            </a>
                                        @endif
                                        <a href="{{ route('dashboard.comments.destroy', ['comment' => $comment->id, 'reply' => $replies->id]) }}">
                                            <button class="btn btn-danger" type="button" style="width: 100%"><i class="tf-icons bx bx-trash-alt me-1"></i>حذف نظر</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-fluid d-flex flex-wrap justify-content-between py-3 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    طراحی شده با ❤️ ارائه شده در وب‌سایت
                    <a href="https://rtl-theme.com" target="_blank" class="footer-link fw-semibold">راست‌چین</a>
                </div>
                <div>
                    <a href="https://rtl-theme.com" class="footer-link me-4" target="_blank">لایسنس</a>
                    <a href="https://rtl-theme.com" target="_blank" class="footer-link me-4">قالب‌های بیشتر</a>

                    <a href="https://v3dboy.ir/previews/html/frest/documentation" target="_blank"
                        class="footer-link me-4">مستندات</a>

                    <a href="https://rtl-theme.com" target="_blank"
                        class="footer-link d-none d-sm-inline-block">پشتیبانی</a>
                </div>
            </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
@section("JS")
<script src="{{ asset("assets/js/ui-toasts.js") }}"></script>
@endsection