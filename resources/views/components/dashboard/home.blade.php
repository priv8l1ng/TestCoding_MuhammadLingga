@extends('components.dashboard.layouts.app')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class=" container-fluid " id="kt_content_container">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-12 mb-xl-10">
                    <div class="card border-transparent " data-bs-theme="light" style="background-color: #1C325E;">
                        <!--begin::Body-->
                        <div class="card-body d-flex ps-xl-15">
                            <!--begin::Wrapper-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <div class="position-relative d-flex justify-center items-center flex-column fs-2x z-index-2 fw-bold text-white mb-7">
                                    <span class="me-2">Hallo {{ auth()->user()->nama }},</span>
                                    <span class="me-2 fs-1">Selamat datang di halaman Dapur Lezat</span>
                                    <span class="me-2 fs-1">Silahkan pesan menu yang anda inginkan :D</span>
                                    <span class="me-2 fs-1">Anda login sebagai <span class="position-relative d-inline-block text-danger">
                                            <a href="../pages/user-profile/overview.html" class="text-danger opacity-75-hover text-uppercase">{{ auth()->user()->role }}</a>
                                        </span> </br>
                                    </span>
                                </div>
                                <!--end::Title-->

                                <!--begin::Action-->
                                {{-- <div class="mb-3">
                                    <a href="#" class="btn btn-danger fw-semibold me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">
                                        Get Reward
                                    </a>

                                    <a href="../apps/support-center/overview.html" class="btn btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold">
                                        How to
                                    </a>
                                </div> --}}
                                <!--begin::Action-->
                            </div>
                            <!--begin::Wrapper-->

                            <!--begin::Illustration-->
                            <img src="/assets/media/illustrations/sigma-1/17-dark.png" class="position-absolute me-3 bottom-0 end-0 h-200px" alt="">
                            <!--end::Illustration-->
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
@endsection
