<x-user.layouts.app>
    <?php $src = Str::contains($course->image, ["https:", "http:"]) ? $course->image : Storage::url($course->image) ?>
    <!-- movie-details-area -->
    <section class="movie-details-area" data-background="{{ asset('images/bg/image2.jpg') }}">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-xl-3 col-lg-4">
                    <div class="movie-details-img">
                        <img src="{{ $src }}" alt="{{ __('Image Course') }}"
                             style="width: 18rem;height: auto;">
                        <a href="{{ $course->link_embedded }}" class="popup-video"><img
                                src="{{ asset('images/images/play_icon.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8">
                    <div class="movie-details-content">
                        <h5>{{ __('Course') }}</h5>
                        <h2>{{ $course->title }}</h2>
                        <div class="banner-meta">
                            <ul>
                                <li class="quality">
                                    <span class="bg-warning text-white">{{ \App\Enums\CourseTypeEnum::getKeyByValue($course->type) }}</span>
                                    <span class="d-none"></span>
                                </li>
                                <li class="release-time">
                                    <span><i class="far fa-calendar-alt"></i> {{ $course->created_at->format('d-m-Y') }}</span>
                                    <span><i class="fas fa-eye"></i> {{ price_format($course->view) }}</span>
                                </li>
                            </ul>
                        </div>
                        <p>{{ \Illuminate\Support\Str::limit($course->description, 50) }}...</p>
                        <div class="movie-details-prime">
                            <ul>
                                <li class="share"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}"><i class="fas fa-share-alt"></i> {{ __('Share') }}</a></li>
                                <li class="streaming text-center">
                                    <h6>{{ __('Price') }}</h6>
                                    <span><i class="fas fa-money-bill-wave"></i> {{ price_format($course->price) }} VNĐ</span>
                                </li>
                                <li class="watch"><a href="{{ route('order', $course->id) }}"
                                                     class="btn"><i class="fas fa-shopping-bag"></i> {{ __('BUY') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="movie-details-btn">
                    <a data-target="#description" class="download-btn scroll-to-target text-dark" style="cursor: pointer;">{{ __('Description') }} <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- movie-details-area-end -->

    <!-- episode-area -->
    <section class="episode-area episode-bg" data-background="{{ asset('images/bg/episode_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="movie-episode-wrap">
                        <div class="episode-top-wrap">
                            <div class="section-title">
                                <h2 class="title">{{ __('LESSONS') }}</h2>
                            </div>
                            <div class="total-views-count">
                                <p>{{ $totalView }} <i class="far fa-eye"></i></p>
                            </div>
                        </div>
                        <div class="episode-watch-wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <button class="btn-block text-left" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                            <span class="season"></span>
                                            <span class="video-count">{{ $lessons->count() }} {{ __('lesson') }}</span>
                                        </button>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                         data-parent="#accordionExample">
                                        <div class="card-body">
                                            <ul>
                                                @foreach($lessons as $lesson)
                                                    <li><a href="{{ $lesson->link_embedded }}"
                                                           class="popup-video"><i class="fas fa-play"></i> {{ $lesson->title }}</a> <span class="duration"></span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="episode-img">
                        <?php $src = Str::contains($course->image, ["https:", "http:"]) ? $course->image : Storage::url($course->image) ?>
                        <img src="{{ $src }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row" id="description">
                <div class="col-12">
                    <div class="movie-history-wrap">
                        <h3 class="title"><span>{{ __('Description') }}</span></h3>
                        <p>{!! nl2br($course->description) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- episode-area-end -->

    <!-- new-courses-area -->
    @include('course.user.partials.new-courses')
    <!-- new-courses-area-end -->

    <!-- newsletter-area -->
    <x-user.layouts.partials.newsletter/>
    <!-- newsletter-area-end -->
</x-user.layouts.app>
