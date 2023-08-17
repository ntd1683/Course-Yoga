<section class="ucm-area ucm-bg" data-background="{{ asset('images/bg/yoga-new-course.jpg') }}">
    <div class="ucm-bg-shape" data-background="{{ asset('images/bg/ucm_bg_shape.png') }}"></div>
    <div class="container">
        <div class="row align-items-end mb-55">
            <div class="col-lg-6">
                <div class="section-title text-center text-lg-left">
                    <span class="sub-title">{{ __('Course Hot') }}</span>
                    <h2 class="title">{{ __('New Courses') }}</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ucm-nav-wrap">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="premium-tab" data-toggle="tab" href="#premium" role="tab" aria-controls="premium" aria-selected="true">{{ __('Premium') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="free-tab" data-toggle="tab" href="#free" role="tab" aria-controls="free" aria-selected="false">{{ __('Free') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-none" id="ajaxGetCourseNew" data-ajax="{{ route('ajax.course.getNew') }}"></div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="premium" role="tabpanel" aria-labelledby="premium-tab">
                <div class="ucm-active owl-carousel" id="owl_premium">
                </div>
            </div>
            <div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">
                <div class="ucm-active owl-carousel" id="owl_free">
                </div>
            </div>
        </div>
    </div>
</section>
