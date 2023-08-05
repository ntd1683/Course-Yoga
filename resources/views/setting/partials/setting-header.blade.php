<ul class="nav nav-tabs menu-tabs">
    <li @class(["nav-item", "active" => getNameRouteMain() == "settings"])>
        <a class="nav-link" href="{{ route('admin.settings') }}">{{ __('General Settings') }}</a>
    </li>
    <li @class(["nav-item", "active" => getNameRouteMain() == "profile"])>
        <a class="nav-link" href="{{ route('admin.profile') }}">{{ __('Profile Settings') }}</a>
    </li>
</ul>
