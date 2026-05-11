@extends('Dashboard.master')
@section("CSS")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/animate-css/animate.css") }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}">
@endsection
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">لیست تیکت ها /</span> نمایش تیکت <span class="text-primary">#{{ $ticket->ticket_number }}</span>
            </h4>
            <div class="app-chat card overflow-hidden">
                <div class="row g-0">
                  <!-- Chat History -->
                  <div class="col app-chat-history bg-body">
                    <div class="chat-history-wrapper">
                      <div class="chat-history-header border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="d-flex overflow-hidden align-items-center">
                            
                            <div class="flex-shrink-0 avatar">
                                @if ($ticket->user_id != null)
                                    @if ($ticket->user->avatar != null)
                                        <img src="{{ asset('storage/users/' . $ticket->user->avatar) }}" alt="{{ $ticket->user->name . " " . $ticket->user->family }}" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                                        @else
                                        <div class="rounded-circle noAvatarTicket">{{ mb_substr($ticket->user->name, 0, 1, 'UTF-8') . " " . mb_substr($ticket->user->family, 0, 1, 'UTF-8') }}</div>
                                    @endif
                                @endif
                            </div>
                            <div class="chat-contact-info flex-grow-1 ms-3">
                              <h6 class="m-0">
                                @if ($ticket->user_id != null)
                                    {{ $ticket->user->name . " " . $ticket->user->family }}
                                    @else
                                    {{ $ticket->email }}
                                @endif
                              </h6>
                              <small class="user-status text-muted">{{ $ticket->subject }}</small>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="chat-history-body bg-body">
                        <ul class="list-unstyled chat-history mb-0">
                            @if ($ticket->user_id == auth()->user()->id)
                                <li class="chat-message">
                                    <div class="d-flex overflow-hidden">
                                    <div class="user-avatar flex-shrink-0 me-3">
                                        <div class="avatar avatar-sm">
                                            @if ($ticket->user->avatar != null)
                                                <img src="{{ asset('storage/users/' . $ticket->user->avatar) }}" alt="{{ $ticket->user->name . " " . $ticket->user->family }}" class="rounded-circle">
                                                @else
                                                <div class="rounded-circle noAvatarTicket">{{ mb_substr($ticket->user->name, 0, 1, 'UTF-8') . " " . mb_substr($ticket->user->family, 0, 1, 'UTF-8') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                        <p class="mb-0">{{ $ticket->text }}</p>
                                        </div>
                                        <div class="text-muted mt-1">
                                        <small>{{ Morilog\Jalali\Jalalian::forge($ticket->created_at)->format('%A, %d %B %Y | H:i') }} <span class="badge bg-label-danger">{{ $ticket->user->getRoleNames()[0] }}</span></small>
                                        <small>attachment</small>
                                        </div>
                                        @if ($ticket->attachment != null)
                                            <div class="mt-1">
                                                <a href="{{ asset('storage/tickets/' . $ticket->attachment) }}">
                                                    <small>attachment</small>
                                                    <i class="bx bx-paperclip bx-sm"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    </div>
                                </li>
                                @else 
                                <li class="chat-message chat-message-right">
                                    <div class="d-flex overflow-hidden">
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                        <p class="mb-0">
                                            {{ $ticket->text }}
                                        </p>
                                        </div>
                                        <div class="text-end text-muted mt-1">
                                        <small>{{ Morilog\Jalali\Jalalian::forge($ticket->created_at)->format('%A, %d %B %Y | H:i') }} 
                                            <span class="badge bg-label-danger">
                                                @if($ticket->user_id != null)
                                                    {{ $ticket->user->getRoleNames()[0] }}
                                                    @else
                                                    احراز هویت نشده
                                                @endif
                                            </span>
                                        </small>
                                        </div>
                                        @if ($ticket->attachment != null)
                                            <div class="text-end mt-1">
                                                <a href="{{ asset('storage/tickets/' . $ticket->attachment) }}">
                                                    <small>attachment</small>
                                                    <i class="bx bx-paperclip bx-sm"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="user-avatar flex-shrink-0 ms-3">
                                        <div class="avatar avatar-sm">
                                            @if ($ticket->user_id != null)
                                                @if ($ticket->user->avatar != null)
                                                    <img src="{{ asset('storage/users/' . $ticket->user->avatar) }}" alt="{{ $ticket->user->name . " " . $ticket->user->family }}" class="rounded-circle">
                                                    @else
                                                    <div class="rounded-circle noAvatarTicket">{{ mb_substr($ticket->user->name, 0, 1, 'UTF-8') . " " . mb_substr($ticket->user->family, 0, 1, 'UTF-8') }} </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    </div>
                                </li>
                            @endif
                            @php
                                if ($ticket->user_id != null){
                                    $previousReply = $ticket->user->id;
                                } else {
                                    $previousReply = 0;
                                }
                            @endphp
                            @foreach ($ticket->replies as $child)
                            @if ($child->user_id == auth()->user()->id)
                                <li class="chat-message">
                                    <div class="d-flex overflow-hidden">
                                        <div class="user-avatar flex-shrink-0 me-3">
                                            <div class="avatar avatar-sm">
                                                @if ($previousReply != $child->user->id)
                                                    @if ($child->user->avatar != null)
                                                        <img src="{{ asset('storage/users/' . $child->user->avatar) }}" alt="{{ $child->user->name . " " . $child->user->family }}" class="rounded-circle">
                                                        @else
                                                        <div class="rounded-circle noAvatarTicket">{{ mb_substr($child->user->name, 0, 1, 'UTF-8') . " " . mb_substr($child->user->family, 0, 1, 'UTF-8') }}</div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                        <p class="mb-0">
                                            {{ $child->text }}
                                        </p>
                                        </div>
                                        <div class="text-muted mt-1">
                                        <small>{{ Morilog\Jalali\Jalalian::forge($child->created_at)->format('%A, %d %B %Y | H:i') }} <span class="badge bg-label-danger">{{ $child->user->getRoleNames()[0] }}</span></small>
                                        </div>
                                        @if ($child->attachment != null)
                                            <div class="mt-1">
                                                <a href="{{ asset('storage/tickets/' . $child->attachment) }}">
                                                    <small>attachment</small>
                                                    <i class="bx bx-paperclip bx-sm"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    </div>
                                </li>
                                @else 
                                <li class="chat-message chat-message-right">
                                    <div class="d-flex overflow-hidden">
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                        <p class="mb-0">{{ $child->text }}</p>
                                        </div>
                                        <div class="text-end text-muted mt-1">
                                        <small>{{ Morilog\Jalali\Jalalian::forge($child->created_at)->format('%A, %d %B %Y | H:i') }} 
                                            <span class="badge bg-label-danger">
                                                {{ $child->user->getRoleNames()[0] }}
                                            </span>
                                        </small>
                                        </div>
                                        @if ($child->attachment != null)
                                            <div class="text-end mt-1">
                                                <a href="{{ asset('storage/tickets/' . $child->attachment) }}">
                                                    <small>attachment</small>
                                                    <i class="bx bx-paperclip bx-sm"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="user-avatar flex-shrink-0 ms-3">
                                        <div class="avatar avatar-sm">
                                        @if($previousReply != $child->user->id)
                                            @if ($child->user->avatar != null)
                                                <img src="{{ asset('storage/users/' . $child->user->avatar) }}" alt="{{ $child->user->name . " " . $child->user->family }}" class="rounded-circle">
                                                @else
                                                <div class="rounded-circle noAvatarTicket">{{ mb_substr($child->user->name, 0, 1, 'UTF-8') . " " . mb_substr($child->user->family, 0, 1, 'UTF-8') }}</div>
                                            @endif
                                        @endif
                                        </div>
                                    </div>
                                    </div>
                                </li>
                            @endif
                            @php
                                $previousReply = $child->user->id;
                            @endphp
                            @endforeach
                        </ul>
                      </div>
                      <!-- Chat message form -->
                      <div class="chat-history-footer shadow-sm">
                        <form class="form-send-message d-flex justify-content-between align-items-center" action="{{ route("dashboard.tickets.answer", ['ticket' => $ticket->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                          <input class="form-control message-input border-0 me-3 shadow-none" name="text" placeholder="پیام خود را اینجا بنویسید">
                          <div class="message-actions d-flex align-items-center">
                            <label for="attach-doc" class="form-label mb-0">
                              <i class="bx bx-paperclip bx-sm cursor-pointer mx-3"></i>
                              <input type="file" id="attach-doc" name="attachment" hidden>
                            </label>
                            <button class="btn btn-primary d-flex send-msg-btn">
                              <i class="bx bx-paper-plane me-md-1 me-0"></i>
                              <span class="align-middle d-md-inline-block d-none">ارسال</span>
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- /Chat History -->

                  <div class="app-overlay"></div>
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
<script src="{{ asset("assets/js/app-chat.js") }}"></script>
@endsection