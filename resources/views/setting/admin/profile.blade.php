<x-admin.layouts.app>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-12">
                        <h3 class="page-title">{{ __('Profile Settings') }}</h3>
                    </div>
                </div>
            </div>
            @include('setting.partials.setting-header')
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.profile.store')}}" method="post">
                            @csrf
                            <div class="tab-content pt-0">
                                <div id="general" class="tab-pane active">
                                    <div class="card mb-0">
                                        <div class="card-header">
                                            <h4 class="card-title">{{ __('Profile Standard') }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">{{ __('Name') }}</label>
                                                <input type="text" class="form-control"
                                                       value="{{ old('name') !== null ? old('name') : auth()->user()->name }}"
                                                       placeholder="Yoga" name="name" id="name">
                                            </div>
                                            <div class="form-group d-flex justify-content-around">
                                                <div>
                                                    <input type="radio"
                                                           @checked(auth()->user()->gender == 0 || old('gender') == 0)
                                                           name="gender" id="gender">
                                                    <label for="gender" class="ms-2">{{ __('Male') }}</label>
                                                </div>
                                                <div>
                                                    <input type="radio"
                                                           @checked(auth()->user()->gender == 1 || old('gender') == 1)
                                                           name="gender" id="gender1">
                                                    <label for="gender1" class="ms-2">{{ __('Female') }}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="birthdate">{{ __('Birthdate') }}</label>
                                                <x-admin.forms.inputs.datepicker name="birthdate" id="birthdate"
                                                                                 value="{{ old('name') !== null ? old('name') : auth()->user()->name }}"
                                                                                 placeholder="xx/xx/xxxx" />
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">{{ __('Mobile Number') }}</label>
                                                <input type="text" class="form-control" placeholder="032xxxxxxxx"
                                                       id="phone" name="phone"
                                                       value="{{ old('phone') !== null ? old('phone') : auth()->user()->phone }}">
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label for="email">{{ __('Email') }}</label>
                                                    @if(auth()->user()->email_verified != 1)
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_verify_email" class="cursor-pointer" style="cursor:pointer">{{ __('Verify your email') }}</a>
                                                    @endif
                                                </div>
                                                <input type="email" class="form-control" placeholder="abc@example.com"
                                                       id="email" name="email"
                                                       value="{{ old('email') !== null ? old('email') : auth()->user()->email }}" >
                                            </div>
                                            <div class="form-group">
                                                <label for="address">{{ __('Address') }}</label>
                                                <input type="text" class="form-control" placeholder="HCM"
                                                       name="address" id="address"
                                                       value="{{ old('address') !== null ? old('address') : auth()->user()->address }}" >
                                            </div>
                                            <div class="form-group">
                                                <label for="password">{{ __('Password') }}</label>
                                                <x-admin.forms.inputs.password name="password"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                                <x-admin.forms.inputs.password name="password_confirmation"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin.modal id="modal_verify_email">
        <x-slot:heading>
            {{ __('Verify Your Email') }}
        </x-slot:heading>

        {{ __('Please verify your email') }}

        <x-slot:footer>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_verify_email">{{ __('Close') }}</button>
            <form action="{{ route('ajax.verifyEmail') }}" method="post" onsubmit="return false" id="form_email">
                @csrf
                <button type="button" class="btn btn-primary" id="verify_email">
                    {{ __('Verify') }}
                    <span class="spinner-border spinner-border-sm mr-2 d-none" role="status" id="spinner"></span>
                </button>
            </form>
        </x-slot:footer>
    </x-admin.modal>

    @push('js')
        <script>
            $(function(){
                $("#verify_email").click(() => {
                    let formEmail = $('#form_email');
                    $('#spinner').toggleClass('d-none')
                    $.ajax({
                        url: formEmail.attr('action'),
                        type: 'POST',
                        data: formEmail.serializeArray(),
                        success: function (data) {
                            $('#spinner').toggleClass('d-none')
                            toasting.create({
                                "title": "Success",
                                "text": data.data,
                                "type": "success",
                                "progressBarType": "rainbow"
                            });
                            $('#close_verify_email').click();
                        }
                    });
                })
                $(".toggle-password").click(function() {
                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input = $($(this).attr("toggle"));
                    if (input.attr("type") == "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                });
            })
        </script>
    @endpush
</x-admin.layouts.app>
