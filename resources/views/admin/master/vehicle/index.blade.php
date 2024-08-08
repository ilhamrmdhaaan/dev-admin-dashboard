@extends('layouts.admin.master', ['title' => $title])


@section('admin-content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                {!! $title !!}
                            </h3>
                        </div>
                    </div>

                    {{-- Head --}}
                    <div class="nk-block-between mt-4">
                        <div class="nk-block-head-content">
                            <a href="#" onclick="showModalCreate(`{{ route('master-request-vehicle.store') }}`)" class="btn btn-primary btn-md">
                                <em class="icon ni ni-plus"></em>
                                <span>Add Request</span>
                            </a>
                        </div>


                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <!-- {{-- <div class="drodown">
                                                <a href="#"
                                                    class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                    data-toggle="dropdown" aria-expanded="false">Filter Berdasarkan
                                                    Status Dilayani</a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a href="" onclick="filterStatus(`semua`)">
                                                                <span class="text-uppercase">
                                                                    Semua
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" onclick="filterStatus(`selesai`)"><input
                                                                    type="hidden" name="status" />
                                                                <span class="text-uppercase">
                                                                    Sudah Dilayani
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" onclick="filterStatus(`belum selesai`)"><input
                                                                    type="hidden" name="status" />
                                                                <span class="text-uppercase">
                                                                    Belum Dilayani
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div> --}} -->
                                        </li>
                                        <li>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input onkeyup="search(this)" type="text" name="query" autocomplete="off" class="form-control" placeholder="Cari data . . ." />
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="loader card-inner p-0">
                    <div class="d-flex justify-content-center my-5">
                        <div class="spinner-grow text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="nk-block fetch-data d-none">
                    @includeIf('admin.master.vehicle.fetch')
                    <input type="hidden" name="page" value="1" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push('js')
@include('admin.master.vehicle.partials._modal_create')
{{-- @include('admin.master.vehicle.partials._modal_create_v2') --}}
@include('admin.master.vehicle.partials._modal_update')

<script>
    // const modalAllInOne = '.modal-all-in-one'
    const modalCreate = '.modal-create'
    // const modalCreateV2 = '.modal-create-v2'
    const modalUpdated = '.modal-update'

    $(document).ready(function() {
        $(".fetch-data").removeClass("d-none");
        $(".loader").addClass("d-none");
    });

    async function fetchData(
        page = "",
        query = "",
        status = ""

    ) {
        await $.get(
                `/master-request-vehicle/fetch?page=${page}&query=${query}&status=${status}`
            )
            .done((data) => {
                $(".loader").addClass("d-none");
                $(".fetch-data").removeClass("d-none");
                $(".fetch-data").html(data);
            })
            .fail((error) => {
                $(".loader").addClass("d-none");
                modalError();
            });
    }

    function search(el) {
        let query = $(el).val(),
            page = $("input[name=page]").val();
        $(".loader").removeClass("d-none");
        $(".fetch-data").addClass("d-none");
        fetchData(page, query, status);
    }

    $(document).on("click", ".pagination a", function(e) {
        e.preventDefault();
        let page = $(this).attr("href").split("page=")[1],
            query = $("input[name=query]").val(),
            status = $("input[name=status]").val();
        $(".loader").removeClass("d-none");
        $(".fetch-data").addClass("d-none");
        fetchData(page, query, status);
    });

    function filterStatus(status) {
        event.preventDefault();
        let page = $("input[name=page]").val(),
            query = $("input[name=query]").val();
        fetchData(page, query, status);
    }



    // Submit Data Form
    const submitForm = (originalForm) => {
        event.preventDefault();
        $.post({
                url: $(originalForm).attr('action'),
                data: new FormData(originalForm),
                beforeSend: function() {
                    $(originalForm).find('.tombol-simpan').attr('disabled', true);
                    $(originalForm).find('.text-simpan').text('Menyimpan . . .');
                    $(originalForm).find('.loading-simpan').removeClass('d-none');
                },
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                complete: function() {
                    $(originalForm).find('.loading-simpan').addClass('d-none');
                    $(originalForm).find('.text-simpan').text('Simpan');
                    $(originalForm).find('.tombol-simpan').attr('disabled', false);
                }
            })
            .done((response) => {
                $(modalCreate).modal('hide');
                // $(modalUpdated).modal('hide');
                // pindahHalaman(reloadHalaman(), 1000);
                alertSuccess(response.message);
                $(originalForm).find('.tombol-simpan').attr('disabled', true);
            })
            .fail((errors) => {
                if (errors.status === 422) {
                    loopErrors(errors.responseJSON.errors);
                    return;
                }
                alertError();
            });
    }
    



    // const showModalAllInOne = async (urlModal, urlStore) => {
    //     event.preventDefault()
    //     $(`${modalAllInOne} .modal-dialog`).removeClass('modal-md')
    //     $.get(urlModal)
    //         .done(res => {
    //             $(`${modalAllInOne} #loading-modal`).addClass('d-none')
    //             $(`${modalAllInOne} .modal-dialog`).addClass('modal-xl')
    //             $(modalAllInOne).modal('show')
    //             $(`${modalAllInOne} .modal-body`).html(res.output)
    //             $(`${modalAllInOne} form`).attr('action', urlStore)
    //             if (res.method == 'put') {
    //                 $(`${modalAllInOne} form [name=_method]`).val('put')
    //             } else {
    //                 $(`${modalAllInOne} form [name=_method]`).val('post')
    //             }
    //         })
    //         .fail((errors) => {
    //             $(`${modalAllInOne} #loading-modal`).removeClass('d-none')
    //             alertError()
    //         })
    // }

    // Show Modal Create
    const showModalCreate = (urlStore) => {
        event.preventDefault()
        $(modalCreate).modal('show')
        $('.modal-title').text('Form Add Request')
        $(`${modalCreate} form`).attr('action', urlStore)
        $(`${modalCreate} [name=_method]`).val('post')
    }

    // const showModalCreateV2 = (urlStoreV2) => {
    //     event.preventDefault()
    //     $(modalCreateV2).modal('show')
    //     $('.modal-title').text('Form Add Request')
    //     $(`${modalCreateV2} form`).attr('action', urlStoreV2)
    //     $(`${modalCreateV2} [name=_method]`).val('post')
    // }

    // Show Modal Updated
    const showModalUpdated = (url, urlUpdate) => {
        event.preventDefault()
        $.get(url)
            .done(response => {
                resetForm(`${modalUpdated} form`)
                $(modalUpdated).modal('show')
                $(`${modalUpdated} .modal-title`).text("Form Update Request")
                loopForm(response.data)
                $(`${modalUpdated} form`).attr('action', urlUpdate)
                $(`${modalUpdated} [name=_method]`).val('put')
            })
            .fail(errors => {
                alertError();
                return;
            });

    }


    // Remove Request
    const removeRequest = (url) => {
        event.preventDefault();
        Swal.fire({
            title: "Apakah anda yakin menghapus data ini?",
            text: "Data yang sudah dihapus tidak dapat dikembalikan lagi!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                        url: url,
                        data: {
                            _method: "DELETE",
                        },
                    })
                    .done(response => {
                        alertSuccess(response.message)
                        pindahHalaman(response.url, 1500)
                    })
            }
        })
    }
</script>
@endpush
