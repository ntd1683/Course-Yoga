<x-user.layouts.app>
    <!-- banner-area -->
    <section class="banner-area banner-bg" data-background="{{ asset('images/bg/image1.jpg') }}">
        <div class="container custom-container">
            <div class="row">
                <div class="col-xl-6 col-lg-8">
                    <div class="banner-content">
                        <h6 class="sub-title wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1.8s">{{ option('site_name') }}</h6>
                        <h2 class="title wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1.8s">Một cuộc sống khoẻ mạnh với <span>Yoga!</span></h2>
                        <div class="banner-meta wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1.8s">
                        </div>
                        <a href="https://www.youtube.com/watch?v=c1ppyP_1noY" class="banner-btn btn popup-video wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1.8s"><i class="fas fa-play"></i>{{ __('Learn Now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner-area-end -->

    <!-- new-courses-area -->
    @include('course.user.partials.new-courses')
    <!-- new-courses-area-end -->

    <!-- services-area -->
    <section class="services-area services-bg" data-background="{{ asset('images/bg/services_bg.jpg') }}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="services-img-wrap">
                        <img src="{{ asset('images/bg/service.jpg') }}" alt="">
                        <a href="{{ route('course') }}" class="download-btn" target="_self">{{ __('Start Now') }} <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="services-content-wrap">
                        <div class="section-title title-style-two mb-20">
                            <span class="sub-title">{{ option('site_name') }}</span>
                            <h2 class="title">{{ __('Start Your Happiness and Health Journey Today!') }}</h2>
                        </div>
                        <div class="services-list">
                            <ul>
                                <li>
                                    <div class="icon">
                                        <i class="fas fa-wrench"></i>
                                    </div>
                                    <div class="content">
                                        <h5>{{ __('Featured') }}</h5>
                                        <p>{{ __('Yoga Training') }}<br>
                                            {{ __('Simple language') }}<br>
                                            {{ __('Lifetime access') }}<br>
                                            {{ __('Study anywhere') }}<br></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fas fa-surprise"></i>
                                    </div>
                                    <div class="content">
                                        <h5>{{ __('Benefits') }}</h5>
                                        <p>{{ __('Create a daily yoga habit') }}<br>
                                            {{ __('Healthy eating habits') }}<br>
                                            {{ __('Self-healing for the body') }}<br>
                                            {{ __('Focus on Health.') }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- services-area-end -->

    <!-- top-rated-movie -->
    @include('course.user.partials.top-relate')
    <!-- top-rated-movie-end -->

    <!-- live-area -->
    <section class="live-area live-bg fix" data-background="{{ asset('images/bg/live_bg.jpg') }}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="section-title title-style-two mb-25">
                        <span class="sub-title">Yogi Xuân</span>
                        <h2 class="title">{{ __('Who is your trainer?') }}</h2>
                    </div>
                    <div class="live-movie-content">
                        <p>{{ __('Hello! I am Yogi Xuan, I have practiced Yoga for more than 10 years and achieved great achievements in International Yoga Awards. Thank you for being here to support Xuan so much! Hopefully we will gain health, spirit & optimism through practicing yoga… Wishing everyone good health!') }}</p>
                        <div class="live-fact-wrap">
                            <div class="resolution">
                                <h2>Video HD</h2>
                            </div>
                            <div class="active-customer">
                                <h4><span class="odometer" data-count="20"></span>K+</h4>
                                <p>{{ __('Student') }}</p>
                            </div>
                        </div>
                        <a href="https://www.youtube.com/watch?v=biRwEVrcPzg" class="btn popup-video"><i class="fas fa-play"></i> {{ __('Watch Now') }}</a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="live-movie-img wow fadeInRight" data-wow-delay=".2s" data-wow-duration="1.8s">
                        <img src="{{ asset('images/bg/yogiXuan.png') }}" alt="Yogi Xuan">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- live-area-end -->

    <!-- tv-series-area -->
    <section class="tv-series-area tv-series-bg" data-background="{{ asset('images/bg/tv_series_bg.jpg') }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center mb-50">
                        <span class="sub-title">{{ __('Comment') }}</span>
                        <h2 class="title">{{ __('What students say about Yogi Xuan') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="movie-item mb-50">
                        <div class="movie-poster">
                            <a href="https://www.youtube.com/watch?v=ZzERyev7m1Q" class="popup-video"><img src="{{ asset('images/bg/customer1_1.jpg') }}" alt=""></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title">{{ __('Ms. ') }}Hoa</h5>
                                <span class="date">2023</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="movie-item mb-50">
                        <div class="movie-poster">
                            <a href="https://www.youtube.com/watch?v=yDrrAhZpy_0" class="popup-video"><img src="{{ asset('images/bg/customer2.jpg') }}" alt=""></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title">{{ __('Ms. ') }}Tú Anh</h5>
                                <span class="date">2023</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="movie-item mb-50">
                        <div class="movie-poster">
                            <a href="https://www.youtube.com/watch?v=mgMutvT7jXk" class="popup-video"><img src="{{ asset('images/bg/customer3.jpg') }}" alt=""></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title">{{ __('Ms. ') }}Yến</h5>
                                <span class="date">2023</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="movie-item mb-50">
                        <div class="movie-poster">
                            <a href="https://www.youtube.com/watch?v=iiXAZdU-6aY" class="popup-video"><img src="{{ asset('images/bg/customer4.jpg') }}" alt=""></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title">{{ __('Ms. ') }}Yến</h5>
                                <span class="date">2023</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- tv-series-area-end -->
    <x-user.layouts.partials.newsletter />
</x-user.layouts.app>
