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
                    <h1>ارسال تیکت</h1>

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
                <form action="{{ route('panel.tickets.send.do') }}" id="send-ticket" name="send-ticket" method="post" class="send-ticket-container" enctype="multipart/form-data">
                    @csrf
                    <div class="col-6-inputs">
                        <div class="form-control">
                            <input class="additem-input" placeholder="موضوع" type="text" name="subject" id="subject">
                        </div>
                        <div class="form-control">
                            <p class="additem-input select-box-inp">
                                @if (old('departman') == "support-departman")
                                    پشتیبانی
                                    @elseif(old('departman') == "contact-departman")
                                    ارتباط با فلیکس مویی
                                    @elseif(old('departman') == "ads-departman")
                                    رزرو تبلیغات
                                    @else
                                    دپارتمان خود را انتخاب کنید
                                @endif
                            </p>
                            <ul class="additem-input selectable-list customTicketDepartman">
                                <li data-department="support">
                                    <label for="support-departman">پشتیبانی</label>
                                </li>
                                <li data-department="contact-us">
                                    <label for="contact-departman">
                                        ارتباط با فلیکس مووی    
                                    </label>
                                </li>
                                <li data-department="res-ads">
                                    <label for="ads-departman">
                                    رزرو تبلیغات
                                    </label>
                                </li>
                                <input type="radio" value="support-departman" name="departman" hidden id="support-departman" @if (old('departman') == "support-departman") checked @endif>
                                <input type="radio" value="contact-departman" name="departman" hidden id="contact-departman" @if(old('departman') == "contact-departman") checked @endif>
                                <input type="radio" value="ads-departman" name="departman" hidden id="ads-departman" @if(old('departman') == "ads-departman") checked @endif>
                            </ul>
                        </div>
                    </div>

                    <div class=" form-control">
                        <textarea spellcheck="false" class="additem-input" name="text"
                            id="article-text-area" data-required="true" placeholder="پیام شما"></textarea>
                    </div>
                    <div class="form-control">
                        <input type="file" name="attachment">
                    </div>
                    <div class="form-control add-new-post-btn-cr">
                        <button tpye="submit" class="add-new-post-btn" id="add-new-post-submit">
                            ارسال
                        </button>
                    </div>
                </form>
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