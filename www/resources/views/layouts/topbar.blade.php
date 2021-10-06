<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-xl-inline-block ml-1">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                {{auth()->user()->name}}
                            @endif
                        </span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
{{--                        <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>--}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>


            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{config('global.site_logo')}}" alt="" width="100px">
                        </span>
                        <span class="logo-lg">
                            <img src="{{config('global.site_logo')}}" alt="" width="100px">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{config('global.site_logo')}}" alt="" width="100px">
                        </span>
                        <span class="logo-lg">
                            <img src="{{config('global.site_logo')}}" alt="" width="200px">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

{{--                <!-- App Search-->--}}
{{--                <form class="app-search d-none d-lg-inline-block">--}}
{{--                    <div class="position-relative">--}}
{{--                        <input type="text" class="form-control" placeholder="Search...">--}}
{{--                        <span class="bx bx-search-alt"></span>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>

        </div>
    </div>
</header>
