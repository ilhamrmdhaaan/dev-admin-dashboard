 <!-- Modal logout -->
 <div class="modal fade modal-logout" tabindex="-1" id="modalTop">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Logout</h4>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <h6>Apakah anda yakin ingin logout dari sistem?</h6>
            </div>
            <div class="modal-footer">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button data-dismiss="modal" class="btn btn-dim btn-danger">Batal</button>
                    <button class="btn btn-success">Ya, Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal error -->
<div class="modal fade modal-error" tabindex="-1" id="modalAlert2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body modal-body-lg text-center">
                <div class="nk-modal">
                    <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                    <h4 class="nk-modal-title">Maaf, Terjadi Kesalahan</h4>
                    <div class="nk-modal-text">
                        <p class="lead"></p>
                    </div>
                    <div class="nk-modal-action mt-5">
                        <a href="#" class="btn btn-lg btn-mw btn-light" data-dismiss="modal">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Terimakasih --}}
<div class="modal fade modal-terimakasih" tabindex="-1">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross"></em></a>
            <div class="modal-body modal-body-lg text-center">
                <div class="nk-modal">
                    <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni ni-happy bg-success"></em>
                    <h4 class="nk-modal-title">Berhasil</h4>
                    <div class="nk-modal-text">
                        <div class="caption-text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal update password -->
<div class="modal fade modal-update-password">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content">
            <div class="modal-body modal-body-lg">
                <form method="post">
                    @csrf
                    @method('put')
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label">Password Lama Anda</label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                                        data-target="password_lama">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" id="password_lama" name="password_lama"
                                        class="form-control form-control-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label">Password Baru Anda</label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                                        data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" id="password" name="password"
                                        class="form-control form-control-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password Baru</label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                                        data-target="password_confirmation">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control form-control-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 offset-lg-4 mt-4">
                            <button type="button" class="btn-lg btn btn-danger shadow" data-dismiss="modal">
                                <span class="d-sm-block">Tutup</span>
                            </button>
                            <button type="submit" onclick="updatePassword(this.form)"
                                class="shadow tombol-simpan btn btn-lg btn-primary">
                                <span class="text-simpan">Simpan</span>
                                <span class="loading-simpan d-none ml-2 spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
