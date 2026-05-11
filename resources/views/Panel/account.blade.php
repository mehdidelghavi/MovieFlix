@extends('Panel.master')
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
                    <h1>ویرایش پروفایل</h1>

                    @include('Panel.partials.head')

                </div>
                <!-- panel page title end-->
            </header>
            <!-- page header end -->

            <!-- send ticket container -->
            <div class="edit-profile-container container">
                <div class="edit-profile-container-child edit-profile-form-container">
                    <h2>اطلاعات کاربری شما</h2>
                    <form action="{{ route('panel.account.update') }}" id="edit-profile" class="edit-profile" name="profile-edited" method="POST">
                        @csrf
                        <div class="form-control">
                            <label for="user-firstName">نام</label>
                            <input type="text" value="{{ $user->name }}" id="user-firstName" name="name">
                        </div>
                        <div class="form-control">
                            <label for="user-lastName">نام خانوادگی</label>
                            <input type="text" value="{{ $user->family }}" id="user-lastName" name="family">
                        </div>
                        <div class="form-control">
                            <label for="user-email">ایمیل</label>
                            <input type="email" value="{{ $user->email }}" id="user-email" name="email">
                        </div>
                        <div class="form-control">
                            <label for="user-phone">شماره تماس</label>
                            <input type="tel" value="{{ $user->phone }}" id="user-phone" name="phone">
                        </div>
                        <div class="form-control">
                            <label for="user-password">رمز جدید</label>
                            <input type="password" id="user-password" name="password">
                        </div>
                        <div class="form-control">
                            <label for="user-confirm">تایید رمز جدید</label>
                            <input type="password" id="user-confirm" name="password_confirmation">
                        </div>
                        <button tpye="submit" class="add-new-post-btn" id="submit-profile-edited">
                            <span>ثبت اطلاعات</span> <i class="fa fa-check-circle"></i>
                        </button>
                    </form>
                </div>
                <!--  -->
                <div class="edit-profile-container-child edit-profile-image-container">
                    <form action="#" id="edit-profile-image" class="edit-profile-image" name="profile-image-edited">
                        <!--  -->
                        <div class="profile-bg"></div>
                        <!--  -->
                        <div class="profile-image">
                            <img src="{{ asset('users/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name . " " . auth()->user()->family }}" alt="{{ $user->name . " " . $user->family }}">
                        </div>
                        <div class="upload-avatar-container">
                            <input type="file" accept="image/*" id="upload-avatar-image" class="upload-avatar-image" name="avatar">
                            <label for="upload-avatar-image" class="upload-avatar-container-child">
                                <p>آپلود آواتار</p>
                                <p>320 <i class="fa fa-times"></i> 320</p>
                            </label>
                        </div>
                    </form>
                </div>
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
<script>
const input = document.getElementById('upload-avatar-image');

input.addEventListener('change', function () {
    const file = this.files[0];

    if (!file) return;

    const formData = new FormData();
    formData.append('avatar', file);


    fetch("{{ route('panel.account.avatar.upload') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        //console.log('Success:', data);
    })
    .catch(error => {
        //console.error('Error:', error);
    });
});
</script>
@endsection
