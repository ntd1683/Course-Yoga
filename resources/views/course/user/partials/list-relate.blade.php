
@foreach($courses as $course)
    <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer {{ $course->class }}">
        <div class="movie-item mb-60">
            @include('course.user.partials.course', $course)
        </div>
    </div>
@endforeach
