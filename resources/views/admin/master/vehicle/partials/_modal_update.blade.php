<div class="modal fade zoom modal-update">
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
                    @method('put')
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="">Email</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="email" autocomplete="off">
                                </div>
                            </div>
                        </div>
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Division</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="division" style="position:absolute;" 
                                        data-placeholder="Chose Division">
                                        <option label="Chose Data" disabled selected value=""></option>
                                    @foreach ($findDivision as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="">Harga Beli</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" name="harga_beli">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Stok</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" name="stok">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tanggal Pembelian</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" name="tanggal_pembelian"
                                        data-date-format="yyyy-mm-dd">
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
