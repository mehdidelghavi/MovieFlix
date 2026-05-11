@extends('Dashboard.master')
@section("CSS")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/formvalidation/dist/css/formValidation.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/toastr/toastr.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/animate-css/animate.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/tagify/tagify.css") }}">
<style>
  <style>
/* کل ادیتور */
.ck-editor {
    width: 100% !important;
    box-sizing: border-box;
}

/* محتوای داخلی (جایی که کاربر تایپ می‌کند) */
.ck-editor__editable {
    min-height: 300px !important;
    max-height: 300px !important;
    direction: rtl;
    text-align: right;
    transition: none !important; /* جلوگیری از تغییر ارتفاع هنگام فوکوس */
}

/* جلوگیری از تغییر ارتفاع یا حاشیه هنگام کلیک */
.ck-editor__editable:focus {
    min-height: 300px !important;
    max-height: 300px !important;
    box-shadow: none !important;
    border: 1px solid #ddd !important;
}
</style>
</style>
@endsection
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">نیازمندی ها /</span> افزودن نیازمندی
            </h4>

            <div class="row d-flex justify-content-center">

            <div class="col-lg-8 col-md-12 col-sm-12">
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
                        <h5 class="card-header heading-color">افزودن نیازمندی</h5>
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
                            <form action="{{ route("dashboard.requirements.store") }}" class="needs-validation form-repeater" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="input-group mb-3">
                                  <span class="input-group-text">عنوان نیازمندی</span>
                                  <input type="text" value="{{ old('title') }}" aria-label="title" id="bs-validation-name" placeholder="عنوان نیازمندی" name="title" class="form-control" required>
                                  <div class="invalid-feedback">در این قسمت فقط نام نیازمندی را بنویسید</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">تصویر شاخص</span>
                                  <input type="file" name="thumbnail" class="form-control" required>
                                  <div class="invalid-feedback">لطفا عکس نیازمندی را انتخاب کنید</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">آیکون نیازمندی</span>
                                  <input type="text" value="{{ old('icon') }}" aria-label="icon" id="bs-validation-name" placeholder="آیکون نیازمندی" name="icon" class="form-control" required>
                                  <div class="invalid-feedback">در این قسمت فقط ایکون نیازمندی را بنویسید</div>
                                </div>
                                <div class=" mb-3">
                                  <textarea class="form-control" dir="rtl" id="editor" name="text" placeholder="توضیحات نیازمندی" required>{{ old('text') }}</textarea>
                                </div>
                                <div data-repeater-list="group-a">
                                  <div data-repeater-item>
                                    <div class="row">
                                      <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-1">عنوان</label>
                                        <input type="text" id="form-repeater-1-1" class="form-control text-start" placeholder="KMplayer x64" name="title">
                                      </div>
                                      <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-2">آپلود فایل</label>
                                        <input type="file" id="form-repeater-1-2" class="form-control text-start" name="file">
                                      </div>
                                      <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-3">فرمت فایل</label>
                                        <input type="text" id="form-repeater-1-1" class="form-control text-start" placeholder="exe" name="format">
                                      </div>
                                      <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-4">سایز</label>
                                        <input type="text" id="form-repeater-1-1" class="form-control text-start" placeholder="64 مگابایت" name="size">
                                      </div>
                                      <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                        <button class="btn btn-label-danger mt-4" data-repeater-delete>
                                          <i class="bx bx-x me-1"></i>
                                          <span class="align-middle">حذف</span>
                                        </button>
                                      </div>
                                    </div>
                                  <hr>
                                </div>
                                </div>
                                <div class="mb-0">
                                  <button class="btn btn-danger" data-repeater-create type="button">
                                    <i class="bx bx-plus me-1"></i>
                                    <span class="align-middle">بیشتر</span>
                                  </button>
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
<script src="{{ asset("assets/js/forms-tagify.js") }}"></script>
<script src="{{ asset("assets/js/ckeditor.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/jquery-repeater/jquery-repeater.js") }}"></script>
<script>
CKEDITOR.replace('editor', {
    language: 'fa',
    contentsLangDirection: 'rtl',
    height: 300,
    width: '100%',
    filebrowserBrowseUrl: '/dashboard/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/dashboard/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}',
    filebrowserImageBrowseUrl: '/dashboard/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/dashboard/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
    filebrowserImageUploadAllowedExtensions: 'jpg,jpeg,png,gif,webp',
});
</script>
@endsection