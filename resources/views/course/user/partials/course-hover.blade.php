<?php $src = Str::contains($course->image, ["https:", "http:"]) ? $course->image : Storage::url($course->image) ?>
<div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer {{ $course->class }}">
    <div class="movie-item movie-item-three mb-50">
        <div class="movie-poster">
            <img src="{{ $src }}" alt="{{ __('image') }}">
            <ul class="overlay-btn">
                <li class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </li>
                <li><a href="{{ $course->link_embedded }}" class="btn" target="_blank">{{ __('Watch Now') }}</a></li>
                <li><a href="{{ route('course.show', $course) }}" class="btn">{{ __('Details') }}</a></li>
            </ul>
        </div>
        <div class="movie-content">
            <div class="top">
                <h5 class="title"><a href="{{ route('course.show', $course) }}">{{ $course->title }}</a></h5>
                <span class="date">{{ $course->created_at->format('Y') }}</span>
            </div>
            <div class="bottom">
                <ul>
                    <li><span class="quality">{{ __('HOT') }}</span></li>
                    <li>
                        <span class="duration"><i class="fas fa-money-bill-wave"></i> {{ price_format($course->price) }} VNĐ</span>
                        <span class="rating"><i class="fas fa-eye"></i> {{ price_format($course->view) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
