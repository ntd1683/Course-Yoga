<x-user.layouts.auth>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">
                <h2 class="mb-4 text-center">{{ __('Have an account') }}?</h2>
                <form action="{{ route('processLogin') }}" class="signin-form" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" required name="email">
                    </div>
                    <div class="form-group">
                        <input id="password-field" type="password" class="form-control" placeholder="{{ __('Password') }}"
                               required name="password">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn submit px-3">{{ __('Sign In') }}</button>
                    </div>
                    <div class="form-group d-md-flex">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" checked name="remember">
                            <label class="custom-control-label font-weight-bold" for="customCheck1">{{ __('Remember me') }}
                            </label>
                        </div>
                        <div class="w-50 text-md-right">
                            <a href="#">{{ __('Forgot Password') }}</a>
                        </div>
                    </div>
                </form>
                <p class="w-100 text-center text-white">&mdash; {{ __('If you do not already have an account') }} &mdash;</p>
                <div class="social d-flex text-center font-weight-bold">
                    <a class="btn px-2 py-2 mr-md-1 rounded" href="{{ route('register') }}"><i class="fas fa-user-plus mr-2"></i></i>{{ __('Register') }}
                    </a>
                </div>
                <p class="w-100 text-center text-white">&mdash; {{ __('Or Sign In With') }} &mdash;</p>
                <div class="social d-flex text-center font-weight-bold">
                    <a class="btn px-2 py-2 mr-md-1 rounded" href="{{ route('login.social.redirect', 'google') }}"><i class="fab fa-google mr-2"></i>Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-user.layouts.auth>
