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
                <span class="text-muted fw-light">تعرفه ها /</span>  افزودن تعرفه
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
                        <h5 class="card-header heading-color">افزودن تعرفه</h5>
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
                            <form action="{{ route("dashboard.plans.store") }}" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="input-group mb-3">
                                  <span class="input-group-text">عنوان تعرفه</span>
                                  <input type="text" value="{{ old('title') }}" aria-label="First name" id="bs-validation-name" placeholder="تعرفه طلایی" name="title" class="form-control" required>
                                  <div class="invalid-feedback">لطفا عنوان تعرفه را وارد کنید</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">مدت زمان</span>
                                  <input type="number" value="{{ old('duration') }}" required id="phone-number-mask" name="duration" class="form-control" placeholder="عدد به روز">
                                  <div class="invalid-feedback">لطفا مدت زمان وارد کنید</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">قیمت (تومان)</span>
                                  <input type="text" value="{{ old('price') }}" required name="price" class="form-control numeral-mask text-start" placeholder="30,000">
                                  <div class="invalid-feedback">لطفا قیمت وارد کنید</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">تخفیف (%)</span>
                                  <input type="number" value="{{ old('discount',0) }}" required name="discount" class="form-control">
                                  <div class="invalid-feedback">لطفا قیمت وارد کنید</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">درباره تعرفه</span>
                                  <textarea class="form-control" name="about" aria-label="With textarea" placeholder="این تعرفه شامل فقط تماشای آنلاین میباشد">{{ old("about") }}</textarea>
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