<div class="user__profile">
    <a href="javascript:void(0)" title="اعلان ها" id="notification-icon">
        @if (count($announcements) > 0)
        <span class="notification-counts">{{ count($announcements) }}</span>
        @endif
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
            xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
            width="512" height="512" x="0" y="0" viewBox="0 0 24 24"
            style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
            <g>
                <g xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m21.379 16.913c-1.512-1.278-2.379-3.146-2.379-5.125v-2.788c0-3.519-2.614-6.432-6-6.92v-1.08c0-.553-.448-1-1-1s-1 .447-1 1v1.08c-3.387.488-6 3.401-6 6.92v2.788c0 1.979-.867 3.847-2.388 5.133-.389.333-.612.817-.612 1.329 0 .965.785 1.75 1.75 1.75h16.5c.965 0 1.75-.785 1.75-1.75 0-.512-.223-.996-.621-1.337z">
                    </path>
                    <path d="m12 24c1.811 0 3.326-1.291 3.674-3h-7.348c.348 1.709 1.863 3 3.674 3z">
                    </path>
                </g>
            </g>
        </svg>
    </a>
    <!-- black mask -->
    <div class="mask"></div>
    <!-- user notifications nav -->
    <ul class="user__notification">
        <div class="user-notification-title">
            <h2>اعلان ها</h2>
            <button class="close-notification-bar" title="بستن">
                <i class="fa fa-times-circle"></i>
            </button>
        </div>
        @foreach ($announcements as $announcementItem)
            <li class="notification-lists">
                <a href="{{ $announcementItem->linkFormat() }}" title="مشاهده" class="notification-container">
                    <div class="notification-box mb-1">
                        <div>
                            <i class="fas fa-envelope"></i>
                            <p>{{ $announcementItem->titleFormat() }}</p>
                        </div>
                        <div>
                            <time>
                                <span>{{ Illuminate\Support\Carbon::create($announcementItem->created_at)->diffForHumans() }}</span>
                            </time>
                        </div>
                    </div>
                    <div class="notification-box">
                        <span>{{ Str::limit($announcementItem->message,50) }}</span>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    <!-- --------------------------------------------------- -->
    <div class="user__profile__img" id="user-actions-button">
        <img src="{{ asset('users/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name . " " . auth()->user()->family }}">
    </div>
    <ul class="user__actions" id="user-actions-links">
        <li class="user__actions__items"><a href="{{ route('panel.account') }}">ویرایش اطلاعات</a></li>
        <li class="user__actions__items"><a href="{{ route('panel.tickets.send') }}">ارسال تیکت</a></li>
        <li class="user__actions__items"><a href="{{ route('panel.logout') }}" class="logout__panel"
                id="logout-button">خروج از
                حساب</a></li>
    </ul>
</div>