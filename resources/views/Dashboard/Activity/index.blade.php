@extends('Dashboard.master')
@section("CSS")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/animate-css/animate.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css") }}">
@endsection
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">رخداد ها /</span> لیست رخداد ها
            </h4>

            <div class="row d-flex justify-content-center">
            <div class="card">
                <h5 class="card-header heading-color">لیست رخداد ها</h5>
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
                <div class="card-datatable dataTable_select text-nowrap table-responsive">
                  <form action="{{ route("dashboard.actors.multiDelete") }}" method="POST" class="MProccessForm">
                    @csrf
                    <table class="dt-select-table table table-bordered">
                        <thead>
                        <tr>
                            <th>نوع رخداد</th>
                            <th>موضوع رخداد</th>
                            <th>ایجاد کننده</th>
                            <th>پیغام</th>
                            <th>زمان ایجاد</th>
                        </tr>
                        </thead>
                    </table>
                  </form>
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
<script src="{{ asset("assets/js/ui-toasts.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js") }}"></script>
<script src="{{ asset("assets/vendor/libs/datatables-bs5/i18n/fa.js") }}"></script>
<script>
    $(document).ready( function (){
        var dt_select_table = $('.dt-select-table');
        $(".MProccess").on('change', function (){
            $(".MProccessForm").submit();
        });
        if (dt_select_table.length) {
            var dt_select = dt_select_table.DataTable({
            ajax: "{{ route("dashboard.activity") }}",
            columns: [
                { data: 'log_name', name: 'log_name' },
                { data: 'description', name: 'description' },
                { data: 'causer_id', name: 'causer_id' },
                { data: 'properties', name: 'properties' },
                { data: 'created_at', name: 'created_at' },
            ],
            sorting: false
            });
        }
    });
</script>
@endsection