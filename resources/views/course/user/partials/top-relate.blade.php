
<section class="top-rated-movie tr-movie-bg" data-background="{{ asset('images/bg/tr_movies_bg.jpg') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center mb-50">
                    <span class="sub-title">{{ __('Course') }}</span>
                    <h2 class="title">{{ __('Top Related Courses') }}</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="tr-movie-menu-active text-center">
                    <button class="active" data-filter="*">{{ __('ALL') }}</button>
                    <button class="" data-filter=".free">{{ __('Free') }}</button>
                    <button class="" data-filter=".premium">{{ __('Premium') }}</button>
                    <button class="" data-filter=".buy">{{ __('Most Bought') }}</button>
                </div>
            </div>
        </div>
        <div class="row tr-movie-active" id="courses_top_related" data-ajax="{{ route('ajax.course.getTopRelate') }}">
        </div>
    </div>
</section>
