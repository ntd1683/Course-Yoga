<div class="header">
    <div class="header-left">
        <a href="{{ route('admin.index') }}" class="logo logo-small">
            <img src="{{ Storage::url(option('site_logo')) }}" alt="Logo" width="30" height="30">
        </a>
    </div>
    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fas fa-align-left"></i>
    </a>
    <a class="mobile_btn" id="mobile_btn" href="javascript:void(0);">
        <i class="fas fa-align-left"></i>
    </a>
    <ul class="nav user-menu">

        <li class="nav-item dropdown noti-dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <i class="far fa-bell"></i> <span class="badge badge-pill"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">{{ __('Notifications') }}</span>
                    <a href="javascript:void(0)" class="clear-noti"> {{ __('Clear All') }} </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="admin-notification.html">{{ __('View all Notifications') }}</a>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle user-link  nav-link" data-bs-toggle="dropdown">
<span class="user-img">
    <i class="fas fa-user-circle"></i>
</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('admin.profile') }}">{{ __('Profile') }}</a>
                <a class="dropdown-item" href="{{ route('admin.settings') }}">{{ __('Setting') }}</a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">{{ __('Logout') }}</a>
            </div>
        </li>

    </ul>
</div>
