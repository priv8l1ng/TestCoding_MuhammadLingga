<div id="kt_aside" class="aside pt-7 pb-4 pb-lg-7 pt-lg-17 " data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_toggle">

    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto px-9 mb-9 mb-lg-17 mx-auto" id="kt_aside_logo">
        <span class="text-center fw-bold fs-2x">Dapur Lezat</span>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->

    <!--begin::Aside user-->
    <div class="aside-user mb-5 mb-lg-10" id="kt_aside_user">
        <!--begin::User-->
        <div class="d-flex align-items-center flex-column">
            <!--begin::Symbol-->
            <div class="symbol symbol-75px mb-4">
                <img src="/assets/media/avatars/{{ auth()->user()->foto == null ? 'cyberfiction-1.png' : auth()->user()->foto }}" alt="" />
            </div>
            <!--end::Symbol-->

            <!--begin::Info-->
            <div class="text-center">
                <!--begin::Username-->
                <a href="javascript:void(0);"
                    class="text-gray-800 text-hover-primary fs-4 fw-bolder">{{ Auth::check() ? auth()->user()->nama : 'Anonymous' }}</a>
                <!--end::Username-->

                <!--begin::Description-->
                <span class="text-gray-600 fw-semibold d-block fs-7 mb-1 text-capitalize">{{ Auth::check() ? auth()->user()->role : 'Anonymous' }}</span>
                <!--end::Description-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::User-->
    </div>
    <!--end::Aside user-->

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid ps-3 ps-lg-5 pe-1 mb-9" id="kt_aside_menu">
        <!--begin::Aside Menu-->
        <div class="w-100 hover-scroll-overlay-y pe-2 me-2" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_user, #kt_aside_footer"
            data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu, #kt_aside_menu_wrapper" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention menu-active-bg fw-semibold" id="#kt_aside_menu"
                data-kt-menu="true">
                <!--begin:Menu item-->
                <div class="menu-item here">
                    <!--begin:Menu link-->
                    <a href="{{ route('dashboard-home') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-home-2 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Home</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item here">
                    <!--begin:Menu link-->
                    <a href="{{ route('dashboard-listMenu') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-home-2 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">List Menu Makanan</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->

    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto px-6 px-lg-9" id="kt_aside_footer">
        <!--begin::User panel-->
        <div class="d-flex flex-stack ms-7">
            <!--begin::Link-->
            <a href="javascript:void(0);" onclick="this.closest('form').submit();"
                class="btn btn-sm btn-icon btn-active-color-primary btn-icon-gray-600 btn-text-gray-600">
                <i class="ki-duotone ki-entrance-left fs-1 me-2"><span class="path1"></span><span
                        class="path2"></span></i>

                <!--begin::Major-->
                <span class="d-flex flex-shrink-0 fw-bold">
                    <form action="/dashboard/logout" method="post">
                        @csrf
                        <span onclick="this.closest('form').submit();">
                            Keluar
                        </span>
                    </form>
                </span span>
                <!--end::Major-->
            </a>
            <!--end::Link-->

            <!--begin::User menu-->
            <div class="ms-1">
                <div class="btn btn-sm btn-icon btn-icon-gray-600 btn-active-color-primary position-relative me-n1"
                    data-kt-menu-trigger="click" data-kt-menu-overflow="true" data-kt-menu-placement="top-start">
                    <i class="ki-duotone ki-setting-2 fs-1"><span class="path1"></span><span
                            class="path2"></span></i>
                </div>

                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                    data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="/assets/media/avatars/{{ auth()->user()->foto ?? "cyberfiction-1.png" }}" />
                            </div>
                            <!--end::Avatar-->

                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5">
                                    {{ auth()->user()->nama }} <span
                                        class="badge badge-light-{{ auth()->user()->role == 'customer' ? 'primary' : 'warning' }} fw-bold text-capitalize fs-8 px-2 py-1 ms-2">{{ auth()->user()->role }}</span>
                                </div>

                                <a href="javascript:void(0);" class="fw-semibold text-muted text-hover-primary fs-7">
                                    {{ auth()->user()->email }} </a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-5 my-1">
                        <a href="/dashboard/account-settings" class="menu-link px-5">
                            Pengaturan Akun
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <form action="/dashboard/logout" method="post">
                            @csrf
                            <a href="javascript:void(0);" onclick="this.closest('form').submit();" class="menu-link px-5">
                                Keluar
                            </a>
                        </form>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::User account menu-->
            </div>
            <!--end::User menu-->
        </div>
        <!--end::User panel-->
    </div>
    <!--end::Footer-->
</div>