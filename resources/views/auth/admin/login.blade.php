<x-admin.layouts.auth>
    <div class="login-page">
        <div class="login-body container">
            <div class="loginbox">
                <div class="login-right-wrap">
                    <div class="account-header">
                        <div class="account-logo text-center mb-4">
                            <a href="{{ route('index') }}">
                                <img src="{{ Storage::url(option('site_logo')) }}" alt="logo" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="login-header">
                        <h3>Login <span>{{ option('site_name') }}</span></h3>
                        <p class="text-muted">{{ __('Access to our dashboard') }}</p>
                    </div>
                    <form action="{{ route('admin.processLogin') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input class="form-control" type="email" placeholder="{{ __('Enter your Email') }}" name="email">
                        </div>
                        <div class="form-group mb-4">
                            <label class="control-label">{{ __('Password') }}</label>
                            <input class="form-control" type="password" placeholder="{{ __('Enter your password') }}" name="password">
                        </div>
                        <div class="form-group mb-4">
                            <input type="checkbox" checked id="remember" name="remember"> <label for="remember">{{ __('Remember To Login') }}</label>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-block account-btn" type="submit">{{ __('Login') }}</button>
                        </div>
                    </form>
                    <div class="login-or">
                        <span class="or-line"></span>
                        <span class="span-or">{{ __('or') }}</span>
                    </div>

                    <div class="social-login">
                        <span>{{ __('Login with') }}</span>
                        <a href="#" class="google"><i class="fab fa-google"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layouts.auth>
