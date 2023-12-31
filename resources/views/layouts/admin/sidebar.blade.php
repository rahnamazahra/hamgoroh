<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="">
            <img alt="Logo" src="{{ asset('admin/assets/media/logos/fav.png') }}" class="h-25px logo" />
            <span style="color:white">مدیریت سـامانه هـم گـروه</span>
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                @can('admin-index')
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard')}}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">داشبورد‌</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <div class="menu-content">
                            <div class="separator mx-1 my-4"></div>
                        </div>
                    </div>
                @endcan
                @canany(['permissions-index', 'permissions-create', 'permissions-update', 'permissions-delete', 'roles-index', 'roles-create', 'roles-update', 'roles-delete'])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::routeIs('admin.permissions.index') || Request::routeIs('admin.roles.index') ? 'hover show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                        <path d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">نقش‌ها و دسترسی‌ها</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @can('roles-index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.roles.index') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">لیست نقش‌ها</span>
                                    </a>
                                </div>
                            @endcan
                            @can('permissions-index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.permissions.index') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">لیست دسترسی‌ها</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endcanany
                @canany(['users-index', 'users-create', 'users-update', 'users-delete'])
                    <div class="menu-item">
                            <a class="menu-link {{ Request::routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
                                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">کاربران</span>
                        </a>
                    </div>
                @endcan
                @canany(['provinces-index', 'provinces-create', 'provinces-update', 'provinces-delete', 'cities-index', 'cities-create', 'cities-update', 'cities-delete'])
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('admin.provinces.index') ? 'active' : '' }}" href="{{ route('admin.provinces.index') }}" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M18.0624 15.3454L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3454C4.56242 13.6454 3.76242 11.4452 4.06242 8.94525C4.56242 5.34525 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24525 19.9624 9.94525C20.0624 12.0452 19.2624 13.9454 18.0624 15.3454ZM13.0624 10.0453C13.0624 9.44534 12.6624 9.04534 12.0624 9.04534C11.4624 9.04534 11.0624 9.44534 11.0624 10.0453V13.0453H13.0624V10.0453Z" fill="currentColor" />
                                        <path d="M12.6624 5.54531C12.2624 5.24531 11.7624 5.24531 11.4624 5.54531L8.06241 8.04531V12.0453C8.06241 12.6453 8.46241 13.0453 9.06241 13.0453H11.0624V10.0453C11.0624 9.44531 11.4624 9.04531 12.0624 9.04531C12.6624 9.04531 13.0624 9.44531 13.0624 10.0453V13.0453H15.0624C15.6624 13.0453 16.0624 12.6453 16.0624 12.0453V8.04531L12.6624 5.54531Z" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">استان / شهرستان</span>
                        </a>
                    </div>
                @endcan
                @canany(['competitions-index', 'competitions-create', 'competitions-update', 'competitions-delete'])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::routeIs('admin.competitions.index') ? 'hover show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M14 18V16H10V18L9 20H15L14 18Z" fill="currentColor"/>
                                        <path opacity="0.3" d="M20 4H17V3C17 2.4 16.6 2 16 2H8C7.4 2 7 2.4 7 3V4H4C3.4 4 3 4.4 3 5V9C3 11.2 4.8 13 7 13C8.2 14.2 8.8 14.8 10 16H14C15.2 14.8 15.8 14.2 17 13C19.2 13 21 11.2 21 9V5C21 4.4 20.6 4 20 4ZM5 9V6H7V11C5.9 11 5 10.1 5 9ZM19 9C19 10.1 18.1 11 17 11V6H19V9ZM17 21V22H7V21C7 20.4 7.4 20 8 20H16C16.6 20 17 20.4 17 21ZM10 9C9.4 9 9 8.6 9 8V5C9 4.4 9.4 4 10 4C10.6 4 11 4.4 11 5V8C11 8.6 10.6 9 10 9ZM10 13C9.4 13 9 12.6 9 12V11C9 10.4 9.4 10 10 10C10.6 10 11 10.4 11 11V12C11 12.6 10.6 13 10 13Z" fill="currentColor"/>
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">دوره‌های مسابقات</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @can('fields-index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.fields.index') ? 'active' : '' }}" href="{{ route('admin.fields.index') }}" data-bs-trigger="hover" data-bs-dismiss="click">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">رشته‌ها</span>
                                    </a>
                                </div>
                            @endcan
                            @can('competitions-index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.competitions.index') ? 'active' : '' }}" href="{{ route('admin.competitions.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">لیست دوره‌های مسابقات</span>
                                    </a>
                                </div>
                            @endcan
                            @can('competitions-create')
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.competitions.create') ? 'active' : '' }}" href="{{ route('admin.competitions.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">ایجاد دوره‌ی مسابقه</span>
                                    </a>
                                </div>
                            @endcan
                            @can('criteria-index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.criteria.index') ? 'active' : '' }}" href="{{ route('admin.criteria.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">معیار نمره دهی</span>
                                    </a>
                                </div>
                            @endcan
                            @can('tests-index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.tests.index') ? 'active' : '' }}" href="{{ route('admin.tests.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">آزمون چهارگزینه‌ای</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endcanany
                @canany(['news-index', 'news-create', 'news-update', 'news-delete'])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::routeIs('admin.news.index') ? 'hover show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="currentColor"/>
                                <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor"/>
                                <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor"/>
                                <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor"/>
                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">اخبار</span>
                        <span class="menu-arrow"></span>
                    </span>
                        <div class="menu-sub menu-sub-accordion">
                            @can('news-index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.news.index') ? 'active' : '' }}" href="{{ route('admin.news.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">لیست اخبار</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.newsCategories.index') ? 'active' : '' }}" href="{{ route('admin.newsCategories.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title"> دسته بندی اخبار</span>
                                    </a>
                                </div>
                            @endcan
                        </div>


                    </div>
                @endcanany
                @canany(['setting-index'])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::routeIs('admin.contacts.index') ? 'hover show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="currentColor"/>
                                    <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">تنظیمات</span>
                        <span class="menu-arrow"></span>
                    </span>
                        <div class="menu-sub menu-sub-accordion">

                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.contacts.index') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">تماس باما</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('admin.abouts.index') ? 'active' : '' }}" href="{{ route('admin.abouts.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">درباره ما</span>
                                    </a>
                                </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Request::routeIs('admin.settings.index') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">تنظیمات سایت</span>
                                </a>
                            </div>

                        </div>


                    </div>
                @endcanany
                @canany(['notices-index', 'notices-create', 'notices-update', 'notices-delete'])
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('admin.notices.index') ? 'active' : '' }}" href="{{ route('admin.notices.index') }}" title="اطلاعیه‌ها" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="رشته‌ها">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: assets/media/icons/duotune/maps/map008.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M19.0003 4.40002C18.2003 3.50002 17.1003 3 15.8003 3C14.1003 3 12.5003 3.99998 11.8003 5.59998C11.0003 7.39998 11.9004 9.49993 11.2004 11.2999C10.1004 14.2999 7.80034 16.9 4.90034 17.9C4.50034 18 3.80035 18.2 3.10035 18.2C2.60035 18.3 2.40034 19 2.90034 19.2C4.40034 19.8 6.00033 20.2 7.80033 20.2C15.8003 20.2 20.2004 13.5999 20.2004 7.79993C20.2004 7.59993 20.2004 7.39995 20.2004 7.19995C20.8004 6.69995 21.4003 6.09993 21.9003 5.29993C22.2003 4.79993 21.9003 4.19998 21.4003 4.09998C20.5003 4.19998 19.7003 4.20002 19.0003 4.40002Z" fill="currentColor"/>
                                    <path d="M11.5004 8.29997C8.30036 8.09997 5.60034 6.80004 3.30034 4.50004C2.90034 4.10004 2.30037 4.29997 2.20037 4.79997C1.60037 6.59997 2.40035 8.40002 3.90035 9.60002C3.50035 9.60002 3.10037 9.50007 2.70037 9.40007C2.40037 9.30007 2.00036 9.60004 2.10036 10C2.50036 11.8 3.60035 12.9001 5.40035 13.4001C5.10035 13.5001 4.70034 13.5 4.30034 13.6C3.90034 13.6 3.70035 14.1001 3.90035 14.4001C4.70035 15.7001 5.90036 16.5 7.50036 16.5C8.80036 16.5 10.1004 16.5 11.2004 15.8C12.7004 14.9 13.9003 13.2001 13.8003 11.4001C13.9003 10.0001 13.1004 8.39997 11.5004 8.29997Z" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                            <span class="menu-title">اطلاعیه‌ها</span>
                        </a>
                    </div>
                @endcanany
            </div>
        </div>
        <!--end::Aside menu-->
    </div>
</div>
