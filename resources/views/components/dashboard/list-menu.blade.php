@extends('components.dashboard.layouts.app')

@push('js')
<script src="/assets/js/custom/pages/general/pos.js"></script>
<script src="/assets/js/custom/list-menu/add-menu.js"></script>
@endpush

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div class=" container-fluid " id="kt_content_container">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <div class="d-flex justify-content-between align-items-center">
                    <!--begin::Input group-->
                    <div class="position-relative w-md-400px me-md-2">
                        <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"><span class="path1"></span><span class="path2"></span></i>
                        <input type="text" id="searchMenu" class="form-control form-control-solid ps-10" name="search" value="" placeholder="Search Menu...">
                    </div>
                    <!--end::Input group-->
    
                    <!--begin:Action-->
                    <div class="d-flex align-items-center">               
                        <button type="submit" class="btn btn-primary me-5" data-bs-toggle="modal" data-bs-target="#kt_modal_add_menu">Tambah Menu</button>
                    </div>
                    <!--end:Action-->
                </div>
                <!--end::Compact form-->
            </div>
            <!--end::Card body--> 
        </div>
        <!--end::Card-->
        {{-- <div class="d-flex justify-content-between w-100 gap-2 mb-5">
            <input type="text" id="searchMenu" class="form-control form-control-sm form-control-solid" placeholder="Cari menu...">
            <button class="btn btn-sm btn-primary w-250px">Tambah Menu</button>
        </div> --}}
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-xl-row">
            <!--begin::Content-->
            <div class="d-flex flex-row-fluid me-xl-9 mb-10 mb-xl-0">
                <!--begin::Pos food-->
                <div class="card card-flush cardInner card-p-0 bg-transparent border-0 ">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Nav-->
                        {{-- <ul class="nav nav-pills d-flex justify-content-between nav-pills-custom gap-3 mb-6">

                            <!--begin::Item-->
                            <li class="nav-item mb-3 me-0">
                                <!--begin::Nav link-->
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack pt-9 pb-7 page-bg show active"
                                    data-bs-toggle="pill" href="#kt_pos_food_content_1"
                                    style="width: 138px;height: 180px">
                                    <!--begin::Icon-->
                                    <div class="nav-icon mb-3">
                                        <!--begin::Food icon-->
                                        <img src="/assets/media/svg/food-icons/spaghetti.svg" class="w-50px"
                                            alt="" />
                                        <!--end::Food icon-->
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Info-->
                                    <div class="">
                                        <span class="text-gray-800 fw-bold fs-2 d-block">Lunch</span>
                                        <span class="text-gray-400 fw-semibold fs-7">8 Options</span>
                                    </div>
                                    <!--end::Info-->
                                </a>
                                <!--end::Nav link-->
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="nav-item mb-3 me-0">
                                <!--begin::Nav link-->
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack pt-9 pb-7 page-bg "
                                    data-bs-toggle="pill" href="#kt_pos_food_content_2"
                                    style="width: 138px;height: 180px">
                                    <!--begin::Icon-->
                                    <div class="nav-icon mb-3">
                                        <!--begin::Food icon-->
                                        <img src="/assets/media/svg/food-icons/salad.svg" class="w-50px"
                                            alt="" />
                                        <!--end::Food icon-->
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Info-->
                                    <div class="">
                                        <span class="text-gray-800 fw-bold fs-2 d-block">Salad</span>
                                        <span class="text-gray-400 fw-semibold fs-7">14 Salads</span>
                                    </div>
                                    <!--end::Info-->
                                </a>
                                <!--end::Nav link-->
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="nav-item mb-3 me-0">
                                <!--begin::Nav link-->
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack pt-9 pb-7 page-bg "
                                    data-bs-toggle="pill" href="#kt_pos_food_content_3"
                                    style="width: 138px;height: 180px">
                                    <!--begin::Icon-->
                                    <div class="nav-icon mb-3">
                                        <!--begin::Food icon-->
                                        <img src="/assets/media/svg/food-icons/cheeseburger.svg" class="w-50px"
                                            alt="" />
                                        <!--end::Food icon-->
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Info-->
                                    <div class="">
                                        <span class="text-gray-800 fw-bold fs-2 d-block">Burger</span>
                                        <span class="text-gray-400 fw-semibold fs-7">5 Burgers</span>
                                    </div>
                                    <!--end::Info-->
                                </a>
                                <!--end::Nav link-->
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="nav-item mb-3 me-0">
                                <!--begin::Nav link-->
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack pt-9 pb-7 page-bg "
                                    data-bs-toggle="pill" href="#kt_pos_food_content_4"
                                    style="width: 138px;height: 180px">
                                    <!--begin::Icon-->
                                    <div class="nav-icon mb-3">
                                        <!--begin::Food icon-->
                                        <img src="/assets/media/svg/food-icons/coffee.svg" class="w-50px"
                                            alt="" />
                                        <!--end::Food icon-->
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Info-->
                                    <div class="">
                                        <span class="text-gray-800 fw-bold fs-2 d-block">Coffee</span>
                                        <span class="text-gray-400 fw-semibold fs-7">7 Beverages</span>
                                    </div>
                                    <!--end::Info-->
                                </a>
                                <!--end::Nav link-->
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="nav-item mb-3 me-0">
                                <!--begin::Nav link-->
                                <a class="nav-link nav-link-border-solid btn btn-outline btn-flex btn-active-color-primary flex-column flex-stack pt-9 pb-7 page-bg "
                                    data-bs-toggle="pill" href="#kt_pos_food_content_5"
                                    style="width: 138px;height: 180px">
                                    <!--begin::Icon-->
                                    <div class="nav-icon mb-3">
                                        <!--begin::Food icon-->
                                        <img src="/assets/media/svg/food-icons/cheesecake.svg" class="w-50px"
                                            alt="" />
                                        <!--end::Food icon-->
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Info-->
                                    <div class="">
                                        <span class="text-gray-800 fw-bold fs-2 d-block">Dessert</span>
                                        <span class="text-gray-400 fw-semibold fs-7">8 Desserts</span>
                                    </div>
                                    <!--end::Info-->
                                </a>
                                <!--end::Nav link-->
                            </li>
                            <!--end::Item-->

                        </ul> --}}
                        <!--end::Nav-->

                        <div class="d-flex w-100 justify-content-center">
                            <span id="messageMenuNotFound" class="fw-bold fs-1 text-center d-none">Menu tidak ditemukan.</span>
                        </div>

                        <!--begin::Tab Content-->
                        <div class="tab-content">
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade show active" id="kt_pos_food_content_1">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-wrap d-grid gap-5 gap-xxl-9">
                                    @foreach ($menu as $item)
                                    <!--begin::Card-->
                                    <div class="card card-flush cardMenu flex-row-fluid p-6 pb-5 mw-100">
                                        <!--begin::Body-->
                                        <div class="card-body text-center">
                                            <!--begin::Food img-->
                                            <img src="/foto-makanan/{{ $item->foto }}"
                                                class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px"
                                                alt="" />
                                            <!--end::Food img-->

                                            <!--begin::Info-->
                                            <div class="mb-2">
                                                <!--begin::Title-->
                                                <div class="text-center">
                                                    <span
                                                        class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{ $item->nama_menu }}</span>

                                                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1">{{ $item->deskripsi }}</span>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Info-->

                                            <!--begin::Total-->
                                            <span class="text-success text-end fw-bold fs-1">Rp. {{ number_format($item->harga, 0, ',', '.') }}</span>
                                            <!--end::Total-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card-->
                                    @endforeach
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                        </div>
                        <!--end::Tab Content-->
                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end::Pos food-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Layout-->
    </div>
    <!--end::Container-->
