<div class="modal fade zoom modal-create">
    <div class="modal-dialog modal-xl modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form method="post">
                    @csrf

                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" name="email" autocomplete="off">
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

                        <div class="col-6">
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

                        {{-- <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Chose Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="status" style="position:absolute;" data-placeholder="Chose Division">
                                        <option label="Chose Status" disabled selected value=""></option>
                                        <option value="Approved">Approved</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Cancel">Cancel</option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}



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

                    </div>

                    <div class="col-lg-8 offset-5">
                        <div class="form-group my-5">
                            <button type="submit" class="btn btn-lg btn-primary tombol-simpan" onclick="submitForm(this.form)">
                                Submit
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
