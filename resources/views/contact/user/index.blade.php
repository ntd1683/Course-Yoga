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
                                <form action="{{ route('contact.send') }}" method="post">
                                    @csrf
                                    <input type="text" placeholder="{{ __('Your Name') }}" name="name" value="{{ old('name') }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" placeholder="{{ __('Your Phone') }}" name="phone" value="{{ old('phone') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" placeholder="{{ __('Your Email') }}" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <input type="text" placeholder="{{ __('Type Your Title') }}" name="title" value="{{ old('title') }}">
                                    <textarea name="message" placeholder="{{ __('Type Your Message') }}..." name="message">{{ old('message') }}</textarea>
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
                            <p><span>{{ __('Find solutions') }} :</span> {{ __('If you need support, please contact us for the best support') }}</p>
                            <div class="contact-info-list">
                                <ul>
                                    <li>
                                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                        <p><span>{{ __('Address') }} :</span> {{ option('site_address') }}</p>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                        <p><span>{{ __('Phone') }} :</span> {{ option('site_phone') ?: config('app.phone') }}</p>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fas fa-envelope"></i></div>
                                        <p><span>{{ __('Email') }} :</span> <a href="mailto:{{ option('site_email') ?: config('app.email') }}" class="__cf_email__" data-cfemail="98ebede8e8f7eaecd8f5f7eefef4e0b6fbf7f5">{{ option('site_email') ?: config('app.email') }}</a></p>
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d244.90210892689026!2d106.65563992794577!3d10.854577483384345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529aa999ac679%3A0x581f2a72e66c2c0!2zUmFqYSBZb2dhIEfDsiBW4bqlcA!5e0!3m2!1svi!2s!4v1691830225881!5m2!1svi!2s" width="600" height="450" style="border:0;width:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- map-end -->
        <x-user.layouts.partials.newsletter />
</x-user.layouts.app>