</div>

<div class="modal fade" tabindex="-1" id="kt_modal_add_menu">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu Makanan</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-kt-users-modal-action="close" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form id="kt_modal_add_menu_form" class="form" action="#">
                    @csrf
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Nama Menu</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="" name="nama_menu" value="" />
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Harga</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="" name="harga" value="" />
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Kategori</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="" name="kategori" value="" />
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Deskripsi</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="" name="deskripsi" value="" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="form-group row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label text-lg-right">Unggah Foto:</label>
                        <!--end::Label-->

                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Dropzone-->
                            <div class="dropzone dropzone-queue mb-2" id="kt_dropzonejs_example_3">
                                <!--begin::Controls-->
                                <div class="dropzone-panel mb-lg-0 mb-2">
                                    <a class="dropzone-select btn btn-sm btn-primary me-2">Lampirkan Foto</a>
                                    <a class="dropzone-remove-all btn btn-sm btn-light-primary">Hapus Semua</a>
                                </div>
                                <!--end::Controls-->

                                <!--begin::Items-->
                                <div class="dropzone-items wm-200px">
                                    <div class="dropzone-item" style="display:none">
                                        <!--begin::File-->
                                        <div class="dropzone-file">
                                            <div class="dropzone-filename" title="some_image_file_name.jpg">
                                                <span data-dz-name>some_image_file_name.jpg</span>
                                                <strong>(<span data-dz-size>340kb</span>)</strong>
                                            </div>

                                            <div class="dropzone-error" data-dz-errormessage></div>
                                        </div>
                                        <!--end::File-->

                                        <!--begin::Progress-->
                                        <div class="dropzone-progress">
                                            <div class="progress">
                                                <div
                                                    class="progress-bar bg-primary"
                                                    role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Progress-->

                                        <!--begin::Toolbar-->
                                        <div class="dropzone-toolbar">
                                            <span class="dropzone-delete" data-dz-remove><i class="bi bi-x fs-1"></i></span>
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Dropzone-->

                            <!--begin::Hint-->
                            <span class="form-text text-muted">Max file size is 5MB and max number of files is 1.</span>
                            <!--end::Hint-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-kt-users-modal-action="cancel">Batal</button>
                <button type="button" class="btn btn-primary" data-kt-users-modal-action="submit">Kirim</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $("#searchMenu").keyup(function() {
            var value = $(this).val().toLowerCase();
            $(".cardMenu").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            }).show();

            if ($(".cardMenu:visible").length == 0) {
                $(".cardInner").addClass('w-100');
                $("#messageMenuNotFound").removeClass('d-none');
            } else {
                $(".cardInner").removeClass('w-100');
                $("#messageMenuNotFound").addClass('d-none');
            }
        });
    });
</script>
@endpush
