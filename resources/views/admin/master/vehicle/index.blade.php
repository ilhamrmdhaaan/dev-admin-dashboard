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
                        
                        {{-- <div class="nk-block-head-content">
                            <a href="#" onclick="#" class="btn btn-primary btn-md">
                                <em class="icon ni ni-plus"></em>
                                <span>Tambah Obat Pasien OTC</span>
                            </a>
                        </div> --}}

                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                    data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            {{-- <div class="drodown">
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
                                            </div> --}}
                                        </li>
                                        <li>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input onkeyup="search(this)" type="text" name="query"
                                                    autocomplete="off" class="form-control"
                                                    placeholder="Cari data . . ." />
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
@include('admin.master.vehicle.partials._modal_update')
<script>
    const modalAllInOne = '.modal-all-in-one'
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
                    `/request-vehicle/fetch?page=${page}&query=${query}&status=${status}`
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



    // Simpan pasien data otc
        const submitForm = (originalForm) => {
            event.preventDefault();
            $(originalForm).find('.form-control').removeClass('error');
            $(".invalid").remove();
            $.post({
                    url: $(originalForm).attr('action'),
                    data: $(originalForm).serialize(),
                    beforeSend: function() {
                        $(originalForm).find('.tombol-simpan').attr('disabled', true);
                        $(originalForm).find('.text-simpan').text('Menyimpan . . .');
                        $(originalForm).find('.loading-simpan').removeClass('d-none');
                    },
                    complete: function() {
                        $(originalForm).find('.loading-simpan').addClass('d-none');
                        $(originalForm).find('.text-simpan').text('Simpan');
                        $(originalForm).find('.tombol-simpan').attr('disabled', false);

                    }
                })
                .done(response => {
                    $(modal).modal('hide');
                    // $(modalSub).modal('hide');
                    $(originalForm).find('.tombol-simpan').attr('disabled', true);
                    alertSuccess(response.message);
                    setInterval(() => {
                        window.location.reload();
                    }, 1500);
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                    alertError();
                })
            }


        const showModalAllInOne = async (urlModal, urlStore) => {
            event.preventDefault()
            $(`${modalAllInOne} .modal-dialog`).removeClass('modal-md')
            $.get(urlModal)
                .done(res => {
                    $(`${modalAllInOne} #loading-modal`).addClass('d-none')
                    $(`${modalAllInOne} .modal-dialog`).addClass('modal-xl')
                    $(modalAllInOne).modal('show')
                    $(`${modalAllInOne} .modal-body`).html(res.output)
                    $(`${modalAllInOne} form`).attr('action', urlStore)
                    if (res.method == 'put') {
                        $(`${modalAllInOne} form [name=_method]`).val('put')
                    } else {
                        $(`${modalAllInOne} form [name=_method]`).val('post')
                    }
                })
                .fail((errors) => {
                    $(`${modalAllInOne} #loading-modal`).removeClass('d-none')
                    alertError()
                })
        }


        const showModalUpdated = (url) => {
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

        function simpanOtc(originalForm) {
            event.preventDefault();
            $(originalForm).find('.form-control').removeClass('error');
            $(".invalid").remove();
            $.post({
                    url: $(originalForm).attr('action'),
                    data: $(originalForm).serialize(),
                    beforeSend: function() {
                        $(originalForm).find('.tombol-simpan').attr('disabled', true);
                        $(originalForm).find('.text-simpan').text('Menyimpan . . .');
                        $(originalForm).find('.loading-simpan').removeClass('d-none');
                    },
                    complete: function() {
                        $(originalForm).find('.loading-simpan').addClass('d-none');
                        $(originalForm).find('.text-simpan').text('Simpan');
                        $(originalForm).find('.tombol-simpan').attr('disabled', false);
                    }
                })
                .done(response => {
                    alertSuccess(response.message);
                    pindahHalaman(response.url, 1500);
                })
                .fail(errors => {
                    if (errors.status === 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                    alertError();
                })
        }

        // Hapus obat otc
        const removePasienOtc = (url) => {
            event.preventDefault();
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
</script>
@endpush