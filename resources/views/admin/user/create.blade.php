@extends('layouts.admin.master', ['title' => $title])

@push('css')
@endpush

@section('admin-content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub">
                                <a href="#"
                                    class="btn btn-outline-dark d-none d-sm-inline-flex">
                                    <em class="icon ni ni-arrow-left"></em>
                                    <span>Back</span>
                                </a>
                            </div>
                            <div class="fw-normal">
                                <h3>{{ $title }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                {{-- Form Request--}}
                                <form action="#" class="form-validate is-alter" novalidate="novalidate">
                                    <div class="row g-gs">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="">
                                                    Email address
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-mail"></em>
                                                    </div>
                                                    <input type="text" class="form-control" name="email" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Request Date
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-calendar"></em>
                                                    </div>
                                                    <input type="text" class="form-control date-picker" name="request_date" data-date-format="yyyy-mm-dd">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Maximum Person(Nama Karyawan)
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="maximum_person" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Division
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select" name="division" style="position:absolute;" data-placeholder="Chose Division">
                                                        <option label="Chose Data" disabled selected value=""></option>
                                                        @foreach ($findDivision as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="">Direction
                                                    <span class="text-gray">(Tujuan)</span>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="direction">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="">Necessity
                                                    <span class="text-gray">(Keperluan)</span>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="necessity">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Noted
                                                    <span class="text-gray">(Optional)</span>
                                                </label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control form-control-sm" id="fva-message" name="noted" placeholder="Write your message" required=""></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-7 offset-lg-5">
                                            <div class="form-group">
                                                <button type="submit" onclick="submitForm(this.form)"
                                                class="tombol-simpan btn btn-lg btn-primary">
                                                <span class="text-simpan">Submit</span>
                                                <span
                                                    class="loading-simpan d-none ml-2 spinner-border spinner-border-sm"
                                                    role="status" aria-hidden="true"></span>
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{-- End Form Request --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>

        // Submit Form
         const submitForm = (originalForm) => {
            event.preventDefault();
            $(originalForm).find('.form-control').removeClass('error');
            $(originalForm).find('.form-control').removeClass('select2-hidden-accessible');
            $(".invalid").remove();
            Swal.fire({
                icon: 'question',
                title: 'Apakah data yang anda masukan sudah sesuai?',
                text: 'Pastikan data yang anda input tidak ada yang salah',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                denyButtonText: `Batal`,
            }).then((result) => {
                if (result.isConfirmed) {
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
                            $(originalForm).find('.tombol-simpan').attr('disabled', true);
                            alertSuccess(response.message);
                            pindahHalaman(response.url, 1500);
                        })
                        .fail(errors => {
                            if (errors.status === 422) {
                                loopErrors(errors.responseJSON.errors);
                                return;
                            }
                            alertError();
                        });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }
    </script>
@endpush
