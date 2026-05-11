@extends('Dashboard.master')
@section("CSS")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/formvalidation/dist/css/formValidation.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/toastr/toastr.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/animate-css/animate.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/flatpickr/flatpickr.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/jquery-timepicker/jquery-timepicker.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/pickr/pickr-themes.css") }}">
@endsection
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">کالکشن ها /</span> افزودن کالکشن
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
                        <h5 class="card-header heading-color">افزودن کالکشن</h5>
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
                            <form action="{{ route("dashboard.collections.store") }}" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="input-group mb-3">
                                  <span class="input-group-text">عنوان کالکشن</span>
                                  <input type="text" value="{{ old('name') }}" aria-label="name" id="bs-validation-name" placeholder="نام کالکشن" name="name" class="form-control" required>
                                  <div class="invalid-feedback">لطفا نام و نام خانوادگی بازیکر را وارد کنید.</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">تصویر کالکشن</span>
                                  <input type="file" name="thumbnail" class="form-control" required>
                                  <div class="invalid-feedback">لطفا عکس کالکشن را انتخاب کنید</div>
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
    <!-- Vendors JS -->
    <script src="{{ asset("assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js") }}"></script>
<script src="{{ asset("assets/js/form-validation.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/moment/moment.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/jdate/jdate.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/flatpickr/flatpickr-jdate.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/flatpickr/l10n/fa-jdate.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/jquery-timepicker/jquery-timepicker.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/pickr/pickr.js") }}"></script>
    

    <!-- Main JS -->
    <script src="{{ asset("assets/js/main.js") }}"></script>
    <script>
      $("#bs-datepicker-basic").datepicker();
    </script>
@endsection