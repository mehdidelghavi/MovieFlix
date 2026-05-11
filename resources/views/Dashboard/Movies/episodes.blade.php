@extends('Dashboard.master')
@section("CSS")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/formvalidation/dist/css/formValidation.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/toastr/toastr.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/animate-css/animate.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/tagify/tagify.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css") }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
<style>
    .dropzone {
        border: 2px dashed #007bff;
        border-radius: 10px;
        background: #f8f9fa;
        padding: 30px;
        text-align: center;
        font-size: 18px;
    }
</style>
@endsection
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">مدیریت قسمت ها</span> 
            </h4>

            <div class="row d-flex justify-content-center">
              @if (!request()->is('*edit*'))
              <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
                <div class="card">
                    <h5 class="card-header heading-color">لیست فایل ها</h5>
                    <div class="card-datatable dataTable_select text-nowrap table-responsive">
                      <form action="{{ route("dashboard.articles.multiDelete") }}" method="POST" class="MProccessForm m-3">
                        @csrf
                        <div class="d-flex w-100 justify-content-center align-items-center">
                            <div style="width: 163px">
                                <select id="defaultSelect" class="form-select MProccess">
                                    <option disabled selected>انجام گروهی</option>
                                    <option value="1">حذف گروهی فیلم ها</option>
                                </select>
                            </div>
                        </div>
                        <table class="dt-select-table table table-bordered">
                            <thead>
                            <tr>
                                <th></th>
                                <th>کیفیت</th>
                                <th>فرمت فایل</th>
                                <th>فایل</th>
                                <th>قسمت</th>
                                <th>فصل</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                        </table>
                      </form>
                    </div>
                </div>
              </div>
              @endif
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
                        <h5 class="card-header heading-color"></h5>
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
                            @php
                              $seasonRoute = "dashboard.movies.episodes.season.store";
                              $seasonParam = ["movie" => $movie->id];
                              $episodeRoute = "dashboard.movies.episodes.episode.store";
                              $episodeParam = ["movie" => $movie->id];
                              $qualityRoute = "dashboard.movies.episodes.quality.store";
                              $qualityParam = ["movie" => $movie->id];
                            @endphp
                            @php
                              if (request()->has('quality')){
                                $qualityRoute = "dashboard.movies.update.episodes";
                                $qualityParam['quality'] = $quality;
                              }
                            @endphp
                            @php
                              if (request()->has('episode')) {
                                $episodeRoute = "dashboard.movies.update.episodes";
                                $episodeParam['episode'] = $episode->id;
                              }
                            @endphp
                            @php
                              if(request()->has('season')){
                                $seasonRoute = "dashboard.movies.update.episodes";
                                $seasonParam['season'] = $season->id;
                              }
                            @endphp
                            @if (request()->routeIs("dashboard.movies.edit.episodes"))
                              @if (request()->has('season'))
                                <form action="{{ route($seasonRoute, $seasonParam) }}" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <h4>@if (request()->has('season')) ویرایش @else افزودن @endif فصل</h4>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">عنوان فصل</span>
                                      <input type="text" value="{{ old('name', isset($season) ? $season->name : "") }}" aria-label="title" id="bs-validation-name" placeholder="عنوان فصل" name="name" class="form-control" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">شماره فصل</span>
                                      <input type="text" value="{{ old('number', isset($season) ? $season->number : "") }}" aria-label="number" id="bs-validation-name" placeholder="شماره فصل" name="number" class="form-control" required>
                                    </div>
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                      <button type="submit" class="btn btn-primary">
                                        <span class="tf-icons bx bx-plus me-1"></span>@if (request()->has('season')) ویرایش @else افزودن@endif
                                      </button>
                                    </div>
                                </form>
                              @endif
                              @if (request()->has('episode'))
                                <form action="{{ route($episodeRoute, $episodeParam) }}" class="needs-validation mt-3" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <h4>@if (request()->has('episode')) ویرایش @else افزودن @endif قسمت</h4>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">عنوان قسمت</span>
                                      <input type="text" value="{{ old('title', isset($episode) ? $episode->title : "" ) }}" aria-label="title" id="bs-validation-name" placeholder="عنوان قسمت" name="title" class="form-control" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">شماره قسمت</span>
                                      <input type="text" value="{{ old('number', isset($episode) ? $episode->number : "") }}" aria-label="number" id="bs-validation-name" placeholder="شماره قسمت" name="number" class="form-control" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">مدت زمان قسمت</span>
                                      <input type="text" value="{{ old('duration', isset($episode) ? $episode->duration : "") }}" aria-label="duration" id="bs-validation-name" placeholder="مدت زمان قسمت" name="duration" class="form-control" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">فصل</span>
                                      <select class="form-control" name="season_id">
                                        <option value="0">بدونه فصل</option>
                                        @foreach ($seasons as $season)
                                            <option value="{{ $season->id }}" @if (isset($episode) && $season->id == $episode->season->id) selected @endif>{{ $season->name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="form-check mb-3">
                                      <input class="form-check-input" type="checkbox" value="1" id="has_persian_subtitle" name="has_persian_subtitle" @if ($episode->has_persian_subtitle) checked @endif>
                                      <label class="form-check-label" for="has_persian_subtitle"> زیرنویس چسبیده </label>
                                    </div>
                                    <div class="form-check mb-3">
                                      <input class="form-check-input" type="checkbox" value="1" id="has_persian_dub" name="has_persian_dub" @if ($episode->has_persian_dub) checked @endif>
                                      <label class="form-check-label" for="has_persian_dub"> دوبله فارسی </label>
                                    </div>
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                      <button type="submit" class="btn btn-primary">
                                        <span class="tf-icons bx bx-plus me-1"></span>@if (request()->has('episode')) ویرایش @else افزودن @endif
                                      </button>
                                    </div>
                                </form>
                              @endif
                              @if (request()->has('quality'))
                                <form action="{{ route($qualityRoute, $qualityParam) }}" class="needs-validation mt-3 dropzone" id="myDropzone" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <h4>افزودن فایل</h4>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">کیفیت </span>
                                      <input type="text" value="{{ old('quality', isset($quality) ? $quality->quality : "") }}" aria-label="quality" id="bs-validation-name" placeholder="کیفیت مثلا 720" name="quality" class="form-control quality" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">فرمت فایل</span>
                                      <input type="text" value="{{ old('format', isset($quality) ? $quality->format : "") }}" aria-label="duration" id="bs-validation-name" placeholder="فرمت فایل" name="format" class="form-control" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">قسمت</span>
                                      <select class="form-control episode" name="episode_id">
                                        @foreach ($episodes as $episode)
                                            <option value="{{ $episode->id }}" @if ($quality->episode->id == $episode->id) selected @endif>{{ $episode->title }} {{ $episode->season ? $episode->season->name : ""}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">URL فایل</span>
                                        <input type="text" value="{{ old('url', isset($quality) ? $quality->url : "") }}" aria-label="url" id="url" placeholder="URL فایل" name="url" class="form-control" required>
                                    </div>
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                      <button type="submit" class="btn btn-primary">
                                        <span class="tf-icons bx bx-plus me-1"></span>@if (request()->has('quality')) ویرایش @else افزودن@endif
                                      </button>
                                    </div>
                                    <div class="dz-message">فایل خود را بکشید یا کلیک کنید</div>
                                </form>
                              @endif
                              @else 
                                <form action="{{ route($seasonRoute, $seasonParam) }}" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                      @csrf
                                      <h4>@if (request()->has('season')) ویرایش @else افزودن @endif فصل</h4>
                                      <div class="input-group mb-3">
                                        <span class="input-group-text">عنوان فصل</span>
                                        <input type="text" value="{{ old('name', isset($season) ? $season->name : "") }}" aria-label="title" id="bs-validation-name" placeholder="عنوان فصل" name="name" class="form-control" required>
                                      </div>
                                      <div class="input-group mb-3">
                                        <span class="input-group-text">شماره فصل</span>
                                        <input type="text" value="{{ old('number', isset($season) ? $season->number : "") }}" aria-label="number" id="bs-validation-name" placeholder="شماره فصل" name="number" class="form-control" required>
                                      </div>
                                      <div class="d-grid gap-2 col-12 mx-auto">
                                        <button type="submit" class="btn btn-primary">
                                          <span class="tf-icons bx bx-plus me-1"></span>@if (request()->has('season')) ویرایش @else افزودن@endif
                                        </button>
                                      </div>
                                </form>
                                <form action="{{ route($episodeRoute, $episodeParam) }}" class="needs-validation mt-3" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <h4>@if (request()->has('episode')) ویرایش @else افزودن @endif قسمت</h4>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">عنوان قسمت</span>
                                      <input type="text" value="{{ old('title', isset($episode) ? $episode->title : "" ) }}" aria-label="title" id="bs-validation-name" placeholder="عنوان قسمت" name="title" class="form-control" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">شماره قسمت</span>
                                      <input type="text" value="{{ old('number', isset($episode) ? $episode->number : "") }}" aria-label="number" id="bs-validation-name" placeholder="شماره قسمت" name="number" class="form-control" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">مدت زمان قسمت</span>
                                      <input type="text" value="{{ old('duration', isset($episode) ? $episode->duration : "") }}" aria-label="duration" id="bs-validation-name" placeholder="مدت زمان قسمت" name="duration" class="form-control" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">فصل</span>
                                      <select class="form-control" name="season_id">
                                        <option value="0">بدونه فصل</option>
                                        @foreach ($seasons as $season)
                                            <option value="{{ $season->id }}" @if (isset($episode) && $season->id == $episode->season->id) selected @endif>{{ $season->name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="form-check mb-3">
                                      <input class="form-check-input" type="checkbox" value="1" id="has_persian_subtitle" name="has_persian_subtitle">
                                      <label class="form-check-label" for="has_persian_subtitle"> زیرنویس چسبیده </label>
                                    </div>
                                    <div class="form-check mb-3">
                                      <input class="form-check-input" type="checkbox" value="1" id="has_persian_dub" name="has_persian_dub">
                                      <label class="form-check-label" for="has_persian_dub"> دوبله فارسی </label>
                                    </div>
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                      <button type="submit" class="btn btn-primary">
                                        <span class="tf-icons bx bx-plus me-1"></span>@if (request()->has('episode')) ویرایش @else افزودن @endif
                                      </button>
                                    </div>
                                </form>
                                <form action="{{ route($qualityRoute, $qualityParam) }}" class="needs-validation mt-3 dropzone" id="myDropzone" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <h4>افزودن فایل</h4>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">کیفیت </span>
                                      <input type="text" value="{{ old('quality') }}" aria-label="quality" id="bs-validation-name" placeholder="کیفیت مثلا 720" name="quality" class="form-control quality" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">فرمت فایل</span>
                                      <input type="text" value="{{ old('format') }}" aria-label="duration" id="bs-validation-name" placeholder="فرمت فایل" name="format" class="form-control" required>
                                    </div>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">قسمت</span>
                                      <select class="form-control episode" name="episode_id">
                                        @foreach ($episodes as $episode)
                                            <option value="{{ $episode->id }}">{{ $episode->title }} {{ $episode->season ? $episode->season->name : ""}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">URL فایل</span>
                                        <input type="text" value="{{ old('url') }}" aria-label="url" id="url" placeholder="URL فایل" name="url" class="form-control" required>
                                    </div>
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                      <button type="submit" class="btn btn-primary">
                                        <span class="tf-icons bx bx-plus me-1"></span>افزودن
                                      </button>
                                    </div>
                                    <div class="dz-message">فایل خود را بکشید یا کلیک کنید</div>
                                </form>
                            @endif
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
<script src="{{ asset("assets/js/dropzone.min.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js") }}"></script>
<script>
          var dt_select_table = $('.dt-select-table');
        $(".MProccess").on('change', function (){
            $(".MProccessForm").submit();
        });
        if (dt_select_table.length) {
            var dt_select = dt_select_table.DataTable({
            ajax: "{{ route("dashboard.movies.episodes", ['movie' => $movie->id]) }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'quality', name: 'quality' },
                { data: 'format', name: 'format' },
                { data: 'url', name: 'url' },
                { data: 'episode_id', name: 'episode_id' },
                { data: 'season_id', name: 'season_id' },
                { data: 'actions', name: 'actions' },
            ],
            columnDefs: [
                {
                    // For Checkboxes
                    targets: 0,
                    searchable: true,
                    orderable: false,
                    render: function (data, type, row) {
                        return `<input type="checkbox" class="dt-checkboxes form-check-input mt-0 align-middle" name="movies[]" value="${row.id}">`;
                    },
                    checkboxes: {
                        selectRow: true,
                        selectAllRender: '<input type="checkbox" class="form-check-input mt-0 align-middle">'
                    }
                },
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            select: {
                // Select style
                style: 'multi'
            }
            });
        }
    Dropzone.autoDiscover = false;

    let myDropzone = new Dropzone("#myDropzone", {
        url: "{{ route('dashboard.movies.episodes.quality.upload', ['movie' => $movie->id]) }}",
        paramName: "file",
        maxFilesize: 20048, // حداکثر حجم به MB
        chunking: true,
        forceChunking: true,
        chunkSize: 5 * 1024 * 1024, // هر تکه 2 مگابایت
        parallelChunkUploads: true,
        retryChunks: true,
        retryChunksLimit: 3,
        autoProcessQueue: false,
        addRemoveLinks: true,
        acceptedFiles: "video/*,image/*",
        maxFiles: 1, // ✅ فقط یک فایل مجاز است
        dictDefaultMessage: "فقط یک عکس یا ویدیو انتخاب کنید",
        init: function () {
            this.on("addedfile", function (file){
              const qualityInput = $(".quality").val();
              if (!qualityInput){
                alert("لطفا مقادیر بالا را وارد کنید سپس اقدام به آپلود فایل کنید");
                this.removeFile(file);
                return;
              }
              this.processFile(file);
            });
            this.on("sending", function (file, xhr, formData){
              const qualityInput = $(".quality").val();
              const episdeInput = $(".episode").val();
              formData.append("quality", qualityInput);
              formData.append("episode", episdeInput);
              @if (request()->has('quality'))
              formData.append("quality_id", {{ $quality->id }});
              @endif
            });
            this.on("success", function (file, response) {
                document.querySelector("#url").setAttribute("value", response.url);
                console.log("Upload Success:", response);
            });
            this.on("error", function (file, errorMessage) {
                console.error("Upload Error:", errorMessage);
            });
        },
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
</script>
@endsection