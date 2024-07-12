<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="#" class="logo-link nk-sidebar-logo">
                
                <img class="logo-light logo-img" src="{{ asset('frontend/images/logo.png')}}" srcset="./images/logo2x.png 2x" alt="logo">
                
                <img class="logo-dark logo-img" src="{{ asset('frontend/images/logo-dark.png')}}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">

                <img class="logo-small logo-img logo-img-small" src="
                {{asset('frontend/images/logo-small.png')}}" srcset="./images/logo-small2x.png 2x" alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    {{-- Dashboard pasien --}}
                    <li class="nk-menu-item">
                        <a href="{{ route('dashboard.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-dashboard-fill"></em>
                            </span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>



                    {{-- @role('pendaftaran|super_admin|admin') --}}
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Management Driver Schedule</h6>
                        </li>

                        <li class="nk-menu-item">
                            <a href="{{ route('request-vehicle.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-tranx-fill"></em>
                                </span>
                                <span class="nk-menu-text">
                                    Request Vehicle
                                </span>
                            </a>
                        </li>

                        <li class="nk-menu-item">
                            <a href="{{ route('request-details.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-clipboad-check-fill"></em>
                                </span>
                                <span class="nk-menu-text">
                                    Request Details
                                </span>
                            </a>
                        </li>

                        {{-- <li class="nk-menu-item">
                            <a href="#" class="nk-menu-link">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-users"></em>
                                </span>
                                <span class="nk-menu-text">Pasien</span>
                            </a>
                        </li> --}}

                        {{-- <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-book-fill"></em>
                                </span>
                                <span class="nk-menu-text">Laporan</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link"><span
                                            class="nk-menu-text">Rawat Jalan</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link"><span
                                            class="nk-menu-text">Rawat
                                            Inap</span></a>
                                </li>
                            </ul>
                        </li> --}}
                        
                    {{-- @endrole --}}


                </ul>
            </div>
        </div>
    </div>
</div>
