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
                    <h1>نمایش تیکت #{{ $ticket->ticket_number }}</h1>

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
                @foreach ($ticket->replies()->orderByDesc('id')->get() as $childs)
                    <div class="ticketscontainer">
                        <div class="ticketOwner"><h4>{{ $childs->user->name . " " . $childs->user->family }}</h4></div>
                        <p>{{ $childs->text }}</p>
                        <span class="ticketDate">{{ Morilog\Jalali\Jalalian::forge($childs->created_at)->format('Y-m-d H:i:s') }}</span>
                        @if ($childs->attachment != null)
                            <br><a href="{{ asset('storage/tickets/' . $childs->attachment) }}" style="color: #6898f8;">تصویر شاخص</a>
                        @endif
                    </div>
                @endforeach
                <div class="ticketscontainer">
                    <div class="ticketOwner"><h4>{{ $ticket->user->name . " " . $ticket->user->family }}</h4></div>
                    <p>{{ $ticket->text }}</p>
                    <span class="ticketDate">{{ Morilog\Jalali\Jalalian::forge($ticket->created_at)->format('Y-m-d H:i:s') }}</span>
                    @if ($ticket->attachment != null)
                        <br><a href="{{ asset('storage/tickets/' . $ticket->attachment) }}" style="color: #6898f8;">تصویر شاخص</a>
                    @endif
                </div>
                <form action="{{ route('panel.tickets.send.do', ['ticket' => $ticket->id]) }}" id="send-ticket" name="send-ticket" method="post" class="send-ticket-container" enctype="multipart/form-data">
                    @csrf

                    <div class=" form-control">
                        <textarea spellcheck="false" class="additem-input" name="text"
                            id="article-text-area" data-required="true" placeholder="پیام شما"></textarea>
                    </div>
                    <div class="form-control">
                        <input type="file" name="attachment" id="attachment">
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