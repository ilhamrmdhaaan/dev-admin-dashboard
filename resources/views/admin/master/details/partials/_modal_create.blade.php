<div class="modal fade zoom modal-form">
    <div class="modal-dialog modal-xl modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-gs">
                        <input type="hidden" value="request_vehicle_id">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Request Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" name="request_date"
                                        data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="">Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="">Nopol</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="nopol">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="">Driver</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="driver">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Noted</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="fva-message" name="noted" placeholder="Write your message" required=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 offset-5">
                        <div class="form-group my-5">
                            <button type="submit" class="btn btn-lg btn-primary tombol-simpan"
                                onclick="submitForm(this.form)">
                                Simpan
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
