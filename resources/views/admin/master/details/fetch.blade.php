<div class="nk-tb-list is-separate mb-3">
    <div class="nk-tb-item nk-tb-head">
        <div class="nk-tb-col"><span class="sub-text">No</span></div>
        <div class="nk-tb-col"><span class="sub-text">Request Date</span></div>
        <div class="nk-tb-col"><span class="sub-text">Name</span></div>
        <div class="nk-tb-col"><span class="sub-text">Noted</span></div>
        <div class="nk-tb-col"><span class="sub-text">Nopol</span></div>
        <div class="nk-tb-col"><span class="sub-text">Driver</span></div>
        <div class="nk-tb-col"><span class="sub-text">Status</span></div>
    
        <div class="nk-tb-col"><span class="sub-text">Opsi</span></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"><span class="sub-text"><em class="icon ni ni-setting-fill"></em></span>
        </div>
    </div>

    @forelse ($data as $item)
    <div class="nk-tb-item">
        <div class="nk-tb-col tb-col-md">
            <span>{{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}</span>
        </div>

        <div class="nk-tb-col tb-col-md">
            <span class="tb-lead">
                {!! tanggalSekarang($item->request_date) !!}
            </span>
        </div>
        <div class="nk-tb-col">
            <span class="tb-lead">
                {!! $item->name !!}
            </span>
        </div>
        <div class="nk-tb-col tb-col-md">
            <span class="tb-lead">
                {!! $item->noted !!}
            </span>
        </div>

        <div class="nk-tb-col tb-col-md">
            <span class="tb-lead text-capitalize">
                {!! ($item->nopol) !!}
            </span>
        </div>

        <div class="nk-tb-col tb-col-md">
            <span class="tb-lead text-capitalize">
                {!! ($item->driver) !!}
            </span>
        </div>

        <div class="nk-tb-col">
            <span class="badge badge-dim badge 
            {{ $item->status == 'Approved' ? 'badge-success' : ($item->status == 'Pending' ? 'badge-warning' : ($item->status == 'Cancel' ? 'badge-danger' : '')) }} ">
                {!! $item->status !!}
            </span>
        </div>

        <div class="nk-tb-col">
            <span class="tb-lead text-capitalize">
                {{-- {!! date('d-F-Y, h:i', strtotime($item->tanggal_pembelian)) !!} --}}
                {{-- {!! tanggal($item->tanggal_pembelian) !!} --}}
            </span>
        </div>

        <div class="nk-tb-col tb-col-md">
        </div>

        <div class="nk-tb-col">
            <span></span>
        </div>

        <div class="nk-tb-col">
            <span></span>
        </div>

        <div class="nk-tb-col nk-tb-col-tools">
            <ul class="nk-tb-actions gx-2">
                <li>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                class="icon ni ni-more-h"></em></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="link-list-opt no-bdr">
                                <li>
                                    <a href="#"
                                        onclick="showModalUpdateBarang()">
                                        <em class="icon ni ni-update"></em>
                                        <span>Updated</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        onclick="destroyBarang()">
                                        <em class="icon ni ni-trash"></em>
                                        <span>Remove</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    @empty
    <div class="nk-tb-item">
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col">
            <h4 class="text-center">Data Is Empty</h4>
        </div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
        <div class="nk-tb-col"></div>
    </div>
    @endforelse
</div>


@if ($data->hasPages())
<div class="card">
    <div class="card-inner">
        <div class="nk-block-between-md g-3">
            <div class="g">
                {{ $data->links('components.pagination') }}
            </div>
        </div>
    </div>
</div>
@endif
