<!-- newsletter-area -->
<section class="newsletter-area newsletter-bg" data-background="{{ asset('images/bg/newsletter_bg.jpg') }}" id="newsletter">
    <div class="container">
        <div class="newsletter-inner-wrap">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="newsletter-content">
                        <h4>{{ __('Register for a Consultation Now.') }}</h4>
                        <p>{{ __('Enter your phone number to get instant advice.') }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('ajax.trial.subscribe') }}" class="newsletter-form" method="post" id="form_trial" onsubmit="return false;">
                        @csrf
                        <input type="text" required placeholder="{{ __('Enter Your Phone.') }}" name="phone">
                        <button class="btn" id="subscribe_trial" type="button">{{ __('get started') }}</button>
                    </form>
                    @push('js')
                        <script>
                            $(document).ready(function () {
                                if (getCookie('trial') == 1) {
                                    $('#newsletter').addClass('d-none');
                                }
                               $('#subscribe_trial').click(() => {
                                   let form = $('#form_trial');
                                   $.ajax({
                                       type: "POST",
                                       url: form.attr('action'),
                                       data: form.serialize(),
                                       dataType: "json",
                                       success: function (response) {
                                           setCookie('trial', '1', 1);
                                           toasting.create({
                                               "title": "Success",
                                               "text": "{{ __('Successfully registered for a consultation') }}",
                                               "type": "success",
                                               "progressBarType": "rainbow"
                                           });
                                           $('#newsletter').addClass('d-none');
                                       },
                                   });
                               })
                            });
                        </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
</section>
<!-- newsletter-area-end -->
