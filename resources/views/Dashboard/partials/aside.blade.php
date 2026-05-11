<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ route('dashboard.index') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg width="26px" height="26px" viewbox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>آیکن</title>
                  <defs>
                    <lineargradient x1="50%" y1="0%" x2="50%" y2="100%" id="linearGradient-1">
                      <stop stop-color="#5A8DEE" offset="0%"></stop>
                      <stop stop-color="#699AF9" offset="100%"></stop>
                    </lineargradient>
                    <lineargradient x1="0%" y1="0%" x2="100%" y2="100%" id="linearGradient-2">
                      <stop stop-color="#FDAC41" offset="0%"></stop>
                      <stop stop-color="#E38100" offset="100%"></stop>
                    </lineargradient>
                  </defs>
                  <g id="Pages" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Login---V2" transform="translate(-667.000000, -290.000000)">
                      <g id="Login" transform="translate(519.000000, 244.000000)">
                        <g id="Logo" transform="translate(148.000000, 42.000000)">
                          <g id="icon" transform="translate(0.000000, 4.000000)">
                            <path d="M13.8863636,4.72727273 C18.9447899,4.72727273 23.0454545,8.82793741 23.0454545,13.8863636 C23.0454545,18.9447899 18.9447899,23.0454545 13.8863636,23.0454545 C8.82793741,23.0454545 4.72727273,18.9447899 4.72727273,13.8863636 C4.72727273,13.5423509 4.74623858,13.2027679 4.78318172,12.8686032 L8.54810407,12.8689442 C8.48567157,13.19852 8.45300462,13.5386269 8.45300462,13.8863636 C8.45300462,16.887125 10.8856023,19.3197227 13.8863636,19.3197227 C16.887125,19.3197227 19.3197227,16.887125 19.3197227,13.8863636 C19.3197227,10.8856023 16.887125,8.45300462 13.8863636,8.45300462 C13.5386269,8.45300462 13.19852,8.48567157 12.8689442,8.54810407 L12.8686032,4.78318172 C13.2027679,4.74623858 13.5423509,4.72727273 13.8863636,4.72727273 Z" id="Combined-Shape" fill="#4880EA"></path>
                            <path d="M13.5909091,1.77272727 C20.4442608,1.77272727 26,7.19618701 26,13.8863636 C26,20.5765403 20.4442608,26 13.5909091,26 C6.73755742,26 1.18181818,20.5765403 1.18181818,13.8863636 C1.18181818,13.540626 1.19665566,13.1982714 1.22574292,12.8598734 L6.30410592,12.859962 C6.25499466,13.1951893 6.22958398,13.5378796 6.22958398,13.8863636 C6.22958398,17.8551125 9.52536149,21.0724191 13.5909091,21.0724191 C17.6564567,21.0724191 20.9522342,17.8551125 20.9522342,13.8863636 C20.9522342,9.91761479 17.6564567,6.70030817 13.5909091,6.70030817 C13.2336969,6.70030817 12.8824272,6.72514561 12.5388136,6.77314791 L12.5392575,1.81561642 C12.8859498,1.78721495 13.2366963,1.77272727 13.5909091,1.77272727 Z" id="Combined-Shape2" fill="url(#linearGradient-1)"></path>
                            <rect id="Rectangle" fill="url(#linearGradient-2)" x="0" y="0" width="7.68181818" height="7.68181818"></rect>
                          </g>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-2">فرست</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
              <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-divider mt-0"></div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">

            <li class="menu-item @if(Route::is('dashboard.index')) active @endif">
              <a href="{{ route("dashboard.index") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Email">صفحه اصلی</div>
              </a>
            </li>
            @canany(["users.view", "users.create"])
              <li class="menu-item @if(Route::is('dashboard.users') || Route::is('dashboard.users.create')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-user"></i>
                  <div data-i18n="Invoice">کاربران</div>
                </a>
                <ul class="menu-sub">
                  @can('users.view')
                    <li class="menu-item @if(Route::is('dashboard.users')) active @endif">
                      <a href="{{ route("dashboard.users") }}" class="menu-link">
                        <div data-i18n="List">لیست کاربران</div>
                      </a>
                    </li>
                  @endcan
                  @can("users.create")
                    <li class="menu-item @if(Route::is('dashboard.users.create')) active @endif">
                    <a href="{{ route("dashboard.users.create") }}" class="menu-link">
                      <div data-i18n="Preview"> افزودن کاربر</div>
                    </a>
                  </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @canany(['plans.view', 'plans.create'])
              <li class="menu-item @if(Route::is('dashboard.plans') || Route::is('dashboard.plans.create')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
                  <div data-i18n="Users">تعرفه ها</div>
                </a>
                <ul class="menu-sub">
                  @can('plans.view')
                    <li class="menu-item @if(Route::is('dashboard.plans')) active @endif">
                      <a href="{{ route("dashboard.plans") }}" class="menu-link">
                        <div data-i18n="List">لیست تعرفه</div>
                      </a>
                    </li>
                  @endcan
                  @can('plans.create')
                    <li class="menu-item @if(Route::is('dashboard.plans.create')) active @endif">
                      <a href="{{ route("dashboard.plans.create") }}" class="menu-link">
                        <div data-i18n="List">افزودن تعرفه</div>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @canany(['genres.view', 'genres.create'])
              <li class="menu-item @if(Route::is('dashboard.genres') || Route::is('dashboard.genres.create')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-camera-movie"></i>
                  <div data-i18n="Users">ژانر ها</div>
                </a>
                <ul class="menu-sub">
                  @can('genres.view')
                    <li class="menu-item @if(Route::is('dashboard.genres')) active @endif">
                      <a href="{{ route("dashboard.genres") }}" class="menu-link">
                        <div data-i18n="List">لیست ژانر ها</div>
                      </a>
                    </li>
                  @endcan
                  @can('genres.create')
                    <li class="menu-item @if(Route::is('dashboard.genres.create')) active @endif">
                      <a href="{{ route("dashboard.genres.create") }}" class="menu-link">
                        <div data-i18n="List">افزودن ژانر</div>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @canany(['actors.view', 'actors.create'])
              <li class="menu-item @if(Route::is('dashboard.actors') || Route::is('dashboard.actors.create')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-run"></i>
                  <div data-i18n="Users">بازیگران</div>
                </a>
                <ul class="menu-sub">
                  @can('actors.view')
                    <li class="menu-item @if(Route::is('dashboard.actors')) active @endif">
                      <a href="{{ route("dashboard.actors") }}" class="menu-link">
                        <div data-i18n="List">لیست بازیگران</div>
                      </a>
                    </li>
                  @endcan
                  @can('actors.create')
                    <li class="menu-item @if(Route::is('dashboard.actors.create')) active @endif">
                      <a href="{{ route("dashboard.actors.create") }}" class="menu-link">
                        <div data-i18n="List">افزودن بازیگر</div>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @canany(['articles.view', 'articles.create'])
              <li class="menu-item @if(Route::is('dashboard.articles') || Route::is('dashboard.articles.create')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-repost"></i>
                  <div data-i18n="Users">مقاله ها</div>
                </a>
                <ul class="menu-sub">
                  @can('articles.view')
                    <li class="menu-item @if(Route::is('dashboard.articles')) active @endif">
                      <a href="{{ route("dashboard.articles") }}" class="menu-link">
                        <div data-i18n="List">لیست مقاله ها</div>
                      </a>
                    </li>
                  @endcan
                  @can('articles.create')
                    <li class="menu-item @if(Route::is('dashboard.articles.create')) active @endif">
                      <a href="{{ route("dashboard.articles.create") }}" class="menu-link">
                        <div data-i18n="List">افزودن مقاله</div>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @canany(['collections.view', 'collections.create'])
              <li class="menu-item @if(Route::is('dashboard.collections') || Route::is('dashboard.collections.create')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-repost"></i>
                  <div data-i18n="Users">کالکشن ها</div>
                </a>
                <ul class="menu-sub">
                  @can('collections.view')
                    <li class="menu-item @if(Route::is('dashboard.collections')) active @endif">
                      <a href="{{ route("dashboard.collections") }}" class="menu-link">
                        <div data-i18n="List">لیست کالکشن ها</div>
                      </a>
                    </li>
                  @endcan
                  @can('collections.create')
                    <li class="menu-item @if(Route::is('dashboard.collections.create')) active @endif">
                      <a href="{{ route("dashboard.collections.create") }}" class="menu-link">
                        <div data-i18n="List">افزودن کالکشن</div>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @canany(['movies.view', 'movies.create'])
              <li class="menu-item @if(Route::is('dashboard.movies') || Route::is('dashboard.movies.create')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-repost"></i>
                  <div data-i18n="Users">فیلم ها</div>
                </a>
                <ul class="menu-sub">
                  @can('movies.view')
                    <li class="menu-item @if(Route::is('dashboard.movies')) active @endif">
                      <a href="{{ route("dashboard.movies") }}" class="menu-link">
                        <div data-i18n="List">لیست فیلم ها</div>
                      </a>
                    </li>
                  @endcan
                  @can('movies.create')
                    <li class="menu-item @if(Route::is('dashboard.movies.create')) active @endif">
                      <a href="{{ route("dashboard.movies.create") }}" class="menu-link">
                        <div data-i18n="List">افزودن فیلم</div>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @canany(['lists.view', 'lists.create'])
              <li class="menu-item @if(Route::is('dashboard.lists') || Route::is('dashboard.lists.create')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-repost"></i>
                  <div data-i18n="Users">لیست ها</div>
                </a>
                <ul class="menu-sub">
                  @can('lists.view')
                    <li class="menu-item @if(Route::is('dashboard.lists')) active @endif">
                      <a href="{{ route("dashboard.lists") }}" class="menu-link">
                        <div data-i18n="List">لیست ها</div>
                      </a>
                    </li>
                  @endcan
                  @can('lists.create')
                    <li class="menu-item @if(Route::is('dashboard.lists.create')) active @endif">
                      <a href="{{ route("dashboard.lists.create") }}" class="menu-link">
                        <div data-i18n="List">افزودن لیست</div>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @canany(['pr.view', 'pr.create'])
              <li class="menu-item @if(Route::is('dashboard.roles') || Route::is('dashboard.roles.create') || Route::is('dashboard.permissions.create') || Route::is('dashboard.permissions')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-check-shield"></i>
                  <div data-i18n="Roles & Permissions">نقش‌ها و مجوزها</div>
                </a>
                <ul class="menu-sub">
                  @can('pr.view')
                    <li class="menu-item @if(Route::is('dashboard.roles')) active @endif">
                      <a href="{{ route("dashboard.roles") }}" class="menu-link">
                        <div data-i18n="Roles">نقش‌ها</div>
                      </a>
                    </li>
                  @endcan
                  @can('pr.create')
                    <li class="menu-item @if(Route::is('dashboard.roles.create')) active @endif">
                      <a href="{{ route("dashboard.roles.create") }}" class="menu-link">
                        <div data-i18n="Roles">افزودن نقش</div>
                      </a>
                    </li>
                  @endcan
                  @can('pr.view')
                    <li class="menu-item @if(Route::is('dashboard.permissions')) active @endif">
                      <a href="{{ route("dashboard.permissions") }}" class="menu-link">
                        <div data-i18n="Roles">مجوز ها</div>
                      </a>
                    </li>
                  @endcan
                  @can('pr.create')
                    <li class="menu-item @if(Route::is('dashboard.permissions.create')) active @endif">
                      <a href="{{ route("dashboard.permissions.create") }}" class="menu-link">
                        <div data-i18n="Roles">افزودن مجوز</div>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @canany(['requirements.view', 'requirements.create'])
              <li class="menu-item @if(Route::is('dashboard.requirements') || Route::is('dashboard.requirements.create')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-check-shield"></i>
                  <div data-i18n="Roles & Permissions">آموزش ها / نیازمندی ها</div>
                </a>
                <ul class="menu-sub">
                  @can('requirements.view')
                    <li class="menu-item @if(Route::is('dashboard.requirements')) active @endif">
                      <a href="{{ route("dashboard.requirements") }}" class="menu-link">
                        <div data-i18n="Roles">آموزش ها / نیازمندی ها</div>
                      </a>
                    </li>
                  @endcan
                  @can('requirements.create')
                    <li class="menu-item @if(Route::is('dashboard.requirements.create')) active @endif">
                      <a href="{{ route("dashboard.requirements.create") }}" class="menu-link">
                        <div data-i18n="Roles">افزودن آموزش</div>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @canany(['requirements.view', 'requirements.create'])
              <li class="menu-item @if(Route::is('dashboard.newsletter') || Route::is('dashboard.newsletter.create')) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-check-shield"></i>
                  <div data-i18n="Roles & Permissions">خبرنامه</div>
                </a>
                <ul class="menu-sub">
                  @can('requirements.view')
                    <li class="menu-item @if(Route::is('dashboard.newsletter')) active @endif">
                      <a href="{{ route("dashboard.newsletter") }}" class="menu-link">
                        <div data-i18n="Roles">اعضای خبرنامه</div>
                      </a>
                    </li>
                  @endcan
                  @can('requirements.create')
                    <li class="menu-item @if(Route::is('dashboard.newsletter.create')) active @endif">
                      <a href="{{ route("dashboard.newsletter.create") }}" class="menu-link">
                        <div data-i18n="Roles">ارسال خبرنامه</div>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan
            @can('payments.view')
              <li class="menu-item">
                <a href="{{ route('dashboard.payments') }}" class="menu-link @if(Route::is('dashboard.payments')) active @endif">
                  <i class="menu-icon tf-icons bx bx-credit-card"></i>
                  <div data-i18n="Modal Examples">پرداخت ها</div>
                </a>
              </li>
            @endcan
            @can('subscriptions.view')
              <li class="menu-item">
                <a href="{{ route('dashboard.subscriptions') }}" class="menu-link @if(Route::is('dashboard.subscriptions')) active @endif">
                  <i class="menu-icon tf-icons bx bx-basket"></i>
                  <div data-i18n="Modal Examples">اشتراک ها</div>
                </a>
              </li>
            @endcan
            @can('comments.view')
              <li class="menu-item">
                <a href="{{ route('dashboard.comments') }}" class="menu-link @if(Route::is('dashboard.comments')) active @endif">
                  <i class="menu-icon tf-icons bx bx-message"></i>
                  <div data-i18n="Modal Examples">نظرات</div>
                </a>
              </li>
            @endcan
            @can('tickets.view')
              <li class="menu-item">
                <a href="{{ route('dashboard.tickets') }}" class="menu-link @if(Route::is('dashboard.tickets') || Route::is('dashboard.tickets.show')) active @endif">
                  <i class="menu-icon tf-icons bx bx-support"></i>
                  <div data-i18n="Modal Examples">تیکت ها</div>
                </a>
              </li>
            @endcan
          </ul>
        </aside>