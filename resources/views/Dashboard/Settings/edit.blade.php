@extends('Dashboard.master')
@section("CSS")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/formvalidation/dist/css/formValidation.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/toastr/toastr.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/animate-css/animate.css") }}">
@endsection
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">ویرایش تنظیمات</span>
            </h4>

            <div class="row d-flex justify-content-center">

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <!-- HTML5 Inputs -->
                    <div class="card mb-4">
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
                        <h5 class="card-header heading-color">ویرایش تنظیمات</h5>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-solid-danger alert-dismissible d-flex align-items-center" role="alert">
                              <i class="bx bx-xs bx-store me-2"></i>
                                @foreach ($errors->all() as $error)
                                  {{ $error }}<br>
                                @endforeach
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <form class="form-repeater" action="{{ route('dashboard.settings.update') }}" method="post">
                              @csrf
                              <div data-repeater-list="group-a">
                                  @foreach ($settings->options as $key => $value)
                                  <div data-repeater-item>
                                  <div class="row">
                                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                      <label class="form-label" for="form-repeater-1-1">عنوان</label>
                                      <input type="text" id="form-repeater-1-1" class="form-control text-start" name="title" placeholder="عنوان" dir="ltr" value="{{ $key }}">
                                    </div>
                                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                      <label class="form-label" for="form-repeater-1-2">مقدار</label>
                                      <input type="text" id="form-repeater-1-2" class="form-control text-start" name="value" placeholder="مقدار" dir="ltr" value="{{ $value }}">
                                    </div>
                                    <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                      <button class="btn btn-label-danger mt-4" data-repeater-delete type="button">
                                        <i class="bx bx-x me-1"></i>
                                        <span class="align-middle">حذف</span>
                                      </button>
                                    </div>
                                  </div>
                                  <hr>
                                  </div>
                                  @endforeach
                              </div>
                              <div class="mb-0">
                                <button class="btn btn-danger" data-repeater-create type="button">
                                  <i class="bx bx-plus me-1"></i>
                                  <span class="align-middle">بیشتر</span>
                                </button>
                              </div>
                              <div class="d-grid gap-2 col-12 mx-auto mt-4">
                                  <button type="submit" class="btn btn-primary">
                                    <span class="tf-icons bx bx-plus me-1"></span>ثبت
                                  </button>
                                </div>
                            </form>
                        </div>
                    </div>
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
<script src="{{ asset("assets/vendor/libs/cleavejs/cleave.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/cleavejs/cleave-phone.js") }}"></script>
<script src="{{ asset("assets/js/forms-extras.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/tagify/tagify.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js") }}"></script>
<script src="{{ asset("assets/js/form-validation.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/toastr/toastr.js") }}"></script>
<script src="{{ asset("assets/js/ui-toasts.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/jquery-repeater/jquery-repeater.js") }}"></script>
@endsection