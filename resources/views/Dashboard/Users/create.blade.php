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
                <span class="text-muted fw-light">کاربران /</span> کاربر جدید
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
                        <h5 class="card-header heading-color">کاربر جدید</h5>
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
                            <form action="{{ route("dashboard.users.store") }}" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="input-group mb-3">
                                  <span class="input-group-text">نام و نام خانوادگی</span>
                                  <input type="text" value="{{ old('name') }}" aria-label="First name" id="bs-validation-name" placeholder="نام" name="name" class="form-control" required>
                                  <input type="text" value="{{ old('family') }}" aria-label="Last name" id="bs-validation-lastname" placeholder="نام خانوادگی" name="family" class="form-control" required>
                                  <div class="invalid-feedback">لطفا نام و نام خانوادگی خود را وارد کنید.</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">موبایل</span>
                                  <input type="text" value="{{ old('phone') }}" required id="phone-number-mask" name="phone" class="form-control phone-number-mask text-start" placeholder="912 112 1212" dir="ltr">
                                  <span class="input-group-text">IR (+98)</span>
                                  <div class="invalid-feedback">لطفا موبایل معتبر وارد کنید</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">ایمیل</span>
                                  <input type="email" value="{{ old('email') }}" name="email" placeholder="mehdidelghavi.ir@gmail.com" class="form-control" required>
                                  <div class="invalid-feedback">لطفا ایمیل معتبر وارد کنید</div>
                                </div>
                                <div class="form-password-toggle mb-3">
                                  <div class="input-group">
                                    <span class="input-group-text">رمز عبور</span>
                                    <input type="password" required class="form-control text-start" name="password" placeholder="············" dir="ltr" aria-describedby="basic-default-password2">
                                    <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    <div class="invalid-feedback">لطفا رنز عبور معتبر وارد کنید</div>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">تصویر پروفایل</span>
                                  <input type="file" name="avatar" class="form-control">
                                </div>
                                <div class="row row-bordered g-0 mb-3">
                                    <div class="col-12">
                                      @foreach ($roles as $role)
                                        <div class="form-check form-check-inline mt-3">
                                          <input class="form-check-input" type="checkbox" id="roles{{ $role->id }}" value="{{ $role->name }}" name="roles[]">
                                          <label class="form-check-label" for="roles{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                      @endforeach
                                    </div>
                                  </div>
                                <div class="d-grid gap-2 col-12 mx-auto">
                                  <button type="submit" class="btn btn-primary">
                                    <span class="tf-icons bx bx-plus me-1"></span>افزودن
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
@endsection