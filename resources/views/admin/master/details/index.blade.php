@extends('layouts.admin.master', ['title' => $title])

@section('admin-content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-lg">
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
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                    data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        {{-- <li>
                                            <div class="drodown">
                                                <a href="#"
                                                    class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-success text-dark"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    Add Request</a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a href="#"
                                                                onclick="showModalCreateBarang(`{{ route('master-request-details.store') }}`)">
                                                                <em class="icon ni ni-plus"></em>
                                                                Satu Persatu
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block-head-content"></div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                    data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        {{-- <li>
                                            <div class="form-group">
                                                <div class="form-control-wrap ">
                                                    <select onchange="filterPoli(this)" class="form-select select2"
                                                        style="position:absolute;" name="poli" data-search="on"
                                                        data-placeholder="Filter berdasarkan poli">
                                                        <option label="Pilih data" disabled selected value="">
                                                        </option>
                                                        <option value="semua">
                                                            Semua
                                                        </option>
                                                        @foreach ($poli as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ Str::title($item->nama) }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </li> --}}
                                        {{-- <li>
                                            <div class="form-group">
                                                <div class="form-control-wrap ">
                                                    <select onchange="filterDokter(this)" class="form-select select2"
                                                        style="position:absolute;" name="dokter" data-search="on"
                                                        data-placeholder="Filter berdasarkan dokter">
                                                        <option label="Pilih data" disabled selected value="">
                                                        </option>
                                                        @foreach ($dokter as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </li> --}}
                                        {{-- <li>
                                            <div class="drodown">
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
                                            </div>
                                        </li> --}}
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
                    @includeIf('admin.master.details.fetch')
                    <input type="hidden" name="page" value="1" />
                </div>
            </div>
        </div>
    </div>
</div>

@includeIf('admin.master.details.partials._modal_create')
{{-- @includeIf('admin.master.barang.partials._modal_update') --}}
{{-- @includeIf('admin.master.barang.partials._modal_import') --}}

@endsection

@push('js')
<script>
    const modal = '.modal-form';
    const modalUpdate = '.modal-update';

    // Modal upload
    const modalImportBarang = '#modal-upload';


    const showModalImportBarang = (url) => {
        event.preventDefault()
        $(modalImportBarang).modal('show')
        $(`${modalImportBarang} form`).attr('action', url)
    }

    const showModalCreateBarang = (urlStore) => {
        event.preventDefault()
        $(modal).modal('show')
        $('.modal-title').text('Form Add Request')
        $(`${modal} form`).attr('action', urlStore)
        $(`${modal} [name=_method]`).val('post')
    }

    const showModalUpdateBarang = (url, urlUpdate) => {
        event.preventDefault()
        $.get(url)
            .done(response => {
                resetForm(`${modalUpdate} form`)
                $(modalUpdate).modal('show')
                $(`${modalUpdate} .modal-title`).text("Form Update Barang")
                loopForm(response.data)
                $(`${modalUpdate} form`).attr('action', urlUpdate)
                $(`${modalUpdate} [name=_method]`).val('put')
            })
            .fail(errors => {
                alertError();
                return;
            });
    }

    $(document).ready(function() {
            $(".fetch-data").removeClass("d-none");
            $(".loader").addClass("d-none");
        });
        
        async function fetchData(
            page = '',
            query = '',
            sortBy = 'desc',
        ) {
            await $.get(`/request-details/fetch?page=${page}&query=${query}&sortBy=${sortBy}`)
                .done(data => {
                    $('.loader').addClass('d-none');
                    $('.fetch-data').removeClass('d-none');
                    $('.fetch-data').html(data)
                })
        }

        function search(el) {
            let query = $(el).val();
            page = $("input[name=page]").val();

            $(".loader").removeClass("d-none");
            $(".fetch-data").addClass("d-none");
            fetchData(page, query, "desc");
        }

        function sortBy(sortBy) {
            let page = $("input[name=page]").val(),
                query = $("input[name=query]").val();
            $(".loader").removeClass("d-none");
            $(".fetch-data").addClass("d-none");
            fetchData(page, query, sortBy);
        }

        $(document).on("click", ".pagination a", function(e) {
            e.preventDefault();
            let page = $(this).attr("href").split("page=")[1],
                query = $("input[name=query]").val();
            $(".loader").removeClass("d-none");
            $(".fetch-data").addClass("d-none");
            fetchData(page, query, "desc");
        });


        // Submit form barang
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
                    alertSuccess(response.message);
                    $(modal).modal('hide');
                    // $(modalUpdate).modal('hide');
                    pindahHalaman(reloadHalaman(), 1000);
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

        // Destroy barang
        const destroyBarang = (url) => {
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
