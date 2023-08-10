<x-user.layouts.app>
    <!-- pricing-area -->
    <section class="pricing-area pricing-bg" data-background="{{ __('images/bg/pricing_bg.jpg') }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title title-style-three text-center mb-70">
                        <span class="sub-title">{{ __('our pricing plans') }}</span>
                        <h2 class="title">{{ __('Our Pricing Strategy') }}</h2>
                    </div>
                </div>
            </div>
            <div class="pricing-box-wrap">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="pricing-box-item mb-30">
                            <div class="pricing-top">
                                <h6>{{ __('premium') }}</h6>
                                <div class="price">
                                    <h3>$7.99</h3>
                                    <span>{{ __('Monthly') }}</span>
                                </div>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li class="quality"><i class="fas fa-check"></i> {{ __('Video quality') }} <span>{{ __('Good') }}</span></li>
                                    <li><i class="fas fa-check"></i> {{ __('Resolution') }} <span>480p</span></li>
                                    <li><i class="fas fa-check"></i> {{ __('Screens you can watch') }} <span>1</span></li>
                                    <li><i class="fas fa-check"></i> {{ __('Cancel anytime') }}</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="#" class="btn">{{ __('Buy Now') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="pricing-box-item active mb-30">
                            <div class="pricing-top">
                                <h6>{{ __('standard') }}</h6>
                                <div class="price">
                                    <h3>$9.99</h3>
                                    <span>{{ __('Monthly') }}</span>
                                </div>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li class="quality"><i class="fas fa-check"></i> {{ __('Video quality') }} <span>{{ __('Better') }}</span></li>
                                    <li><i class="fas fa-check"></i> {{ __('Resolution') }} <span>1080p</span></li>
                                    <li><i class="fas fa-check"></i> {{ __('Screens you can watch') }} <span>2</span></li>
                                    <li><i class="fas fa-check"></i> {{ __('Cancel anytime') }}</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="#" class="btn">{{ __('Buy Now') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="pricing-box-item mb-30">
                            <div class="pricing-top">
                                <h6>{{ __('premium') }}</h6>
                                <div class="price">
                                    <h3>$11.99</h3>
                                    <span>{{ __('Monthly') }}</span>
                                </div>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li class="quality"><i class="fas fa-check"></i> {{ __('Video quality') }} <span>{{ __('Best') }}</span></li>
                                    <li><i class="fas fa-check"></i> {{ __('Resolution') }} <span>4K+HDR</span></li>
                                    <li><i class="fas fa-check"></i> {{ __('Screens you can watch') }} <span>4</span></li>
                                    <li><i class="fas fa-check"></i> {{ __('Cancel anytime') }}</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="#" class="btn">{{ __('Buy Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pricing-area-end -->
    <x-user.layouts.partials.newsletter />
</x-user.layouts.app>
