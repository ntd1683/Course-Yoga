<x-user.layouts.app>
        {{ Breadcrumbs::render('contact') }}
        <!-- contact-area -->
        <section class="contact-area contact-bg" data-background="{{ asset('images/bg/contact_bg.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="contact-form-wrap">
                            <div class="widget-title mb-50">
                                <h5 class="title">{{ __('Contact Form') }}</h5>
                            </div>
                            <div class="contact-form">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" placeholder="You Name *">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" placeholder="You  Email *">
                                        </div>
                                    </div>
                                    <input type="text" placeholder="Subject *">
                                    <textarea name="message" placeholder="Type Your Message..."></textarea>
                                    <button class="btn">{{ __('Send Message') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="widget-title mb-50">
                            <h5 class="title">{{ __('Information') }}</h5>
                        </div>
                        <div class="contact-info-wrap">
                            <p><span>{{ __('Find solutions') }} :</span> {{ __('to common problems, or get help from a support agent industry\'s standard .') }}</p>
                            <div class="contact-info-list">
                                <ul>
                                    <li>
                                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                        <p><span>{{ __('Address') }} :</span> {{ __('W38 Park Road New York') }}</p>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                        <p><span>{{ __('Phone') }} :</span> {{ __('(09) 123 854 365') }}</p>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fas fa-envelope"></i></div>
                                        <p><span>{{ __('Email') }} :</span> <a href="https://themebeyond.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="98ebede8e8f7eaecd8f5f7eefef4e0b6fbf7f5">[email&#160;protected]</a></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

        <!-- map -->
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1416.036673762947!2d108.08377647425696!3d12.769746244187857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3171f99804cce467%3A0x2d49fee91bcdc72d!2zRMWpbmcgUGjDoXQ!5e0!3m2!1svi!2s!4v1691157196170!5m2!1svi!2s" width="600" height="450" style="border:0;width:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- map-end -->
        <x-user.layouts.partials.newsletter />
</x-user.layouts.app>
