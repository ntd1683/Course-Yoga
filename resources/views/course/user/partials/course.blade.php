
<div class="movie-poster">
    <a href="{{ route('course.show', $course) }}"><img src="{{ Storage::url($course->image) }}" alt=""></a>
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
