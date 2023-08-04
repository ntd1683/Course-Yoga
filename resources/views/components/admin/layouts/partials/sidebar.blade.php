
<div class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <a href="index.html">
            <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="">
        </a>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active">
                    <a href="index.html"><i class="fas fa-columns"></i> <span>{{ __('Dashboard') }}</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-border-all"></i> <span> {{ __('Application') }}</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="chat.html">{{ __('Chat') }}</a></li>
                        <li><a href="calendar.html">{{ __('Calendar') }}</a></li>
                        <li><a href="inbox.html">{{ __('Email') }}</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Pages</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-user-lock"></i> <span> {{ __('Authentication') }} </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="login.html"> {{ __('Login') }} </a></li>
                        <li><a href="register.html"> {{ __('Register') }} </a></li>
                        <li><a href="forgot-password.html"> {{ __('Forgot Password') }} </a></li>
                        <li><a href="lock-screen.html"> {{ __('Lock Screen') }} </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
