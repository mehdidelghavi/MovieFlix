@extends("Dashboard.master")
@section("CSS")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/animate-css/animate.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css") }}">
@endsection
@section("content")
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="d-flex align-items-center gap-3">
                <div class="avatar">
                  <span class="avatar-initial bg-label-primary rounded-circle"><i class="bx bx-user fs-4"></i></span>
                </div>
                <div class="card-info">
                  <h5 class="card-title mb-0 me-2 primary-font">{{ $userCount }}</h5>
                  <small class="text-muted">کاربران</small>
                </div>
              </div>
              <div id="conversationChart"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="d-flex align-items-center gap-3">
                <div class="avatar">
                  <span class="avatar-initial bg-label-primary rounded-circle"><i class="bx bx-user fs-4"></i></span>
                </div>
                <div class="card-info">
                  <h5 class="card-title mb-0 me-2 primary-font">{{ $activeSubCount }}</h5>
                  <small class="text-muted">اشتراک های فعال</small>
                </div>
              </div>
              <div id="conversationChart"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="d-flex align-items-center gap-3">
                <div class="avatar">
                  <span class="avatar-initial bg-label-primary rounded-circle"><i class="bx bx-user fs-4"></i></span>
                </div>
                <div class="card-info">
                  <h5 class="card-title mb-0 me-2 primary-font">{{ $movieCount }}</h5>
                  <small class="text-muted">فیلم / سریال</small>
                </div>
              </div>
              <div id="conversationChart"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="d-flex align-items-center gap-3">
                <div class="avatar">
                  <span class="avatar-initial bg-label-primary rounded-circle"><i class="bx bx-user fs-4"></i></span>
                </div>
                <div class="card-info">
                  <h5 class="card-title mb-0 me-2 primary-font">{{ $articleCount }}</h5>
                  <small class="text-muted">مقالات</small>
                </div>
              </div>
              <div id="conversationChart"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card">
          <h5 class="card-header heading-color">آخرین تیکت ها</h5>
          <div class="card-datatable dataTable_select text-nowrap table-responsive">
            <table class="dt-select-table table table-bordered">
              <thead>
              <tr>
                  <th>موضوع</th>
                  <th>کاربر</th>
                  <th>دپارتمان</th>
                  <th>شماره تیکت</th>
                  <th>وضعیت</th>
                  <th>تاریخ آخرین ویرایش</th>
                  <th>عملیات</th>
              </tr>
              </thead>
          </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card">
          <h5 class="card-header heading-color">آخرین نظرات</h5>
          <div class="card-datatable dataTable_select text-nowrap table-responsive">
            <table class="dt-select-table2 table table-bordered">
              <thead>
              <tr>
                  <th>پست</th>
                  <th>کاربر</th>
                  <th>متن</th>
                  <th>تاریخ ایجاد</th>
                  <th>عملیات</th>
              </tr>
              </thead>
          </table>
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

        <a href="https://v3dboy.ir/previews/html/frest/documentation" target="_blank" class="footer-link me-4">مستندات</a>

        <a href="https://rtl-theme.com" target="_blank" class="footer-link d-none d-sm-inline-block">پشتیبانی</a>
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
<script src="{{ asset("assets/vendor/libs/chartjs/chartjs.js") }}"></script>
<script src="{{ asset("assets/js/charts-chartjs.js") }}"></script>
<script>
    $(document).ready( function (){
        var dt_select_table = $('.dt-select-table');
        if (dt_select_table.length) {
          var dt_select = dt_select_table.DataTable({
            ajax: "{{ route("dashboard.tickets") }}",
            columns: [
                { data: 'subject', name: 'subject' },
                { data: 'user_id', name: 'user_id' },
                { data: 'departman', name: 'departman' },
                { data: 'ticket_number', name: 'ticket_number' },
                { data: 'status', name: 'status' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'actions', name: 'actions' },
            ],
          });
        }
    });
</script>
@endsection