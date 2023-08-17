<!-- header-area -->
<header>
    <div id="sticky-header" class="menu-area transparent-header">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="mobile-nav-toggler mt-3"><i class="fas fa-bars"></i></div>
                    <div class="menu-wrap">
                        <nav class="menu-nav show">
                            <div class="logo">
                                <a href="{{ route('index') }}">
                                    <img src="{{ Storage::url(option('site_logo')) }}" alt="Logo" width="135"
                                         height="auto">
                                </a>
                            </div>
                            <div class="navbar-wrap main-menu d-none d-lg-flex">
                                <ul class="navigation">
                                    <li
                                        @class(["menu-item-has-children", "active" => getNameRouteMain() == "index" ])
                                    >
                                        <a href="{{ route('index') }}">{{ __('Home') }}</a>
                                    </li>
                                    <li
                                        @class(["active" => getNameRouteMain() == "course"])
                                    ><a href="{{ route('course') }}">{{ __('Course') }}</a></li>
                                    <li
                                        @class(["active" => getNameRouteMain() == "pricing"])
                                    ><a href="{{ route('pricing') }}">{{ __('Workshop') }}</a></li>
                                    <li class="menu-item-has-children"><a href="#">{{ __('Blog') }}</a>
                                        <ul class="submenu">
                                            <li><a href="blog.html">{{ __('Our Blog') }}</a></li>
                                            <li><a href="blog-details.html">{{ __('Blog Details') }}</a></li>
                                        </ul>
                                    </li>
                                    <li
                                        @class(["active" => getNameRouteMain() == "contact"])
                                    ><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
                                </ul>
                            </div>
                            <div class="header-action d-none d-md-block">
                                <ul>
                                    <li class="header-search"><a href="#" data-toggle="modal"
                                                                 data-target="#search-modal"><i
                                                class="fas fa-search"></i></a></li>
                                    <li class="header-lang">
                                        <form action="{{ route('change-language') }}" method="get" id="form_change_language">
                                            <div class="icon"><i class="flaticon-globe"></i></div>
                                            <select id="lang-dropdown" name="language">
                                                <option value="en" onclick="changeLanguage()" @if(session()->get('lang') === 'en') selected @endif>{{ __('English') }}</option>
                                                <option value="vi" onclick="changeLanguage()" @if(session()->get('lang') === 'vi') selected @endif>{{ __('Vietnamese') }}</option>
                                            </select>
                                            @push('js')
                                                <script>
                                                    function changeLanguage() {
                                                        $('#form_change_language').submit();
                                                    }
                                                    $('#lang-dropdown').change(() => {
                                                        changeLanguage();
                                                    })
                                                </script>
                                            @endpush
                                        </form>
                                    </li>
                                    @if(! auth()->check())
                                        <li class="header-btn">
                                            <a href="{{ route('login') }}" class="btn">{{ __('Sign In') }}</a>
                                        </li>
                                    @else
                                        <li class="menu-children">
                                            <div class="icon"><i class="fas fa-users"></i> {{ auth()->user()->name }}
                                            </div>
                                            <ul class="submenu">
                                                <li><a href="{{ route('profile') }}">{{ __('Account') }}</a></li>
                                                <li><a href="{{ route('logout') }}">{{ __('Logout') }}</a></li>
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="mobile-menu">
                        <div class="close-btn"><i class="fas fa-times"></i></div>

                        <nav class="menu-box">
                            <div class="nav-logo"><a href="{{ route('index') }}"><img
                                        src="{{ Storage::url(option('site_logo')) }}" alt="" title=""></a>
                            </div>
                            <div class="menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                <ul class="clearfix">
                                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="menu-backdrop"></div>
                    <!-- End Mobile Menu -->

                    <!-- Modal Search -->
                    <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form>
                                    <input type="text" placeholder="{{ __('Search title here...') }}">
                                    <button><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Search-end -->

                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area-end -->
