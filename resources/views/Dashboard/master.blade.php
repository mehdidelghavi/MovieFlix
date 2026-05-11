@include("Dashboard.partials.header")
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include("Dashboard.partials.aside")
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="container-fluid">
              <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                  <i class="bx bx-menu bx-sm"></i>
                </a>
              </div>

              <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                <ul class="navbar-nav flex-row align-items-center ms-auto">



                  <!-- Notification -->
                  @can ('activity.view')
                    <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                      <i class="bx bx-bell bx-sm"></i>
                      <span class="badge bg-danger rounded-pill badge-notifications">{{ count($notifications) }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end py-0">
                      <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                          <h5 class="text-body mb-0 me-auto secondary-font">اعلان ها</h5>
                        </div>
                      </li>
                      <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                          @foreach ($notifications as $notificationItem)
                            <a href="{{ route('dashboard.announcements', ['announcement' => $notificationItem->id]) }}">
                              <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex">
                                  <div class="flex-grow-1">
                                    <p class="mb-1">{{ Str::limit($notificationItem->message, 60) }}</p>
                                    <small class="text-muted">{{ $notificationItem->created_at->diffForHumans() }}</small>
                                  </div>
                                </div>
                              </li>
                            </a>
                          @endforeach
                        </ul>
                      </li>
                    </ul>
                    </li>
                  @endcan
                  @can ('activity.view')
                    <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                      <i class="bx bx-party bx-sm"></i>
                      {{-- <span class="badge bg-danger rounded-pill badge-notifications">{{ count($activity) }}</span> --}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end py-0">
                      <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                          <h5 class="text-body mb-0 me-auto secondary-font">رخداد ها</h5>
                        </div>
                      </li>
                      <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                          @foreach ($activity as $activityItem)
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  @if ($activityItem->causer->avatar != null)
                                    <img src="{{ asset('users/' . $activityItem->causer->avatar) }}" alt class="w-px-40 h-auto rounded-circle">
                                    @else
                                    <span class="avatar-initial rounded-circle bg-label-danger">{{ mb_substr($activityItem->causer->name, 0, 1) . ' ' . mb_substr($activityItem->causer->family,0 ,1) }}</span>
                                  @endif
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $activityItem->description }}</h6>
                                <p class="mb-1">{{ Str::limit($activityItem->properties['messages'][0], 60) }}</p>
                                <small class="text-muted">{{ $activityItem->created_at->diffForHumans() }}</small>
                              </div>
                            </div>
                          </li>
                          @endforeach
                        </ul>
                      </li>
                      <li class="dropdown-menu-footer border-top">
                        <a href="{{ route('dashboard.activity') }}" class="dropdown-item d-flex justify-content-center p-3">
                          مشاهده همه رخداد ها
                        </a>
                      </li>
                    </ul>
                    </li>
                  @endcan
                  <!--/ Notification -->

                  <!-- User -->
                  <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <div class="avatar avatar-online">
                        <img src="{{ env('APP_URL') . 'users/' . $user->avatar }}" alt class="rounded-circle">
                      </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="{{ route('dashboard.users.edit', ['user' => $user->id]) }}">
                          <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar avatar-online">
                                <img src="{{ env('APP_URL') . 'users/' . $user->avatar }}" alt class="rounded-circle">
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <span class="fw-semibold d-block">{{ $user->name . " " . $user->family }}</span>
                              <small>{{ $user->getRoleNames()[0] }}</small>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <a class="dropdown-item" href="{{ route('dashboard.users.edit', ['user' => $user->id ]) }}">
                          <i class="bx bx-user me-2"></i>
                          <span class="align-middle">پروفایل من</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="{{ route('dashboard.settings.edit') }}">
                          <i class="bx bx-cog me-2"></i>
                          <span class="align-middle">تنظیمات</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="{{ route("login.logout") }}" target="_blank">
                          <i class="bx bx-power-off me-2"></i>
                          <span class="align-middle">خروج</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!--/ User -->
                </ul>
              </div>
            </div>
          </nav>

          <!-- / Navbar -->

          @yield("content")
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

@include("Dashboard.partials.footer")