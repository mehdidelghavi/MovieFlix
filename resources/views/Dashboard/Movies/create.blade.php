@extends('Dashboard.master')
@section("CSS")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/formvalidation/dist/css/formValidation.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/toastr/toastr.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/animate-css/animate.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/tagify/tagify.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/select2/select2.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-select/bootstrap-select.css") }}">
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
.select2-search--inline .select2-search__field {
  display: inline-block !important;
}
.position-relative{
  width: 100% !important;
}
</style>
@endsection
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">فیلم ها /</span> افزودن فیلم
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
                        <h5 class="card-header heading-color">افزودن فیلم</h5>
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
                            <form action="{{ route("dashboard.movies.store") }}" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="input-group mb-3">
                                  <span class="input-group-text">عنوان اصلی فیلم</span>
                                  <input type="text" value="@if(old('title')) {{ old('title')[0] }} @endif" aria-label="title" id="bs-validation-name" placeholder="عنوان اصلی" name="title[]" class="form-control">
                                  <div class="invalid-feedback">در این قسمت فقط عنوان فیلم را بنویسید</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">عنوان انگلیسی فیلم</span>
                                  <input type="text" value="@if(old('title')) {{ old('title')[1] }} @endif" aria-label="title" id="bs-validation-name" placeholder="عنوان انگلیسی فیلم" name="title[]" class="form-control" required>
                                  <div class="invalid-feedback">در این قسمت فقط عنوان فیلم را بنویسید</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">تصویر شاخص</span>
                                  <input type="file" name="thumbnail" class="form-control" required>
                                  <div class="invalid-feedback">لطفا عکس فیلم را انتخاب کنید</div>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">رتبه IMDB</span>
                                  <input type="text" value="{{ old('imdb') }}" aria-label="imdb" id="bs-validation-name" placeholder="رتبه IMDB" name="imdb" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">سال ساخت</span>
                                  <input type="text" value="{{ old('creation_year') }}" aria-label="imdb" id="bs-validation-name" placeholder="سال ساخت" name="creation_year" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">درجه سنی</span>
                                  <input type="text" value="{{ old('age') }}" aria-label="age" id="bs-validation-name" placeholder="درجه سنی" name="age" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">کشور سازنده</span>
                                  <input type="text" value="{{ old('country') }}" aria-label="country" id="bs-validation-name" placeholder="کشور سازنده" name="country" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">مدت زمان</span>
                                  <input type="text" value="{{ old('time') }}" aria-label="time" id="bs-validation-name" placeholder="کشور سازنده" name="time" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">داستان فیلم</span>
                                  <textarea class="form-control" name="story">{{ old('story') }}</textarea>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">درباره فیلم</span>
                                  <textarea class="form-control" name="about">{{ old('about') }}</textarea>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text">تریلر فیلم</span>
                                  <input type="file" name="trailer" class="form-control" required>
                                  <div class="invalid-feedback">لطفا تریلر فیلم را انتخاب کنید</div>
                                </div>
                                <div class="input-group mb-4">
                                  <label for="actors" class="form-label">بازیگران</label>
                                  <select id="user-select" class="select2 form-control w-100" multiple="multiple" data-select2-id="select2Multiple" name="actors[]" data-allow-clear="true">
                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <label for="select2Basic" class="form-label">کارگردان</label>
                                  <select id="director" name="directors[]" class="select2 form-select form-select-lg" data-allow-clear="true">

                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <label for="select2Basic" class="form-label">ژانر فیلم</label>
                                  <select name="genres[]" class="select2 form-select form-select-lg" data-allow-clear="true" multiple>
                                    @php
                                    $oldGenres = old('genres');
                                    @endphp
                                    @foreach ($genres as $genre)
                                      <option value="{{ $genre->id }}" @if ($oldGenres != null && in_array($genre->id, $oldGenres)) selected @endif>{{  $genre->title }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <label for="select2Basic" class="form-label">لیست فیلم</label>
                                  <select name="lists[]" class="select2 form-select form-select-lg" data-allow-clear="true" multiple>
                                    @php
                                    $oldList = old('lists');
                                    @endphp
                                    @foreach ($lists as $list)
                                      <option value="{{ $list->id }}" @if ($oldList != null && in_array($list->id, $oldList)) selected @endif>{{  $list->title }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <label for="collection" class="form-label">کالکشن</label>
                                  <select id="collection" class="select2 form-select form-select-lg" data-allow-clear="true" name="collection">
                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <label for="type" class="form-label">نوع</label>
                                  <select id="type" class="selectpicker w-100" data-style="btn-default" name="type">
                                    <option value="movie">فیلم</option>
                                    <option value="series">سریال</option>
                                    <option value="animation">انیمیشن</option>
                                    <option value="anime">انیمه</option>
                                  </select>
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
<script src="{{ asset("assets/vendor/libs/select2/select2.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/bootstrap-select/bootstrap-select.js") }}"></script>
<script src="{{ asset("assets/js/forms-selects.js") }}"></script>
<script>
$(document).ready(function() {
  let $actorSelect = $('#user-select');
  let $directorSelect = $("#director");
  let $collectionSelect = $("#collection");
  $directorSelect.select2({
      placeholder: 'کارگردان را جستجو کنید...',
      multiple: true,
      minimumInputLength: 2,
      ajax: {
          url: '{{ route('dashboard.movies.search.actors') }}',
          dataType: 'json',
          delay: 250,
          data: function (params) {
              return {
                  q: params.term // متنی که کاربر تایپ می‌کنه
              };
          },
          processResults: function (data) {
              return {
                results: data.map(item => ({
                    id: item.text,
                    text: item.text,
                }))
              };
          },
          cache: true
      }
  });
  $actorSelect.select2({
      placeholder: 'بازیگر را جستجو کنید...',
      multiple: true,
      minimumInputLength: 2,
      ajax: {
          url: '{{ route('dashboard.movies.search.actors') }}',
          dataType: 'json',
          delay: 250,
          data: function (params) {
              return {
                  q: params.term // متنی که کاربر تایپ می‌کنه
              };
          },
          processResults: function (data) {
              return {
                  results: data
              };
          },
          cache: true
      }
  });
  $collectionSelect.select2({
      placeholder: 'کالکشن را جستجو کنید...',
      multiple: false,
      minimumInputLength: 2,
      ajax: {
          url: '{{ route('dashboard.movies.search.collections') }}',
          dataType: 'json',
          delay: 250,
          data: function (params) {
              return {
                  q: params.term // متنی که کاربر تایپ می‌کنه
              };
          },
          processResults: function (data) {
              return {
                results: data.map(item => ({
                    id: item.id,
                    text: item.text,
                }))
              };
          },
          cache: true
      }
  });
});
</script>
@endsection