
<div class="row tr-movie-active">
    @foreach($courses as $course)
        @include('course.user.partials.course-hover', $course)
    @endforeach
</div>
<div class="row">
    <div class="col-12">
        {{ $courses->links() }}
    </div>
</div>
