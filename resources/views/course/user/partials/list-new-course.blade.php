    @foreach($courses as $course)
        <div class="movie-item mb-50">
            @include('course.user.partials.course', $course)
        </div>
    @endforeach
