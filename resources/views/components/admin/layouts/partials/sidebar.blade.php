
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
                <li @class(["active" => getNameRouteMain() === "user"]) >
                    <a href="{{ route('admin.user.index') }}"><i class="fas fa-users"></i> <span>{{ __('User') }}</span></a>
                </li>
                <li @class(["active" => getNameRouteMain() === "course"]) >
                    <a href="{{ route('admin.course.index') }}"><i class="fas fa-swatchbook"></i> <span>{{ __('Course') }}</span></a>
                </li>
                <li @class(["active" => getNameRouteMain() === "lesson"]) >
                    <a href="{{ route('admin.lesson.index') }}"><i class="fab fa-youtube"></i> <span>{{ __('Lesson') }}</span></a>
                </li>
                <li @class(["active" => getNameRouteMain() === "order"]) >
                    <a href="{{ route('admin.order.index') }}"><i class="fas fa-wallet"></i> <span>{{ __('Order') }}</span></a>
                </li>
                <li @class(["active" => getNameRouteMain() === "discount"]) >
                    <a href="{{ route('admin.discount.index') }}"><i class="fas fa-percent"></i> <span>{{ __('Discount') }}</span></a>
                </li>
                <li @class(["active" => getNameRouteMain() === "contact"]) >
                    <a href="{{ route('admin.contact.index') }}"><i class="fas fa-question-circle"></i> <span>{{ __('Contact') }}</span></a>
                </li>
                <li @class(["active" => getNameRouteMain() === "trial"]) >
                    <a href="{{ route('admin.trial.index') }}"><i class="fas fa-phone-alt"></i> <span>{{ __('Consultation') }}</span></a>
                </li>
                <li @class(["active" => getNameRouteMain() === "subscribe"]) >
                    <a href="{{ route('admin.subscribe.index') }}"><i class="fas fa-user-check"></i> <span>{{ __('Subscribe') }}</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
