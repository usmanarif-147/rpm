<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic">
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                    <span class="hamburger-inner">

                    </span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                <span class="hamburger-inner">

                </span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
<span>
<button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
<span class="btn-icon-wrapper">
<i class="fa fa-ellipsis-v fa-w-6"></i>
</span>
</button>
</span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li>
                    <a class="mm-active" href="{{route('admin.dashboard')}}">
                        <i class="metismenu-icon pe-7s-map"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-way"></i>
                        Properties
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.properties')}}">
                                Add New Property
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.deactivated.properties')}}">
                                Deactivated Properties
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.managers')}}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Managers
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.drivers')}}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Drivers
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Permits
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.active.permits')}}">
                                Active Permits
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.expired.permits')}}">
                                Expired Permits
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.change.password')}}">
                        <i class="metismenu-icon pe-7s-lock"></i>
                        Change Password
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>