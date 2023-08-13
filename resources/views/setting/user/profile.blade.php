<x-user.layouts.app>
    {{ Breadcrumbs::render('profile') }}
    <section class="contact-area contact-bg" data-background="{{ asset('images/bg/contact_bg.jpg') }}">
        <div class="container">
            <div class="contact-form-wrap">
                <div class="widget-title mb-50">
                    <h5 class="title">{{ __('Update Profile') }}</h5>
                </div>
                <div class="contact-form">
                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf
                        <input type="text" placeholder="{{ __('Your Name') }}" name="name"
                               value="{{ old('name') ?: auth()->user()->name }}">
                        @if(! auth()->user()->email_verified)
                            <div class="d-flex justify-content-end">
                                <a id="open_modal_verify" data-toggle="modal" data-target="#modal_verify" style="cursor: pointer;">{{ __('Verify Email') }}</a>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" placeholder="{{ __('Your Phone') }}" name="phone"
                                       value="{{ old('phone') ?: auth()->user()->phone }}">
                            </div>
                            <div class="col-md-6">
                                <input type="email" placeholder="{{ __('Your Email') }}" name="email"
                                       value="{{ old('email') ?: auth()->user()->email }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex col-md-6">
                                <input type="radio" name="gender" id="gender1"
                                       @checked(auth()->user()->checked == 1)
                                       style="width: 7%;" class="shadow-none mr-2" value="1">
                                <label for="gender1">{{ __('Male') }}</label>
                            </div>
                            <div class="d-flex col-md-6">
                                <input type="radio" name="gender" id="gender0"
                                       @checked(auth()->user()->checked == 0)
                                       style="width: 7%;" class="shadow-none mr-2" value="0">
                                <label for="gender0">{{ __('Female') }}</label>
                            </div>
                        </div>
                        <x-user.forms.inputs.datepicker name="birthdate"
                                                        value="{{ old('birthdate') ?: date('d/m/Y', strtotime(auth()->user()->birthdate)) }}"/>
                        <textarea name="address" placeholder="{{ __('Address') }}..." class="mb-2">{{ old('address') ?: auth()->user()->address }}</textarea>
                        <x-user.forms.inputs.password name="password" placeholder="{{ __('Password') }}"/>
                        <x-user.forms.inputs.password name="password_confirmation" placeholder="{{ __('Confirm Password') }}"/>
                        <button class="btn">{{ __('Update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <x-user.layouts.partials.newsletter/>
    <x-user.modal id="modal_verify">
        <x-slot:heading>
            {{ __('Verify Your Email') }}
        </x-slot:heading>

        {{ __('Please verify your email') }}

        <x-slot:footer>
            <button type="button" class="btn btn-modal" data-dismiss="modal" id="close_verify_email">{{ __('Close') }}</button>
            <form action="{{ route('ajax.verifyEmail') }}" method="post" onsubmit="return false" id="form_email">
                @csrf
                <button type="button" class="btn btn-modal" id="verify_email">
                    {{ __('Verify') }}
                    <span class="spinner-border spinner-border-sm mr-2 d-none" role="status" id="spinner"></span>
                </button>
            </form>
        </x-slot:footer>
    </x-user.modal>
    @push('js')
        <script>
            $(function() {
                $(".toggle-password").click(function () {
                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input = $($(this).attr("toggle"));
                    if (input.attr("type") == "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                });

                $("#verify_email").click(() => {
                    let formEmail = $('#form_email');
                    $('#spinner').toggleClass('d-none')
                    $.ajax({
                        url: formEmail.attr('action'),
                        type: 'POST',
                        data: formEmail.serializeArray(),
                        success: function (data) {
                            if(data.success == true) {
                                $('#spinner').toggleClass('d-none')
                                toasting.create({
                                    "title": "Success",
                                    "text": data.data,
                                    "type": "success",
                                    "progressBarType": "rainbow"
                                });
                                $('#close_verify_email').click();
                            }
                            else {
                                toasting.create({
                                    "title": "Error",
                                    "text": data.responseJSON.message,
                                    "type": "error",
                                    "progressBarType": "rainbow"
                                });
                                $('#close_verify_email').click();
                            }
                        },
                        error: function (data) {
                            toasting.create({
                                "title": "Error",
                                "text": data.responseJSON.message,
                                "type": "error",
                                "progressBarType": "rainbow"
                            });
                            $('#close_verify_email').click();
                        }
                    });
                })
            });
        </script>
    @endpush
</x-user.layouts.app>
