@extends('Panel.master')
@section('css')
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") }}">
@endsection
@section('content')
        <!-- main panel container -->
        <section class="main__panel__section">
            <!-- panel header start -->
            <header class="main__panel__header">
                <!-- menu panel header fixed -->
                <div class="mobile__panel__header">
                    <div class="mobile__panel__logo ">
                        <a href="Panel.html">
                            <img loading="lazy" clsas="panel-logo" src="{{ asset('users/') . auth()->user()->avatar }}"
                                alt="">
                        </a>
                    </div>
                    <button id="openPanelNav" class="OpenPanelNavbar" role="button">
                        <div class="panel-bar"></div>
                        <div class="panel-bar"></div>
                        <div class="panel-bar"></div>
                    </button>
                </div>
                <!-- menu panel header fixed end-->

                <!-- panel page title -->
                <div class="panel__page__title" id="user-panel-page-title">
                    <h1>فیلم و سریال های دیده شده</h1>

                    @include('Panel.partials.head')

                </div>
                <!-- panel page title end-->
            </header>
            <!-- page header end -->

            <!-- send ticket container -->
            <div class="send-ticket-container">
            @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-desktop me-2"></i>موفقیت!</h6>
                    <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('failed'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-desktop me-2"></i>خطا!</h6>
                        <span>{{ session('failed') }}</span>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
                        <i class="bx bx-xs bx-store me-2"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                    <div class="d-flex w-100 justify-content-center align-items-center">
                    </div>
                    <table class="dt-select-table table table-dark table-responsive">
                        <thead>
                        <tr>
                            <th></th>
                            <th>عنوان</th>
                            <th>ژانر</th>
                            <th>زمان</th>
                        </tr>
                        </thead>
                    </table>
            </div>
        </section>
        <!-- menu panel container end -->
    </main>

    <div class="user-balance-alert">
        <h1>موجودی حساب شما</h1>
        <div class="chest">
            <img src="/assest/images/backgrounds/chest.png" alt="chest">
        </div>
        <p class="balance-counter">2378</p>

        <div class="balance-action-buttons">
            <button class="balance-action-btn">شارژ حساب</button>
            <button class="balance-action-btn danger" id="close-balance-alert">بستن</button>
        </div>
    </div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
            ajax: "{{ route('panel.watched') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'genres', name: 'genres' },
                { data: 'time', name: 'time' },
            ],
            columnDefs: [
                {
                    // For Checkboxes
                    targets: 0,
                    searchable: true,
                    orderable: false,
                    render: function (data, type, row) {
                        return `<input type="checkbox" class="dt-checkboxes form-check-input mt-0 align-middle" name="likes[]" value="${row.id}">`;
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
    });
</script>
@endsection