
<div class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <a href="{{ route('admin.index') }}">
            <img src="{{ Storage::url(option('site_logo')) }}" class="img-fluid" alt="">
        </a>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li @class(["active" => getNameRouteMain() === "index"]) >
                    <a href="{{ route('admin.index') }}"><i class="fas fa-columns"></i> <span>{{ __('Dashboard') }}</span></a>
                </li>
                <li @class(["active" => getNameRouteMain() === "course"]) >
                    <a href="{{ route('admin.course.index') }}"><i class="fas fa-swatchbook"></i> <span>{{ __('Course') }}</span></a>
                </li>
                <li @class(["active" => getNameRouteMain() === "lesson"]) >
                    <a href="{{ route('admin.lesson.index') }}"><i class="fab fa-youtube"></i> <span>{{ __('Lesson') }}</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
